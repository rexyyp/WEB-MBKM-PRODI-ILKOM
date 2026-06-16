<?php

namespace App\Http\Controllers;

use App\Models\DokumenMbkm;
use App\Models\Logbook;
use App\Models\Penilaian;
use App\Models\PendaftaranMbkm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    /**
     * Helper: ambil data dasar mahasiswa yang login
     */
    private function getMahasiswaData(): array
    {
        $user = Auth::user();
        $mahasiswa = $user ? $user->mahasiswa : null;

        $pendaftaran = null;
        if ($mahasiswa) {
            $pendaftaran = PendaftaranMbkm::with([
                'mitraMbkm',
                'programMbkm',
                'dosenPembimbing.user',
                'dosenPenguji.user',
            ])->where('mahasiswa_id', $mahasiswa->id)->latest()->first();
        }

        return compact('user', 'mahasiswa', 'pendaftaran');
    }

    /**
     * Menampilkan dashboard mahasiswa
     */
    public function dashboard()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        $totalLogbook         = 0;
        $totalDokumen         = 0;
        $dokumenPercent       = 0;
        $dokumenUploaded      = 0;
        $uploadedDokumens     = [];
        $logbookTerbaru       = collect();

        if ($pendaftaran) {
            $totalLogbook    = Logbook::where('pendaftaran_mbkm_id', $pendaftaran->id)->count();
            $uploadedDokumens = DokumenMbkm::where('pendaftaran_mbkm_id', $pendaftaran->id)->pluck('jenis_dokumen')->toArray();
            $dokumenUploaded = count($uploadedDokumens);
            $totalDokumen    = 4; // 4 standard documents
            $dokumenPercent  = $totalDokumen > 0 ? round(($dokumenUploaded / $totalDokumen) * 100) : 0;
            $logbookTerbaru  = Logbook::where('pendaftaran_mbkm_id', $pendaftaran->id)
                                     ->latest('tanggal')->take(5)->get();
        }

        // Progress Calculation
        $progressPercent = 0;
        $progressText = '0 bulan tercapai';
        if ($pendaftaran && $pendaftaran->tgl_mulai && $pendaftaran->tgl_selesai) {
            $start = Carbon::parse($pendaftaran->tgl_mulai);
            $end = Carbon::parse($pendaftaran->tgl_selesai);
            $now = Carbon::now();

            if ($now->greaterThanOrEqualTo($end)) {
                $progressPercent = 100;
                $elapsedMonths = $start->diffInMonths($end);
            } elseif ($now->lessThan($start)) {
                $progressPercent = 0;
                $elapsedMonths = 0;
            } else {
                $totalDays = $start->diffInDays($end);
                $elapsedDays = $start->diffInDays($now);
                $progressPercent = $totalDays > 0 ? min(100, max(0, round(($elapsedDays / $totalDays) * 100))) : 0;
                $elapsedMonths = $start->diffInMonths($now);
            }
            $progressText = $elapsedMonths . ' bulan tercapai';
        }

        // Penilaian
        $nilaiPembimbingVal = null;
        $nilaiMitraVal = null;
        $nilaiPengujiVal = null;
        if ($pendaftaran) {
            $nilaiPembimbingVal = Penilaian::where('pendaftaran_mbkm_id', $pendaftaran->id)->where('jenis_penilai', 'pembimbing')->value('nilai_total');
            $nilaiMitraVal = Penilaian::where('pendaftaran_mbkm_id', $pendaftaran->id)->where('jenis_penilai', 'mitra')->value('nilai_total');
            $nilaiPengujiVal = Penilaian::where('pendaftaran_mbkm_id', $pendaftaran->id)->where('jenis_penilai', 'penguji')->value('nilai_total');
        }

        $scores = array_filter([$nilaiPembimbingVal, $nilaiMitraVal, $nilaiPengujiVal], function($v) { return $v !== null; });
        $predictedScore = count($scores) > 0 ? array_sum($scores) / count($scores) : null;
        
        $gradePredicted = 'Menunggu';
        if ($predictedScore !== null) {
            if ($predictedScore >= 85) $gradePredicted = 'A';
            elseif ($predictedScore >= 80) $gradePredicted = 'A-';
            elseif ($predictedScore >= 75) $gradePredicted = 'B+';
            elseif ($predictedScore >= 70) $gradePredicted = 'B';
            elseif ($predictedScore >= 65) $gradePredicted = 'B-';
            elseif ($predictedScore >= 60) $gradePredicted = 'C+';
            elseif ($predictedScore >= 55) $gradePredicted = 'C';
            else $gradePredicted = 'E';
        }

        return view('mahasiswa.dashboard', compact(
            'user', 'mahasiswa', 'pendaftaran', 
            'totalLogbook', 'dokumenUploaded', 'totalDokumen', 'dokumenPercent', 'uploadedDokumens',
            'logbookTerbaru', 'progressPercent', 'progressText',
            'nilaiPembimbingVal', 'nilaiMitraVal', 'nilaiPengujiVal', 'gradePredicted'
        ));
    }

    /**
     * Menampilkan data MBKM
     */
    public function dataMbkm()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();
        return view('mahasiswa.data-mbkm.index', compact('user', 'mahasiswa', 'pendaftaran'));
    }

    /**
     * Menampilkan halaman pembimbing
     */
    public function pembimbing()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();
        return view('mahasiswa.pembimbing.index', compact('user', 'mahasiswa', 'pendaftaran'));
    }

    /**
     * Menampilkan halaman dokumen
     */
    public function dokumen()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();
        return view('mahasiswa.dokumen.index', compact('user', 'mahasiswa', 'pendaftaran'));
    }

    /**
     * Menampilkan halaman logbook
     */
    public function logbook()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        $logbooks = collect();
        $totalLogbook = 0;
        $totalJamKerja = 0;
        $jumlahHariAktif = 0;

        if ($pendaftaran) {
            $logbooks = Logbook::where('pendaftaran_mbkm_id', $pendaftaran->id)
                ->orderBy('tanggal', 'desc')
                ->get();
            
            $totalLogbook = $logbooks->count();
            $totalJamKerja = $totalLogbook * 8; 
            $jumlahHariAktif = $logbooks->pluck('tanggal')->unique()->count();
        }

        return view('mahasiswa.logbook.index', compact('user', 'mahasiswa', 'pendaftaran', 'logbooks', 'totalLogbook', 'totalJamKerja', 'jumlahHariAktif'));
    }

    /**
     * Menampilkan form tambah logbook
     */
    public function createLogbook()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();
        return view('mahasiswa.logbook.create', compact('user', 'mahasiswa', 'pendaftaran'));
    }

    /**
     * Simpan logbook harian
     */
    public function storeLogbook(Request $request)
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        if (!$pendaftaran) {
            return redirect()->route('mahasiswa.logbook.index')
                ->with('error', 'Anda belum memiliki pendaftaran MBKM aktif.');
        }

        $request->validate([
            'tanggal'  => 'required|date',
            'kegiatan' => 'required|string|min:10',
            'file_bukti' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048',
        ], [
            'tanggal.required'  => 'Tanggal wajib diisi.',
            'kegiatan.required' => 'Deskripsi kegiatan wajib diisi.',
            'kegiatan.min'      => 'Deskripsi kegiatan minimal 10 karakter.',
            'file_bukti.mimes'   => 'Bukti harus berupa PDF, JPG, PNG, atau JPEG.',
            'file_bukti.max'     => 'Ukuran bukti maksimal 2MB.',
        ]);

        $filePath = null;
        if ($request->hasFile('file_bukti')) {
            $filePath = $request->file('file_bukti')->store('logbooks', 'public');
        }

        Logbook::create([
            'pendaftaran_mbkm_id' => $pendaftaran->id,
            'tanggal'             => $request->tanggal,
            'kegiatan'            => $request->kegiatan,
            'file_bukti'          => $filePath,
            'status_validasi'     => 'pending',
        ]);

        return redirect()->route('mahasiswa.logbook.index')
            ->with('success', 'Logbook berhasil ditambahkan!');
    }

    /**
     * Menampilkan halaman penilaian
     */
    public function penilaian()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        $penilaians = collect();
        if ($pendaftaran) {
            $penilaians = Penilaian::where('pendaftaran_mbkm_id', $pendaftaran->id)->get();
        }

        return view('mahasiswa.penilaian.index', compact('user', 'mahasiswa', 'pendaftaran', 'penilaians'));
    }

    /**
     * Menampilkan halaman konversi mata kuliah
     */
    public function konversiMk()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();
        return view('mahasiswa.konversi-mk.index', compact('user', 'mahasiswa', 'pendaftaran'));
    }

    /**
     * Menampilkan form tambah mata kuliah konversi
     */
    public function createKonversiMk()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();
        return view('mahasiswa.konversi-mk.create', compact('user', 'mahasiswa', 'pendaftaran'));
    }

    /**
     * Simpan mata kuliah konversi
     */
    public function storeKonversiMk(Request $request)
    {
        return redirect()->route('mahasiswa.konversi-mk.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan.');
    }
}
