<?php

namespace App\Http\Controllers;

use App\Models\KonversiSks;
use App\Models\PendaftaranMbkm;
use App\Models\Penilaian;
use App\Models\DetailKonversiSks;
use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    /**
     * Menampilkan dashboard kaprodi dengan data real dari DB
     */
    public function dashboard()
    {
        // ── Statistik Kartu ─────────────────────────────────────────────
        $totalMahasiswa   = PendaftaranMbkm::count();
        $sedangBerjalan   = PendaftaranMbkm::where('status', 'berjalan')->count();
        $selesai          = PendaftaranMbkm::where('status', 'selesai')->count();
        $menungguValidasi = PendaftaranMbkm::where('status', 'menunggu')->count();

        // ── Data Donut Chart ─────────────────────────────────────────────
        // Persentase berdasarkan total (hindari division by zero)
        $pctBerjalan = $totalMahasiswa > 0 ? round($sedangBerjalan / $totalMahasiswa * 100) : 0;
        $pctSelesai  = $totalMahasiswa > 0 ? round($selesai / $totalMahasiswa * 100) : 0;
        $pctLainnya  = max(0, 100 - $pctBerjalan - $pctSelesai);

        // conic-gradient: berjalan → selesai → lainnya
        $chartGradient = "conic-gradient(
            #2563eb 0% {$pctBerjalan}%,
            #475569 {$pctBerjalan}% " . ($pctBerjalan + $pctSelesai) . "%,
            #e2e8f0 " . ($pctBerjalan + $pctSelesai) . "% 100%
        )";

        // ── Status Kepatuhan ─────────────────────────────────────────────
        // "Sesuai Syarat": mahasiswa berjalan/selesai yang sudah punya konversi disetujui
        $sesuaiSyarat = PendaftaranMbkm::whereIn('status', ['berjalan', 'selesai'])
            ->whereHas('konversiSks', fn($q) => $q->where('status', 'disetujui'))
            ->count();

        $totalAktif    = PendaftaranMbkm::whereIn('status', ['berjalan', 'selesai'])->count();
        $perluPerhatian = max(0, $totalAktif - $sesuaiSyarat);

        // ── Antrian Aksi (Tindakan Diperlukan) ──────────────────────────
        $antrianPengajuan  = PendaftaranMbkm::where('status', 'menunggu')->count();
        $antrianKonversi   = KonversiSks::where('status', 'diproses')->count();
        $antrianNilai      = KonversiSks::where('status', 'disetujui')
            ->where('status_penilaian', 'menunggu')
            ->whereHas('pendaftaranMbkm', fn($q) => $q->whereHas('penilaians'))
            ->count();

        // ── Aktivitas Terkini ────────────────────────────────────────────
        // Gabungkan: konversi terbaru + penilaian terbaru, ambil 5 terakhir
        $recentKonversi = KonversiSks::with('pendaftaranMbkm.mahasiswa.user')
            ->whereIn('status', ['diproses', 'disetujui'])
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($k) => [
                'nama'   => $k->pendaftaranMbkm?->mahasiswa?->user?->name ?? 'Mahasiswa',
                'aksi'   => $k->status === 'disetujui' ? 'konversi MK telah disetujui.' : 'mengajukan konversi mata kuliah.',
                'warna'  => $k->status === 'disetujui' ? 'green' : 'yellow',
                'waktu'  => $k->updated_at,
            ]);

        $recentPenilaian = Penilaian::with('pendaftaranMbkm.mahasiswa.user')
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($p) => [
                'nama'  => $p->pendaftaranMbkm?->mahasiswa?->user?->name ?? 'Dosen',
                'aksi'  => 'mendapat nilai ' . $p->jenis_penilai . ': ' . $p->nilai_total . '.',
                'warna' => 'blue',
                'waktu' => $p->created_at,
            ]);

        $aktivitasTerkini = $recentKonversi->concat($recentPenilaian)
            ->sortByDesc('waktu')
            ->take(4)
            ->values();

        // ── Analisis Sebaran Program MBKM ────────────────────────────────
        $sebaranProgram = PendaftaranMbkm::select('program_mbkm_id', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->with('programMbkm')
            ->groupBy('program_mbkm_id')
            ->orderByDesc('total')
            ->get()
            ->map(function ($item) use ($totalMahasiswa) {
                $pct = $totalMahasiswa > 0 ? round(($item->total / $totalMahasiswa) * 100) : 0;
                return [
                    'nama' => $item->programMbkm->nama ?? 'Tidak Diketahui',
                    'total' => $item->total,
                    'persentase' => $pct
                ];
            });

        // ── Analisis Mitra MBKM Terfavorit ───────────────────────────────
        $topMitra = PendaftaranMbkm::select('mitra_mbkm_id', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->with('mitraMbkm')
            ->groupBy('mitra_mbkm_id')
            ->orderByDesc('total')
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'nama' => $item->mitraMbkm->nama ?? 'Tidak Diketahui',
                    'total' => $item->total
                ];
            });

        return view('kaprodi.dashboard', compact(
            'totalMahasiswa', 'sedangBerjalan', 'selesai', 'menungguValidasi',
            'pctBerjalan', 'pctSelesai', 'pctLainnya', 'chartGradient',
            'sesuaiSyarat', 'perluPerhatian',
            'antrianPengajuan', 'antrianKonversi', 'antrianNilai',
            'aktivitasTerkini', 'sebaranProgram', 'topMitra'
        ));
    }


    /**
     * Menampilkan data mahasiswa MBKM
     */
    public function dataMahasiswa(Request $request)
    {
        $query = PendaftaranMbkm::with(['mahasiswa.user', 'dosenPembimbing.user', 'mitraMbkm']);

        // Filter Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pendaftarans = $query->latest()->paginate(10)->withQueryString();

        // Hitung Progress untuk setiap pendaftaran
        $pendaftarans->getCollection()->transform(function ($p) {
            $progress = 0;
            if ($p->tgl_mulai && $p->tgl_selesai) {
                $totalDays = \Carbon\Carbon::parse($p->tgl_mulai)->diffInDays($p->tgl_selesai);
                if ($totalDays > 0) {
                    $daysPassed = \Carbon\Carbon::parse($p->tgl_mulai)->diffInDays(now(), false);
                    $progress = max(0, min(100, round(($daysPassed / $totalDays) * 100)));
                }
            }
            if ($p->status === 'selesai') {
                $progress = 100;
            } elseif ($p->status === 'menunggu') {
                $progress = 0;
            }
            $p->progress = $progress;
            return $p;
        });

        // Top Cards Statistics
        $totalMahasiswa = PendaftaranMbkm::count();
        $sedangBerjalan = PendaftaranMbkm::where('status', 'berjalan')->count();
        $selesai        = PendaftaranMbkm::where('status', 'selesai')->count();

        return view('kaprodi.data-mahasiswa', compact('pendaftarans', 'totalMahasiswa', 'sedangBerjalan', 'selesai'));
    }

    /**
     * Menampilkan daftar mitra MBKM
     */
    public function mitraMbkm(Request $request)
    {
        $query = \App\Models\MitraMbkm::withCount('pendaftaranMbkm');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_mitra', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
        }

        $mitras = $query->orderByDesc('pendaftaran_mbkm_count')->paginate(10)->withQueryString();

        return view('kaprodi.mitra-mbkm.index', compact('mitras'));
    }

    /**
     * Menampilkan detail mitra MBKM beserta daftar mahasiswa magang
     */
    public function mitraMbkmDetail(Request $request, $id)
    {
        $mitra = \App\Models\MitraMbkm::findOrFail($id);

        $query = PendaftaranMbkm::with(['mahasiswa.user', 'dosenPembimbing.user', 'programMbkm'])
            ->where('mitra_mbkm_id', $id);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('mahasiswa.user', function($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%");
                })->orWhereHas('mahasiswa', function($q2) use ($search) {
                    $q2->where('nim', 'like', "%{$search}%");
                });
            });
        }

        $mahasiswas = $query->latest()->paginate(10)->withQueryString();

        return view('kaprodi.mitra-mbkm.detail', compact('mitra', 'mahasiswas'));
    }

    /**
     * Menampilkan halaman assign pembimbing & penguji
     */
    public function assignPembimbing(Request $request)
    {
        $query = PendaftaranMbkm::with([
            'mahasiswa.user',
            'mitraMbkm',
            'dosenPembimbing.user',
            'dosenPenguji.user',
            'programMbkm'
        ])->whereIn('status', ['menunggu', 'berjalan']);

        // Filter search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        // Filter status assign
        if ($request->filled('status')) {
            if ($request->status === 'belum_assign') {
                $query->where(function($q) {
                    $q->whereNull('dosen_pembimbing_id')->orWhereNull('dosen_penguji_id');
                });
            } elseif ($request->status === 'sudah_assign') {
                $query->whereNotNull('dosen_pembimbing_id')->whereNotNull('dosen_penguji_id');
            }
        }

        $pendaftarans = $query->latest()->paginate(10)->withQueryString();
        
        $dosens = \App\Models\Dosen::with('user')->get();

        return view('kaprodi.assign-pembimbing.index', compact('pendaftarans', 'dosens'));
    }

    /**
     * Menyimpan assign dosen pembimbing dan penguji
     */
    public function storeAssignPembimbing(Request $request, $id)
    {
        $request->validate([
            'dosen_pembimbing_id' => 'required|exists:dosens,id',
            'dosen_penguji_id' => 'required|exists:dosens,id',
        ]);

        $pendaftaran = PendaftaranMbkm::findOrFail($id);
        $pendaftaran->update([
            'dosen_pembimbing_id' => $request->dosen_pembimbing_id,
            'dosen_penguji_id' => $request->dosen_penguji_id,
        ]);

        return back()->with('success', 'Dosen Pembimbing dan Penguji berhasil diassign.');
    }

    /**
     * Menampilkan halaman penilaian MBKM (data dinamis dari DB)
     */
    public function penilaianMbkm(Request $request)
    {
        // Ambil semua pendaftaran yang sudah berjalan/selesai dengan relasi lengkap
        $query = PendaftaranMbkm::with([
                'mahasiswa.user',
                'mitraMbkm',
                'penilaians',
                'konversiSks.detailKonversiSks',
            ])
            ->whereIn('status', ['berjalan', 'selesai']);

        // Filter pencarian nama / NIM
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        // Filter status penilaian
        if ($request->filled('status')) {
            $status = $request->status;
            if ($status === 'belum_lengkap') {
                $query->where(function ($q) {
                    $q->whereDoesntHave('penilaians')
                      ->orWhereHas('konversiSks', fn($k) => $k->where('status', '!=', 'disetujui'));
                });
            } elseif ($status === 'siap_acc') {
                $query->whereHas('konversiSks', fn($k) => $k->where('status', 'disetujui')
                                                             ->where('status_penilaian', 'menunggu'))
                      ->whereHas('penilaians');
            } elseif ($status === 'selesai_acc') {
                $query->whereHas('konversiSks', fn($k) => $k->where('status_penilaian', 'selesai'));
            }
        }

        $pendaftarans = $query->latest()->paginate(20)->withQueryString();

        // Statistik kartu
        $allPendaftaran = PendaftaranMbkm::whereIn('status', ['berjalan', 'selesai'])
            ->with(['penilaians', 'konversiSks'])->get();

        $totalMahasiswa = $allPendaftaran->count();

        $menungguNilai = $allPendaftaran->filter(function ($p) {
            $konversi = $p->konversiSks;
            if (!$konversi || $konversi->status !== 'disetujui') return false;
            return $p->penilaians->isEmpty();
        })->count();

        $siapAcc = $allPendaftaran->filter(function ($p) {
            $konversi = $p->konversiSks;
            if (!$konversi || $konversi->status !== 'disetujui') return false;
            if ($konversi->status_penilaian === 'selesai') return false;
            return $p->penilaians->isNotEmpty();
        })->count();

        $selesaiAcc = $allPendaftaran->filter(function ($p) {
            $konversi = $p->konversiSks;
            return $konversi && $konversi->status_penilaian === 'selesai';
        })->count();

        $stats = compact('totalMahasiswa', 'menungguNilai', 'siapAcc', 'selesaiAcc');

        return view('kaprodi.penilaian-mbkm.index', compact('pendaftarans', 'stats'));
    }

    /**
     * Menampilkan form penilaian & konversi untuk 1 mahasiswa
     */
    public function penilaianForm($id)
    {
        $pendaftaran = PendaftaranMbkm::with([
            'mahasiswa.user',
            'mitraMbkm',
            'penilaians',
            'konversiSks.detailKonversiSks.mataKuliah',
        ])->findOrFail($id);

        // Ambil nilai per jenis penilai
        $nilaiPembimbing = $pendaftaran->penilaians->firstWhere('jenis_penilai', 'pembimbing')?->nilai_total;
        $nilaiPenguji    = $pendaftaran->penilaians->firstWhere('jenis_penilai', 'penguji')?->nilai_total;
        $nilaiMitra      = $pendaftaran->penilaians->firstWhere('jenis_penilai', 'mitra')?->nilai_total;

        // Hitung nilai final (rata-rata dari nilai yang sudah ada)
        $scores = array_filter([$nilaiPembimbing, $nilaiPenguji, $nilaiMitra], fn($v) => $v !== null);
        $nilaiAkhir = count($scores) > 0 ? round(array_sum($scores) / count($scores), 1) : null;

        // Konversi nilai angka ke huruf
        $nilaiHurufFinal = $this->hitungNilaiHuruf($nilaiAkhir);

        // Daftar mata kuliah dari konversi yang sudah disetujui
        $konversiSks = $pendaftaran->konversiSks;
        $details     = $konversiSks?->detailKonversiSks ?? collect();
        $totalSks    = $details->sum(fn($d) => $d->mataKuliah?->sks ?? 0);

        return view('kaprodi.penilaian-mbkm.form', compact(
            'pendaftaran', 'konversiSks', 'details', 'totalSks',
            'nilaiPembimbing', 'nilaiPenguji', 'nilaiMitra',
            'nilaiAkhir', 'nilaiHurufFinal'
        ));
    }

    /**
     * Simpan nilai huruf per mata kuliah & sahkan penilaian
     */
    public function simpanPenilaian(Request $request, $id)
    {
        $pendaftaran = PendaftaranMbkm::with('konversiSks.detailKonversiSks')->findOrFail($id);
        $konversiSks = $pendaftaran->konversiSks;

        if (!$konversiSks) {
            return back()->with('error', 'Data konversi mata kuliah tidak ditemukan.');
        }

        // Validasi: setiap detail harus punya nilai_huruf
        $rules   = [];
        $messages = [];
        foreach ($konversiSks->detailKonversiSks as $detail) {
            $rules["nilai_huruf.{$detail->id}"] = 'required|in:A,A-,B+,B,B-,C+,C,D,E';
            $messages["nilai_huruf.{$detail->id}.required"] = 'Nilai huruf untuk semua mata kuliah wajib diisi.';
            $messages["nilai_huruf.{$detail->id}.in"]       = 'Nilai huruf tidak valid.';
        }

        $request->validate($rules, $messages);

        // Simpan nilai huruf per detail mata kuliah
        foreach ($konversiSks->detailKonversiSks as $detail) {
            $nilaiHuruf = $request->input("nilai_huruf.{$detail->id}");

            // Konversi nilai huruf ke angka untuk disimpan di nilai_diakui
            $nilaiAngka = $this->nilaiHurufKeAngka($nilaiHuruf);

            $detail->update([
                'nilai_huruf' => $nilaiHuruf,
                'nilai_diakui' => $nilaiAngka,
            ]);
        }

        // Update status penilaian menjadi selesai
        $konversiSks->update(['status_penilaian' => 'selesai']);

        return redirect()->route('kaprodi.penilaian-mbkm.index')
            ->with('success', 'Nilai konversi berhasil disahkan untuk mahasiswa ' . ($pendaftaran->mahasiswa->user->name ?? '-') . '.');
    }

    /**
     * Menampilkan halaman konversi SKS (data dinamis dari DB)
     */
    public function konversiSks(Request $request)
    {
        $query = KonversiSks::with([
                'pendaftaranMbkm.mahasiswa.user',
                'pendaftaranMbkm.mitraMbkm',
                'detailKonversiSks.mataKuliah',
            ])
            ->whereIn('status', ['diproses', 'disetujui']);

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('pendaftaranMbkm.mahasiswa', function ($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $konversis = $query->latest()->paginate(20)->withQueryString();

        // Statistik
        $totalMenunggu = KonversiSks::where('status', 'diproses')->count();
        $totalDisetujui = KonversiSks::where('status', 'disetujui')->count();

        return view('kaprodi.penilaian-mbkm.konversi', compact('konversis', 'totalMenunggu', 'totalDisetujui'));
    }

    /**
     * ACC (setujui) pengajuan konversi mata kuliah dari mahasiswa
     */
    public function accKonversi(Request $request, $id)
    {
        $konversiSks = KonversiSks::with('pendaftaranMbkm.mahasiswa.user')->findOrFail($id);

        if ($konversiSks->status !== 'diproses') {
            return back()->with('error', 'Pengajuan ini tidak dalam status menunggu ACC.');
        }

        $konversiSks->update(['status' => 'disetujui']);

        $namaMahasiswa = $konversiSks->pendaftaranMbkm->mahasiswa->user->name ?? '-';

        return back()->with('success', "Konversi mata kuliah {$namaMahasiswa} berhasil disetujui.");
    }

    /**
     * Menampilkan halaman Laporan MBKM
     */
    public function laporanMbkm(Request $request)
    {
        $query = PendaftaranMbkm::with([
            'mahasiswa.user',
            'mitraMbkm',
            'konversiSks.detailKonversiSks.mataKuliah',
            'penilaians'
        ]);

        // Filter Status MBKM
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter Mitra
        if ($request->filled('mitra_mbkm_id')) {
            $query->where('mitra_mbkm_id', $request->mitra_mbkm_id);
        }

        // Filter Periode
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->where(function($q) use ($request) {
                $q->whereBetween('tgl_mulai', [$request->start_date, $request->end_date])
                  ->orWhereBetween('tgl_selesai', [$request->start_date, $request->end_date]);
            });
        }

        // Filter Status Penilaian
        if ($request->filled('status_penilaian')) {
            $statusPenilaian = $request->status_penilaian;
            if ($statusPenilaian === 'lengkap') {
                $query->whereHas('konversiSks', fn($k) => $k->where('status_penilaian', 'selesai'));
            } elseif ($statusPenilaian === 'sebagian') {
                $query->whereHas('penilaians')
                      ->whereHas('konversiSks', fn($k) => $k->where('status_penilaian', '!=', 'selesai'));
            } elseif ($statusPenilaian === 'belum') {
                $query->whereDoesntHave('penilaians')
                      ->where(function($q) {
                          $q->whereDoesntHave('konversiSks')
                            ->orWhereHas('konversiSks', fn($k) => $k->where('status_penilaian', 'menunggu'));
                      });
            }
        }

        $laporans = $query->latest()->paginate(20)->withQueryString();

        // Calculate statistics for Top Cards
        $allPendaftaran = PendaftaranMbkm::with(['konversiSks.detailKonversiSks.mataKuliah', 'mitraMbkm'])->get();
        $totalMahasiswa = $allPendaftaran->count();
        
        // Rata-rata Nilai: using nilai_diakui from detailKonversiSks where konversiSks status_penilaian is selesai
        $totalNilai = 0;
        $totalMataKuliahDinilai = 0;
        $totalSksTerkonversi = 0;
        $mitraTerlibat = [];

        foreach ($allPendaftaran as $p) {
            if ($p->mitraMbkm) {
                $mitraTerlibat[$p->mitra_mbkm_id] = true;
            }
            if ($p->konversiSks && $p->konversiSks->status_penilaian === 'selesai' && $p->konversiSks->status === 'disetujui') {
                foreach ($p->konversiSks->detailKonversiSks as $detail) {
                    if ($detail->nilai_diakui !== null) {
                        $totalNilai += $detail->nilai_diakui;
                        $totalMataKuliahDinilai++;
                        $totalSksTerkonversi += ($detail->mataKuliah->sks ?? 0);
                    }
                }
            }
        }

        $rataRataNilai = $totalMataKuliahDinilai > 0 ? round($totalNilai / $totalMataKuliahDinilai, 2) : 0;
        $jumlahMitra = count($mitraTerlibat);

        $mitras = \App\Models\MitraMbkm::orderBy('nama_mitra')->get();

        return view('kaprodi.laporan-mbkm.index', compact(
            'laporans', 'totalMahasiswa', 'rataRataNilai', 'totalSksTerkonversi', 'jumlahMitra', 'mitras'
        ));
    }

    // ── Helper Methods ──────────────────────────────────────────────────

    /**
     * Konversi nilai angka ke nilai huruf
     */
    private function hitungNilaiHuruf(?float $nilai): string
    {
        if ($nilai === null) return '-';
        if ($nilai >= 85) return 'A';
        if ($nilai >= 80) return 'A-';
        if ($nilai >= 75) return 'B+';
        if ($nilai >= 70) return 'B';
        if ($nilai >= 65) return 'B-';
        if ($nilai >= 60) return 'C+';
        if ($nilai >= 55) return 'C';
        if ($nilai >= 40) return 'D';
        return 'E';
    }

    /**
     * Konversi nilai huruf ke nilai angka (untuk disimpan di nilai_diakui)
     */
    private function nilaiHurufKeAngka(string $huruf): float
    {
        return match($huruf) {
            'A'  => 4.0,
            'A-' => 3.7,
            'B+' => 3.3,
            'B'  => 3.0,
            'B-' => 2.7,
            'C+' => 2.3,
            'C'  => 2.0,
            'D'  => 1.0,
            'E'  => 0.0,
            default => 0.0,
        };
    }
}
