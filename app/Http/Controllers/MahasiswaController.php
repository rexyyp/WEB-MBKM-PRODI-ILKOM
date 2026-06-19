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
     * Menampilkan halaman logbook (dinamis, dikelompokkan per minggu)
     */
    public function logbook()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        $logbooks        = collect();
        $totalLogbook    = 0;
        $totalJamKerja   = 0;
        $jumlahHariAktif = 0;
        $logbooksByWeek  = [];

        if ($pendaftaran) {
            $logbooks = Logbook::where('pendaftaran_mbkm_id', $pendaftaran->id)
                ->orderBy('tanggal', 'desc')
                ->get();

            $totalLogbook    = $logbooks->count();
            $jumlahHariAktif = $logbooks->pluck('tanggal')->unique()->count();

            $startDate    = $pendaftaran->tgl_mulai ? Carbon::parse($pendaftaran->tgl_mulai) : null;
            $mondayOfStart = $startDate ? $startDate->copy()->startOfWeek(Carbon::MONDAY) : null;

            foreach ($logbooks as $logbook) {
                $date      = Carbon::parse($logbook->tanggal);
                $weekStart = $date->copy()->startOfWeek(Carbon::MONDAY);
                $weekEnd   = $date->copy()->endOfWeek(Carbon::SUNDAY);
                $weekKey   = $date->format('oW'); // ISO year + zero-padded week (e.g. "202612")

                // Hitung jam kerja aktual dari jam_mulai dan jam_selesai
                $jamKerja = 0;
                if ($logbook->jam_mulai && $logbook->jam_selesai) {
                    $start = Carbon::createFromTimeString($logbook->jam_mulai);
                    $end   = Carbon::createFromTimeString($logbook->jam_selesai);
                    if ($end->lessThan($start)) {
                        $end->addDay(); // Lewat tengah malam
                    }
                    $jamKerja = round($start->diffInMinutes($end) / 60, 1);
                }
                $logbook->jam_kerja = $jamKerja;
                $totalJamKerja     += $jamKerja;

                // Hitung minggu ke berapa relatif dari tgl_mulai MBKM
                if (!isset($logbooksByWeek[$weekKey])) {
                    if ($mondayOfStart && $weekStart->gte($mondayOfStart)) {
                        $weekNumber = (int)($mondayOfStart->diffInWeeks($weekStart)) + 1;
                    } else {
                        $weekNumber = 1;
                    }

                    $logbooksByWeek[$weekKey] = [
                        'week_number'    => $weekNumber,
                        'date_start'     => $weekStart,
                        'date_end'       => $weekEnd,
                        'logbooks'       => collect(),
                        'total_jam'      => 0,
                        'semua_direview' => true,
                    ];
                }

                $logbooksByWeek[$weekKey]['logbooks']->push($logbook);
                $logbooksByWeek[$weekKey]['total_jam'] = round(
                    $logbooksByWeek[$weekKey]['total_jam'] + $jamKerja, 1
                );

                // Jika ada entry yang belum disetujui, minggu ini belum semua direview
                if ($logbook->status_validasi !== 'disetujui') {
                    $logbooksByWeek[$weekKey]['semua_direview'] = false;
                }
            }

            // Urutkan minggu terbaru di atas
            krsort($logbooksByWeek);
            $totalJamKerja = round($totalJamKerja, 1);
        }

        return view('mahasiswa.logbook.index', compact(
            'user', 'mahasiswa', 'pendaftaran',
            'logbooks', 'totalLogbook', 'totalJamKerja', 'jumlahHariAktif',
            'logbooksByWeek'
        ));
    }

    /**
     * Menampilkan form tambah logbook
     */
    public function createLogbook()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        if (!$pendaftaran) {
            return redirect()->route('mahasiswa.logbook.index')
                ->with('error', 'Anda belum memiliki pendaftaran MBKM aktif.');
        }

        return view('mahasiswa.logbook.create', compact('user', 'mahasiswa', 'pendaftaran'));
    }

    /**
     * Simpan logbook harian ke database
     */
    public function storeLogbook(Request $request)
    {
        ['mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        if (!$pendaftaran) {
            return redirect()->route('mahasiswa.logbook.index')
                ->with('error', 'Anda belum memiliki pendaftaran MBKM aktif.');
        }

        $request->validate([
            'tanggal'     => 'required|date',
            'kegiatan'    => 'required|string|max:255',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'deskripsi'   => 'required|string|min:10',
            'file_bukti'  => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:5120',
        ], [
            'tanggal.required'        => 'Tanggal wajib diisi.',
            'kegiatan.required'       => 'Nama kegiatan wajib diisi.',
            'jam_mulai.required'      => 'Jam mulai wajib diisi.',
            'jam_mulai.date_format'   => 'Format jam mulai tidak valid.',
            'jam_selesai.required'    => 'Jam selesai wajib diisi.',
            'jam_selesai.date_format' => 'Format jam selesai tidak valid.',
            'deskripsi.required'      => 'Deskripsi kegiatan wajib diisi.',
            'deskripsi.min'           => 'Deskripsi minimal 10 karakter.',
            'file_bukti.mimes'        => 'Bukti harus berupa PDF, JPG, atau PNG.',
            'file_bukti.max'          => 'Ukuran file maksimal 5MB.',
        ]);

        $filePath = null;
        if ($request->hasFile('file_bukti')) {
            $filePath = $request->file('file_bukti')->store('logbooks', 'public');
        }

        Logbook::create([
            'pendaftaran_mbkm_id' => $pendaftaran->id,
            'tanggal'             => $request->tanggal,
            'kegiatan'            => $request->kegiatan,
            'jam_mulai'           => $request->jam_mulai,
            'jam_selesai'         => $request->jam_selesai,
            'deskripsi'           => $request->deskripsi,
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
     * Menampilkan halaman konversi mata kuliah (data dinamis dari DB)
     */
    public function konversiMk()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        $konversiSks = null;
        $details     = collect();
        $totalMk     = 0;
        $totalSks    = 0;

        if ($pendaftaran) {
            $konversiSks = $pendaftaran->konversiSks()->with('detailKonversiSks.mataKuliah')->first();

            if ($konversiSks) {
                $details  = $konversiSks->detailKonversiSks;
                $totalMk  = $details->count();
                $totalSks = $details->sum(fn($d) => $d->mataKuliah?->sks ?? 0);
            }
        }

        return view('mahasiswa.konversi-mk.index', compact(
            'user', 'mahasiswa', 'pendaftaran',
            'konversiSks', 'details', 'totalMk', 'totalSks'
        ));
    }

    /**
     * Menampilkan form tambah mata kuliah konversi
     */
    public function createKonversiMk()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        if (!$pendaftaran) {
            return redirect()->route('mahasiswa.konversi-mk.index')
                ->with('error', 'Anda belum memiliki pendaftaran MBKM aktif.');
        }

        return view('mahasiswa.konversi-mk.create', compact('user', 'mahasiswa', 'pendaftaran'));
    }

    /**
     * Simpan mata kuliah konversi ke database
     */
    public function storeKonversiMk(Request $request)
    {
        ['mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        if (!$pendaftaran) {
            return redirect()->route('mahasiswa.konversi-mk.index')
                ->with('error', 'Anda belum memiliki pendaftaran MBKM aktif.');
        }

        // Validasi input
        $request->validate([
            'kode_mk' => ['required', 'string', 'max:10', 'regex:/^[A-Z]{2}\d{4}$/'],
            'nama_mk' => 'required|string|max:255',
            'sks'     => 'required|integer|min:1|max:24',
        ], [
            'kode_mk.required' => 'Kode mata kuliah wajib diisi.',
            'kode_mk.regex'    => 'Format kode MK tidak valid (contoh: IF1234).',
            'nama_mk.required' => 'Nama mata kuliah wajib diisi.',
            'sks.required'     => 'SKS wajib diisi.',
            'sks.min'          => 'SKS minimal 1.',
            'sks.max'          => 'SKS maksimal 24.',
        ]);

        // 1. Cari atau buat KonversiSks untuk pendaftaran ini (header)
        $konversiSks = \App\Models\KonversiSks::firstOrCreate(
            ['pendaftaran_mbkm_id' => $pendaftaran->id],
            ['status' => 'pending']
        );

        // Jika status sudah disetujui/diproses, tidak bisa tambah MK lagi
        if (in_array($konversiSks->status, ['disetujui', 'diproses'])) {
            return redirect()->route('mahasiswa.konversi-mk.index')
                ->with('error', 'Pengajuan konversi sedang diproses atau sudah disetujui. Tidak dapat menambah mata kuliah.');
        }

        // 2. Cari atau buat MataKuliah berdasarkan kode_mk
        $mataKuliah = \App\Models\MataKuliah::firstOrCreate(
            ['kode_mk' => strtoupper($request->kode_mk)],
            [
                'nama_mk' => $request->nama_mk,
                'sks'     => $request->sks,
            ]
        );

        // Jika MK sudah ada, update nama/sks sesuai input terbaru
        if (!$mataKuliah->wasRecentlyCreated) {
            $mataKuliah->update([
                'nama_mk' => $request->nama_mk,
                'sks'     => $request->sks,
            ]);
        }

        // 3. Cek apakah MK ini sudah ada di konversi mahasiswa ini
        $alreadyExists = \App\Models\DetailKonversiSks::where('konversi_sks_id', $konversiSks->id)
            ->where('mata_kuliah_id', $mataKuliah->id)
            ->exists();

        if ($alreadyExists) {
            return redirect()->route('mahasiswa.konversi-mk.index')
                ->with('error', 'Mata kuliah ' . $mataKuliah->kode_mk . ' sudah ada dalam daftar konversi Anda.');
        }

        // 4. Buat detail konversi
        \App\Models\DetailKonversiSks::create([
            'konversi_sks_id' => $konversiSks->id,
            'mata_kuliah_id'  => $mataKuliah->id,
            'nilai_diakui'    => null,
        ]);

        return redirect()->route('mahasiswa.konversi-mk.index')
            ->with('success', 'Mata kuliah ' . $mataKuliah->nama_mk . ' berhasil ditambahkan ke daftar konversi.');
    }

    /**
     * Menampilkan form edit mata kuliah konversi
     */
    public function editKonversiMk($id)
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        if (!$pendaftaran) {
            return redirect()->route('mahasiswa.konversi-mk.index')
                ->with('error', 'Anda belum memiliki pendaftaran MBKM aktif.');
        }

        $konversiSks = $pendaftaran->konversiSks;

        if (!$konversiSks) {
            return redirect()->route('mahasiswa.konversi-mk.index')
                ->with('error', 'Data konversi tidak ditemukan.');
        }

        // Pastikan detail ini milik mahasiswa yang login
        $detail = \App\Models\DetailKonversiSks::with('mataKuliah')
            ->where('id', $id)
            ->where('konversi_sks_id', $konversiSks->id)
            ->firstOrFail();

        // Tidak bisa edit jika sudah diproses/disetujui
        if (in_array($konversiSks->status, ['disetujui', 'diproses'])) {
            return redirect()->route('mahasiswa.konversi-mk.index')
                ->with('error', 'Tidak dapat mengedit saat pengajuan sedang diproses atau sudah disetujui.');
        }

        return view('mahasiswa.konversi-mk.edit', compact(
            'user', 'mahasiswa', 'pendaftaran', 'konversiSks', 'detail'
        ));
    }

    /**
     * Update mata kuliah konversi
     */
    public function updateKonversiMk(Request $request, $id)
    {
        ['pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        if (!$pendaftaran) {
            return redirect()->route('mahasiswa.konversi-mk.index')
                ->with('error', 'Anda belum memiliki pendaftaran MBKM aktif.');
        }

        $konversiSks = $pendaftaran->konversiSks;

        if (!$konversiSks || in_array($konversiSks->status, ['disetujui', 'diproses'])) {
            return redirect()->route('mahasiswa.konversi-mk.index')
                ->with('error', 'Tidak dapat mengedit data konversi saat ini.');
        }

        $detail = \App\Models\DetailKonversiSks::where('id', $id)
            ->where('konversi_sks_id', $konversiSks->id)
            ->firstOrFail();

        $request->validate([
            'kode_mk' => ['required', 'string', 'max:10', 'regex:/^[A-Z]{2}\d{4}$/'],
            'nama_mk' => 'required|string|max:255',
            'sks'     => 'required|integer|min:1|max:24',
        ], [
            'kode_mk.required' => 'Kode mata kuliah wajib diisi.',
            'kode_mk.regex'    => 'Format kode MK tidak valid (contoh: IF1234).',
            'nama_mk.required' => 'Nama mata kuliah wajib diisi.',
            'sks.required'     => 'SKS wajib diisi.',
        ]);

        // Update atau cari MataKuliah dengan kode baru
        $mataKuliah = \App\Models\MataKuliah::firstOrCreate(
            ['kode_mk' => strtoupper($request->kode_mk)],
            [
                'nama_mk' => $request->nama_mk,
                'sks'     => $request->sks,
            ]
        );

        // Update data MK jika sudah ada
        $mataKuliah->update([
            'nama_mk' => $request->nama_mk,
            'sks'     => $request->sks,
        ]);

        // Cek duplikat (kecuali detail yang sedang diedit)
        $alreadyExists = \App\Models\DetailKonversiSks::where('konversi_sks_id', $konversiSks->id)
            ->where('mata_kuliah_id', $mataKuliah->id)
            ->where('id', '!=', $id)
            ->exists();

        if ($alreadyExists) {
            return redirect()->route('mahasiswa.konversi-mk.index')
                ->with('error', 'Mata kuliah ' . $mataKuliah->kode_mk . ' sudah ada dalam daftar konversi.');
        }

        $detail->update(['mata_kuliah_id' => $mataKuliah->id]);

        return redirect()->route('mahasiswa.konversi-mk.index')
            ->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    /**
     * Hapus mata kuliah dari daftar konversi
     */
    public function destroyKonversiMk($id)
    {
        ['pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        if (!$pendaftaran) {
            return redirect()->route('mahasiswa.konversi-mk.index')
                ->with('error', 'Anda belum memiliki pendaftaran MBKM aktif.');
        }

        $konversiSks = $pendaftaran->konversiSks;

        if (!$konversiSks || in_array($konversiSks->status, ['disetujui', 'diproses'])) {
            return redirect()->route('mahasiswa.konversi-mk.index')
                ->with('error', 'Tidak dapat menghapus data konversi saat ini.');
        }

        $detail = \App\Models\DetailKonversiSks::where('id', $id)
            ->where('konversi_sks_id', $konversiSks->id)
            ->firstOrFail();

        $detail->delete();

        return redirect()->route('mahasiswa.konversi-mk.index')
            ->with('success', 'Mata kuliah berhasil dihapus dari daftar konversi.');
    }

    /**
     * Ajukan konversi ke Kaprodi (ubah status jadi 'diproses')
     */
    public function ajukanKonversi(Request $request)
    {
        ['pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        if (!$pendaftaran) {
            return redirect()->route('mahasiswa.konversi-mk.index')
                ->with('error', 'Anda belum memiliki pendaftaran MBKM aktif.');
        }

        $konversiSks = $pendaftaran->konversiSks()->with('detailKonversiSks')->first();

        if (!$konversiSks) {
            return redirect()->route('mahasiswa.konversi-mk.index')
                ->with('error', 'Belum ada daftar konversi. Tambahkan mata kuliah terlebih dahulu.');
        }

        if ($konversiSks->detailKonversiSks->isEmpty()) {
            return redirect()->route('mahasiswa.konversi-mk.index')
                ->with('error', 'Tambahkan minimal 1 mata kuliah sebelum mengajukan konversi.');
        }

        if ($konversiSks->status === 'diproses') {
            return redirect()->route('mahasiswa.konversi-mk.index')
                ->with('error', 'Konversi sudah diajukan dan sedang diproses.');
        }

        if ($konversiSks->status === 'disetujui') {
            return redirect()->route('mahasiswa.konversi-mk.index')
                ->with('error', 'Konversi sudah disetujui.');
        }

        $konversiSks->update(['status' => 'diproses']);

        return redirect()->route('mahasiswa.konversi-mk.index')
            ->with('success', 'Pengajuan konversi mata kuliah berhasil dikirim ke Koordinator Prodi.');
    }

    /**
     * Menampilkan halaman bimbingan
     */
    public function bimbingan()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        $bimbingans = collect();
        $totalBimbingan = 0;
        $syaratMinimal = 4; // Asumsi syarat minimal

        if ($pendaftaran) {
            $bimbingans = \App\Models\Bimbingan::where('pendaftaran_mbkm_id', $pendaftaran->id)
                ->orderBy('created_at', 'desc')
                ->get();
            $totalBimbingan = $bimbingans->count();
        }

        return view('mahasiswa.bimbingan.index', compact('user', 'mahasiswa', 'pendaftaran', 'bimbingans', 'totalBimbingan', 'syaratMinimal'));
    }

    /**
     * Simpan pengajuan bimbingan
     */
    public function storeBimbingan(Request $request)
    {
        ['pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        if (!$pendaftaran) {
            return redirect()->route('mahasiswa.bimbingan.index')
                ->with('error', 'Anda belum memiliki pendaftaran MBKM aktif.');
        }

        $request->validate([
            'topik'        => 'required|string|max:255',
            'tipe'         => 'required|in:online,offline',
            'link_meeting' => 'nullable|required_if:tipe,online|url|max:255',
        ], [
            'topik.required'          => 'Topik bimbingan wajib diisi.',
            'tipe.required'           => 'Tipe pelaksanaan wajib dipilih.',
            'tipe.in'                 => 'Tipe pelaksanaan tidak valid.',
            'link_meeting.required_if'=> 'Link meeting wajib diisi jika tipe pelaksanaan online.',
            'link_meeting.url'        => 'Format link meeting tidak valid.',
        ]);

        \App\Models\Bimbingan::create([
            'pendaftaran_mbkm_id' => $pendaftaran->id,
            'tanggal'             => now()->toDateString(), // Set ke hari pengajuan, nanti bisa diubah dosen/mhs untuk jadwal
            'topik'               => $request->topik,
            'tipe'                => $request->tipe,
            'link_meeting'        => $request->tipe === 'online' ? $request->link_meeting : null,
            'status'              => 'menunggu',
        ]);

        return redirect()->route('mahasiswa.bimbingan.index')
            ->with('success', 'Pengajuan bimbingan berhasil dikirim!');
    }

    // ── Uji Kompetensi: Proposal ──────────────────────────────────────

    /**
     * Menampilkan halaman uji kompetensi proposal
     */
    public function proposal()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        if (!$pendaftaran) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('error', 'Anda belum memiliki pendaftaran MBKM aktif.');
        }

        // Ambil data pengajuan proposal terbaru
        $pengajuan = \App\Models\UjiKompetensi::untukMahasiswa($pendaftaran->id)
            ->proposal()
            ->latest()
            ->first();

        // Riwayat semua pengajuan proposal sebelumnya
        $riwayat = \App\Models\UjiKompetensi::untukMahasiswa($pendaftaran->id)
            ->proposal()
            ->with('dosenPenguji.user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mahasiswa.uji-kompetensi.proposal', compact(
            'user', 'mahasiswa', 'pendaftaran', 'pengajuan', 'riwayat'
        ));
    }

    /**
     * Simpan/ajukan proposal uji kompetensi
     */
    public function storeProposal(Request $request)
    {
        ['pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        if (!$pendaftaran) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('error', 'Anda belum memiliki pendaftaran MBKM aktif.');
        }

        $request->validate([
            'tipe_ujian'  => 'required|in:offline,online',
            'link_daring' => 'nullable|required_if:tipe_ujian,online|url|max:255',
            'file_berkas' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ], [
            'tipe_ujian.required'           => 'Pilih metode ujian terlebih dahulu.',
            'tipe_ujian.in'                 => 'Metode ujian tidak valid.',
            'link_daring.required_if'       => 'Link pelaksanaan ujian wajib diisi untuk ujian daring.',
            'link_daring.url'               => 'Format link tidak valid.',
            'file_berkas.max'               => 'Ukuran file maksimal 10MB.',
        ]);

        $filePath = null;
        if ($request->hasFile('file_berkas')) {
            $filePath = $request->file('file_berkas')->store('uji-kompetensi/proposal', 'public');
        }

        \App\Models\UjiKompetensi::create([
            'pendaftaran_mbkm_id' => $pendaftaran->id,
            'jenis_ujian'         => 'proposal',
            'tipe_ujian'          => $request->tipe_ujian,
            'link_daring'         => $request->tipe_ujian === 'online' ? $request->link_daring : null,
            'file_berkas'         => $filePath,
            'status'              => 'direview',
            'diajukan_at'         => now(),
        ]);

        return redirect()->route('mahasiswa.uji-kompetensi.proposal')
            ->with('success', 'Proposal berhasil diajukan!');
    }

    // ── Uji Kompetensi: Laporan Akhir ─────────────────────────────────

    /**
     * Menampilkan halaman uji kompetensi laporan akhir
     */
    public function laporanAkhir()
    {
        ['user' => $user, 'mahasiswa' => $mahasiswa, 'pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        if (!$pendaftaran) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('error', 'Anda belum memiliki pendaftaran MBKM aktif.');
        }

        // Ambil data pengajuan laporan akhir terbaru
        $pengajuan = \App\Models\UjiKompetensi::untukMahasiswa($pendaftaran->id)
            ->laporanAkhir()
            ->latest()
            ->first();

        // Riwayat semua pengajuan laporan akhir sebelumnya
        $riwayat = \App\Models\UjiKompetensi::untukMahasiswa($pendaftaran->id)
            ->laporanAkhir()
            ->with('dosenPenguji.user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mahasiswa.uji-kompetensi.laporan-akhir', compact(
            'user', 'mahasiswa', 'pendaftaran', 'pengajuan', 'riwayat'
        ));
    }

    /**
     * Simpan/ajukan laporan akhir uji kompetensi
     */
    public function storeLaporanAkhir(Request $request)
    {
        ['pendaftaran' => $pendaftaran] = $this->getMahasiswaData();

        if (!$pendaftaran) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('error', 'Anda belum memiliki pendaftaran MBKM aktif.');
        }

        $request->validate([
            'tipe_ujian'  => 'required|in:offline,online',
            'link_daring' => 'nullable|required_if:tipe_ujian,online|url|max:255',
            'file_berkas' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ], [
            'tipe_ujian.required'           => 'Pilih metode ujian terlebih dahulu.',
            'tipe_ujian.in'                 => 'Metode ujian tidak valid.',
            'link_daring.required_if'       => 'Link pelaksanaan ujian wajib diisi untuk ujian daring.',
            'link_daring.url'               => 'Format link tidak valid.',
            'file_berkas.max'               => 'Ukuran file maksimal 10MB.',
        ]);

        $filePath = null;
        if ($request->hasFile('file_berkas')) {
            $filePath = $request->file('file_berkas')->store('uji-kompetensi/laporan-akhir', 'public');
        }

        \App\Models\UjiKompetensi::create([
            'pendaftaran_mbkm_id' => $pendaftaran->id,
            'jenis_ujian'         => 'laporan_akhir',
            'tipe_ujian'          => $request->tipe_ujian,
            'link_daring'         => $request->tipe_ujian === 'online' ? $request->link_daring : null,
            'file_berkas'         => $filePath,
            'status'              => 'direview',
            'diajukan_at'         => now(),
        ]);

        return redirect()->route('mahasiswa.uji-kompetensi.laporan-akhir')
            ->with('success', 'Laporan akhir berhasil diajukan!');
    }
}
