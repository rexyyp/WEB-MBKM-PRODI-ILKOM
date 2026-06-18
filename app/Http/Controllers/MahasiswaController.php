<?php

namespace App\Http\Controllers;

use App\Models\DokumenMbkm;
use App\Models\Logbook;
use App\Models\Penilaian;
use App\Models\PendaftaranMbkm;
use App\Models\TenggantDokumen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            $uploadedDokumens = DokumenMbkm::where('pendaftaran_mbkm_id', $pendaftaran->id)->pluck('kode_dokumen')->toArray();
            $dokumenUploaded = count($uploadedDokumens);
            $totalDokumen    = \App\Models\TenggantDokumen::where('is_wajib', true)->count() ?: 12;
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
        
        // Cek apakah mahasiswa sudah punya pendaftaran MBKM
        $hasData = $pendaftaran ? true : false;
        
        return view('mahasiswa.data-mbkm.index', compact('user', 'mahasiswa', 'pendaftaran', 'hasData'));
    }

    /**
     * Simpan data MBKM mahasiswa
     */
    public function storeDataMbkm(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = $user ? $user->mahasiswa : null;

        if (!$mahasiswa) {
            return redirect()->route('mahasiswa.data-mbkm.index')
                ->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $request->validate([
            'nama_mitra'      => 'required|string|max:255',
            'lokasi'          => 'required|string|max:255',
            'alamat_lengkap'  => 'required|string|max:1000',
            'posisi_magang'   => 'required|string|max:255',
            'detail_pekerjaan'=> 'required|string|max:5000',
            'tgl_mulai'       => 'required|date',
            'tgl_selesai'     => 'required|date|after_or_equal:tgl_mulai',
        ], [
            'nama_mitra.required'       => 'Mitra MBKM wajib diisi.',
            'lokasi.required'           => 'Lokasi (kota) wajib diisi.',
            'alamat_lengkap.required'   => 'Alamat lengkap kantor wajib diisi.',
            'posisi_magang.required'    => 'Posisi magang wajib diisi.',
            'detail_pekerjaan.required' => 'Detail pekerjaan wajib diisi.',
            'tgl_mulai.required'        => 'Tanggal mulai wajib diisi.',
            'tgl_selesai.required'      => 'Tanggal selesai wajib diisi.',
            'tgl_selesai.after_or_equal'=> 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
        ]);

        // 1. Dapatkan atau buat Mitra
        $mitra = \App\Models\MitraMbkm::firstOrCreate(
            ['nama_mitra' => $request->nama_mitra],
            [
                'lokasi' => $request->lokasi,
                'alamat' => $request->alamat_lengkap,
                'narahubung' => 'Narahubung',
                'no_telp_narahubung' => '-',
            ]
        );

        // Jika mitra sudah ada tapi data perlu diperbarui
        if ($mitra->lokasi !== $request->lokasi || $mitra->alamat !== $request->alamat_lengkap) {
            $mitra->update([
                'lokasi' => $request->lokasi,
                'alamat' => $request->alamat_lengkap,
            ]);
        }

        // 2. Dapatkan atau buat Program MBKM default
        $program = \App\Models\ProgramMbkm::firstOrCreate(
            ['nama_program' => 'Magang Mandiri'],
            [
                'deskripsi' => 'Program Magang Mandiri Mahasiswa',
            ]
        );

        // 3. Dapatkan atau buat/update Pendaftaran
        $pendaftaran = PendaftaranMbkm::where('mahasiswa_id', $mahasiswa->id)->latest()->first();

        if ($pendaftaran) {
            $pendaftaran->update([
                'mitra_mbkm_id'   => $mitra->id,
                'program_mbkm_id' => $program->id,
                'posisi_magang'   => $request->posisi_magang,
                'detail_pekerjaan'=> $request->detail_pekerjaan,
                'tgl_mulai'       => $request->tgl_mulai,
                'tgl_selesai'     => $request->tgl_selesai,
                'status'          => 'berjalan', // ✅ Otomatis berjalan saat update
            ]);
        } else {
            PendaftaranMbkm::create([
                'mahasiswa_id'    => $mahasiswa->id,
                'mitra_mbkm_id'   => $mitra->id,
                'program_mbkm_id' => $program->id,
                'posisi_magang'   => $request->posisi_magang,
                'detail_pekerjaan'=> $request->detail_pekerjaan,
                'tgl_mulai'       => $request->tgl_mulai,
                'tgl_selesai'     => $request->tgl_selesai,
                'status'          => 'berjalan', // ✅ Otomatis berjalan saat input pertama kali
            ]);
        }

        return redirect()->route('mahasiswa.data-mbkm.index')
            ->with('success', 'Data MBKM berhasil disimpan.');
    }

    /**
     * Menampilkan halaman pembimbing
     */
    public function pembimbing()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();
        
        // Ambil data pembimbing lapangan dari mitra (jika ada)
        $pembimbingLapangan = null;
        if ($pendaftaran && $pendaftaran->mitraMbkm) {
            $pembimbingLapangan = [
                'nama' => $pendaftaran->mitraMbkm->narahubung,
                'no_telp' => $pendaftaran->mitraMbkm->no_telp_narahubung,
            ];
        }
        
        return view('mahasiswa.pembimbing.index', compact('user', 'mahasiswa', 'pendaftaran', 'pembimbingLapangan'));
    }

    /**
     * Update data pembimbing lapangan
     */
    public function updatePembimbingLapangan(Request $request)
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        if (!$pendaftaran || !$pendaftaran->mitraMbkm) {
            return redirect()->route('mahasiswa.pembimbing.index')
                ->with('error', 'Data MBKM belum tersedia. Silakan isi data MBKM terlebih dahulu.');
        }

        $request->validate([
            'narahubung' => 'required|string|max:255',
            'no_telp_narahubung' => 'required|string|max:20',
        ], [
            'narahubung.required' => 'Nama pembimbing lapangan wajib diisi.',
            'no_telp_narahubung.required' => 'Nomor WhatsApp wajib diisi.',
        ]);

        // Update data pembimbing lapangan di tabel mitra_mbkms
        $pendaftaran->mitraMbkm->update([
            'narahubung' => $request->narahubung,
            'no_telp_narahubung' => $request->no_telp_narahubung,
        ]);

        return redirect()->route('mahasiswa.pembimbing.index')
            ->with('success', 'Data pembimbing lapangan berhasil disimpan.');
    }

    /**
     * Menampilkan halaman dokumen
     */
    public function dokumen()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        // Ambil semua konfigurasi tenggat dokumen
        $tenggats = TenggantDokumen::ordered()->get()->keyBy('kode_dokumen');

        // Ambil dokumen yang sudah diupload mahasiswa
        $uploadedDokumens = collect();
        if ($pendaftaran) {
            $uploadedDokumens = DokumenMbkm::where('pendaftaran_mbkm_id', $pendaftaran->id)
                ->get()
                ->keyBy('kode_dokumen');
        }

        // Build section data (grouped by kategori)
        $dokumenSections = [];
        foreach (TenggantDokumen::kategoris() as $kategori) {
            $items = $tenggats->filter(fn($t) => $t->kategori === $kategori)
                ->sortBy('urutan')
                ->map(function ($tenggat) use ($uploadedDokumens) {
                    $uploaded = $uploadedDokumens->get($tenggat->kode_dokumen);
                    return [
                        'kode'        => $tenggat->kode_dokumen,
                        'title'       => $tenggat->nama_dokumen,
                        'tenggat'     => $tenggat,
                        'uploaded'    => $uploaded,
                        'is_disabled' => $tenggat->is_prasyarat && $tenggat->prasyarat_kode
                                         && !$uploadedDokumens->has($tenggat->prasyarat_kode),
                    ];
                })->values();

            if ($items->isNotEmpty()) {
                $dokumenSections[$kategori] = $items;
            }
        }

        // Hitung progress
        $totalDokumen    = $tenggats->where('is_wajib', true)->count();
        $uploadedCount   = $uploadedDokumens->count();
        $progressPercent = $totalDokumen > 0 ? min(100, round(($uploadedCount / $totalDokumen) * 100)) : 0;

        return view('mahasiswa.dokumen.index', compact(
            'user', 'mahasiswa', 'pendaftaran',
            'dokumenSections', 'totalDokumen', 'uploadedCount', 'progressPercent'
        ));
    }

    /**
     * Upload dokumen mahasiswa
     */
    public function uploadDokumen(Request $request)
    {
        ['mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        if (!$pendaftaran) {
            return back()->with('error', 'Anda belum memiliki pendaftaran MBKM aktif.');
        }

        $request->validate([
            'kode_dokumen' => 'required|string|exists:tenggat_dokumens,kode_dokumen',
            'file'         => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png|max:10240',
        ], [
            'file.required' => 'File wajib dipilih.',
            'file.mimes'    => 'Tipe file tidak didukung. Gunakan PDF, DOC, XLS, PPT, JPG, atau PNG.',
            'file.max'      => 'Ukuran file maksimal 10MB.',
        ]);

        $kodeDokumen = $request->kode_dokumen;
        $file        = $request->file('file');
        $folder      = 'dokumen/' . $pendaftaran->id;
        $fileName    = $kodeDokumen . '_' . time() . '.' . $file->getClientOriginalExtension();
        $filePath    = $file->storeAs($folder, $fileName, 'public');

        // Simpan record baru (histori: file lama tetap ada, ini jadi yang aktif/terbaru)
        DokumenMbkm::create([
            'pendaftaran_mbkm_id' => $pendaftaran->id,
            'kode_dokumen'        => $kodeDokumen,
            'file_path'           => $filePath,
            'file_name'           => $file->getClientOriginalName(),
            'file_size'           => $file->getSize(),
            'uploaded_at'         => now(),
        ]);

        return back()->with('success', 'Dokumen berhasil diunggah!');
    }

    /**
     * Hapus / ganti dokumen mahasiswa (versi lama juga dihapus dari storage)
     */
    public function deleteDokumen($id)
    {
        ['pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        $dokumen = DokumenMbkm::where('id', $id)
            ->where('pendaftaran_mbkm_id', $pendaftaran?->id)
            ->firstOrFail();

        // Hapus file dari storage
        if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();

        return back()->with('success', 'Dokumen berhasil dihapus.');
    }

    /**
     * Download dokumen mahasiswa
     */
    public function downloadDokumen($id)
    {
        ['pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        $dokumen = DokumenMbkm::where('id', $id)
            ->where('pendaftaran_mbkm_id', $pendaftaran?->id)
            ->firstOrFail();

        if (!Storage::disk('public')->exists($dokumen->file_path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($dokumen->file_path, $dokumen->file_name);
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
