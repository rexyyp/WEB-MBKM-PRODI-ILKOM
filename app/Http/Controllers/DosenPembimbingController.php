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
    public function logbook(Request $request)
    {
        $dosen = $this->getDosenData();

        // 1. Dapatkan daftar pendaftaran mahasiswa bimbingan
        $pendaftarans = PendaftaranMbkm::with(['mahasiswa.user', 'mitraMbkm'])
            ->where('dosen_pembimbing_id', $dosen?->id)
            ->whereIn('status', ['berjalan', 'selesai'])
            ->get();

        // 2. Ambil data pendaftaran terpilih
        $selectedPendaftaranId = $request->pendaftaran_id ?? $pendaftarans->first()?->id;
        $selectedPendaftaran = $pendaftarans->firstWhere('id', $selectedPendaftaranId);

        $logbooks = collect();
        $totalAktivitas = 0;
        $totalJam = 0;

        if ($selectedPendaftaran) {
            $logbooks = \App\Models\Logbook::where('pendaftaran_mbkm_id', $selectedPendaftaranId)
                ->orderBy('tanggal', 'desc')
                ->get();
            
            $totalAktivitas = $logbooks->count();
            
            // Hitung estimasi jam (selisih jam_mulai dan jam_selesai)
            $totalJam = $logbooks->reduce(function ($carry, $logbook) {
                if ($logbook->jam_mulai && $logbook->jam_selesai) {
                    $start = \Carbon\Carbon::parse($logbook->jam_mulai);
                    $end = \Carbon\Carbon::parse($logbook->jam_selesai);
                    return $carry + $start->diffInHours($end);
                }
                return $carry;
            }, 0);
        }

        return view('dosen-pembimbing.logbook.index', compact(
            'pendaftarans',
            'selectedPendaftaran',
            'logbooks',
            'totalAktivitas',
            'totalJam'
        ));
    }

    /**
     * Menyimpan review dosen (Komentar & Status Validasi) untuk logbook tertentu
     */
    public function simpanReviewLogbook(Request $request, $id)
    {
        $dosen = $this->getDosenData();

        $request->validate([
            'status_validasi' => 'required|in:disetujui,revisi',
            'komentar_dosen'  => 'nullable|string|max:1000',
        ]);

        $logbook = \App\Models\Logbook::whereHas('pendaftaranMbkm', function($q) use ($dosen) {
            $q->where('dosen_pembimbing_id', $dosen?->id);
        })->findOrFail($id);

        $logbook->update([
            'status_validasi' => $request->status_validasi,
            'komentar_dosen'  => $request->komentar_dosen,
        ]);

        return back()->with('success', 'Review logbook berhasil disimpan.');
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

    /**
     * Menampilkan halaman daftar bimbingan (dan memfilter per mahasiswa jika pendaftaran_id diberikan)
     */
    public function bimbingan(Request $request)
    {
        $dosen = $this->getDosenData();
        
        // Base query pendaftaran milik dosen ini
        $pendaftaransBase = PendaftaranMbkm::where('dosen_pembimbing_id', $dosen?->id);
        $pendaftaranIds = $pendaftaransBase->pluck('id')->toArray();

        $query = \App\Models\Bimbingan::with(['pendaftaranMbkm.mahasiswa.user', 'pendaftaranMbkm.programMbkm', 'pendaftaranMbkm.mitraMbkm'])
            ->whereIn('pendaftaran_mbkm_id', $pendaftaranIds);

        // Jika diakses dari klik "Lihat Detail" (membawa parameter pendaftaran_id)
        if ($request->filled('pendaftaran_id')) {
            $query->where('pendaftaran_mbkm_id', $request->pendaftaran_id);
        }

        $bimbingans = $query->orderBy('created_at', 'desc')->get();

        $menungguJadwalCount = $bimbingans->where('status', 'menunggu')->count();
        $terjadwalCount = $bimbingans->where('status', 'terjadwal')->count();
        $selesaiCount = $bimbingans->where('status', 'selesai')->count();

        $menungguBimbingans = $bimbingans->where('status', 'menunggu');
        $semuaBimbingans = $bimbingans->whereIn('status', ['terjadwal', 'selesai']);

        return view('dosen-pembimbing.bimbingan.index', compact(
            'menungguJadwalCount', 'terjadwalCount', 'selesaiCount', 
            'menungguBimbingans', 'semuaBimbingans'
        ));
    }

    /**
     * Dosen menetapkan jadwal untuk pengajuan bimbingan (status menunggu -> terjadwal)
     */
    public function tetapkanJadwalBimbingan(Request $request, $id)
    {
        $dosen = $this->getDosenData();

        $request->validate([
            'tanggal'      => 'required|date',
            'jam'          => 'required|date_format:H:i',
            'tipe'         => 'required|in:online,offline',
            'link_meeting' => 'nullable|url|max:255',
        ]);

        $bimbingan = \App\Models\Bimbingan::whereHas('pendaftaranMbkm', function($q) use ($dosen) {
            $q->where('dosen_pembimbing_id', $dosen?->id);
        })->findOrFail($id);

        $bimbingan->update([
            'tanggal'      => $request->tanggal,
            'jam'          => $request->jam,
            'tipe'         => $request->tipe,
            'link_meeting' => $request->tipe === 'online' ? $request->link_meeting : null,
            'status'       => 'terjadwal'
        ]);

        return back()->with('success', 'Jadwal bimbingan berhasil ditetapkan!');
    }

    /**
     * Dosen menyelesaikan sesi bimbingan (status terjadwal -> selesai)
     */
    public function selesaikanBimbingan(Request $request, $id)
    {
        $dosen = $this->getDosenData();

        $request->validate([
            'catatan_dosen' => 'nullable|string|max:1000',
        ]);

        $bimbingan = \App\Models\Bimbingan::whereHas('pendaftaranMbkm', function($q) use ($dosen) {
            $q->where('dosen_pembimbing_id', $dosen?->id);
        })->findOrFail($id);

        $bimbingan->update([
            'catatan_dosen' => $request->catatan_dosen,
            'status'        => 'selesai'
        ]);

        return back()->with('success', 'Sesi bimbingan berhasil diselesaikan!');
    }
}
