<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Penilaian;
use App\Models\PendaftaranMbkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenPembimbingController extends Controller
{
    /**
     * Helper: ambil data dosen yang sedang login
     */
    private function getDosenData(): ?Dosen
    {
        return Auth::user()?->dosen;
    }

    /**
     * Show the Dosen Dashboard
     */
    public function dashboard()
    {
        $dosen = $this->getDosenData();

        // Base query untuk Pendaftaran MBKM mahasiswa bimbingan
        $pendaftaransBase = \App\Models\PendaftaranMbkm::where('dosen_pembimbing_id', $dosen?->id);

        // 1. Total Mahasiswa Bimbingan
        $totalBimbingan = $pendaftaransBase->count();

        // 2. Mahasiswa Aktif
        $mahasiswaAktif = (clone $pendaftaransBase)->where('status', 'berjalan')->count();

        // 3. Logbook Belum Direview
        $logbookBelumDireview = \App\Models\Logbook::whereHas('pendaftaranMbkm', function ($q) use ($dosen) {
            $q->where('dosen_pembimbing_id', $dosen?->id);
        })->where('status_validasi', 'pending')->count();

        // 4. Penilaian Belum Diisi
        $penilaianBelumDiisi = (clone $pendaftaransBase)
            ->whereIn('status', ['berjalan', 'selesai'])
            ->whereDoesntHave('penilaians', function ($q) {
                $q->where('jenis_penilai', 'pembimbing');
            })->count();

        // Alert: Mahasiswa aktif yang belum isi logbook hari ini
        $belumIsiLogbookHariIni = (clone $pendaftaransBase)
            ->where('status', 'berjalan')
            ->whereDoesntHave('logbooks', function ($q) {
                $q->whereDate('tanggal', today());
            })->count();

        // Tabel Mahasiswa (Pagination 5 per halaman)
        $mahasiswas = (clone $pendaftaransBase)->with([
            'mahasiswa.user',
            'programMbkm',
            'mitraMbkm'
        ])->latest()->paginate(5);

        return view('dosen-pembimbing.dashboard', compact(
            'totalBimbingan', 'mahasiswaAktif', 'logbookBelumDireview',
            'penilaianBelumDiisi', 'belumIsiLogbookHariIni', 'mahasiswas'
        ));
    }

    /**
     * Show the Mahasiswa Bimbingan list
     */
    public function mahasiswa(Request $request)
    {
        $dosen = $this->getDosenData();

        // Hitung total dokumen wajib untuk menentukan status 100% lengkap
        $totalDokumenWajib = \App\Models\TenggantDokumen::where('is_wajib', true)->count();
        if ($totalDokumenWajib === 0) {
            $totalDokumenWajib = 12; // Fallback jika tidak ada data konfigurasi di tabel
        }

        $query = \App\Models\PendaftaranMbkm::with([
            'mahasiswa.user',
            'programMbkm',
            'mitraMbkm',
            'dokumenMbkms'
        ])->where('dosen_pembimbing_id', $dosen?->id);

        // 1. Filter Search (NIM atau Nama)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('mahasiswa.user', fn($q2) => $q2->where('name', 'like', "%{$search}%"))
                  ->orWhereHas('mahasiswa', fn($q2) => $q2->where('nim', 'like', "%{$search}%"));
            });
        }

        // 2. Filter Status MBKM
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 3. Filter Status Dokumen (100% Lengkap = total upload >= total wajib)
        if ($request->filled('dokumen')) {
            if ($request->dokumen === 'lengkap') {
                $query->has('dokumenMbkms', '>=', $totalDokumenWajib);
            } elseif ($request->dokumen === 'belum') {
                $query->has('dokumenMbkms', '<', $totalDokumenWajib);
            }
        }

        $pendaftarans = $query->latest()->paginate(10)->withQueryString();

        return view('dosen-pembimbing.mahasiswa.index', compact('pendaftarans', 'totalDokumenWajib'));
    }

    /**
     * Show the Logbook review page
     */
    public function logbook()
    {
        return view('dosen-pembimbing.logbook.index');
    }

    /**
     * Menampilkan halaman penilaian mahasiswa (data dinamis dari DB)
     */
    public function penilaian(Request $request)
    {
        $dosen = $this->getDosenData();

        // Ambil semua mahasiswa bimbingan dosen ini
        $pendaftarans = PendaftaranMbkm::with([
                'mahasiswa.user',
                'mitraMbkm',
                'penilaians',
            ])
            ->where('dosen_pembimbing_id', $dosen?->id)
            ->whereIn('status', ['berjalan', 'selesai'])
            ->get();

        // Jika ada pilihan mahasiswa spesifik (dari URL ?pendaftaran_id=x)
        $selectedPendaftaran = null;
        $existingNilai = null;

        if ($request->filled('pendaftaran_id')) {
            $selectedPendaftaran = PendaftaranMbkm::with([
                    'mahasiswa.user',
                    'mitraMbkm',
                    'penilaians',
                ])
                ->where('id', $request->pendaftaran_id)
                ->where('dosen_pembimbing_id', $dosen?->id)
                ->first();

            if ($selectedPendaftaran) {
                $existingNilai = $selectedPendaftaran->penilaians
                    ->firstWhere('jenis_penilai', 'pembimbing');
            }
        }

        return view('dosen-pembimbing.penilaian.index', compact(
            'dosen', 'pendaftarans', 'selectedPendaftaran', 'existingNilai'
        ));
    }

    /**
     * Simpan atau update nilai pembimbing untuk mahasiswa
     */
    public function simpanPenilaian(Request $request)
    {
        $dosen = $this->getDosenData();

        $request->validate([
            'pendaftaran_id' => 'required|integer|exists:pendaftaran_mbkms,id',
            'nilai_total'    => 'required|numeric|min:0|max:100',
            'catatan'        => 'nullable|string|max:1000',
        ], [
            'pendaftaran_id.required' => 'Pilih mahasiswa terlebih dahulu.',
            'pendaftaran_id.exists'   => 'Data mahasiswa tidak valid.',
            'nilai_total.required'    => 'Nilai wajib diisi.',
            'nilai_total.numeric'     => 'Nilai harus berupa angka.',
            'nilai_total.min'         => 'Nilai minimal 0.',
            'nilai_total.max'         => 'Nilai maksimal 100.',
        ]);

        // Pastikan pendaftaran ini adalah mahasiswa bimbingan dosen yang login
        $pendaftaran = PendaftaranMbkm::where('id', $request->pendaftaran_id)
            ->where('dosen_pembimbing_id', $dosen?->id)
            ->firstOrFail();

        // Update atau buat record penilaian
        Penilaian::updateOrCreate(
            [
                'pendaftaran_mbkm_id' => $pendaftaran->id,
                'jenis_penilai'       => 'pembimbing',
            ],
            [
                'nilai_total' => $request->nilai_total,
                'catatan'     => $request->catatan,
            ]
        );

        return redirect()
            ->route('dosen-pembimbing.penilaian.index', ['pendaftaran_id' => $pendaftaran->id])
            ->with('success', 'Nilai berhasil disimpan untuk ' . ($pendaftaran->mahasiswa->user->name ?? '-') . '.');
    }
}
