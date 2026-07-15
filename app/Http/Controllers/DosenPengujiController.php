<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranMbkm;
use App\Models\UjiKompetensi;
use Illuminate\Support\Facades\Auth;

class DosenPengujiController extends Controller
{
    /**
     * Menampilkan halaman Dashboard Dosen Penguji
     */
    public function dashboard()
    {
        // Pastikan user adalah dosen
        $dosen = Auth::user()->dosen;
        if (!$dosen) {
            abort(403, 'Akses ditolak.');
        }

        $dosenId = $dosen->id;

        // 1. Mahasiswa Diuji (Total mahasiswa yang ditugaskan ke penguji ini)
        $totalMahasiswa = PendaftaranMbkm::where('dosen_penguji_id', $dosenId)
                            ->where('status', 'berjalan')
                            ->count();

        // 2. Menunggu Review (Proposal/Laporan dengan status 'diajukan'/'menunggu')
        $menungguReview = UjiKompetensi::where('dosen_penguji_id', $dosenId)
                            ->whereIn('status', ['diajukan', 'menunggu', 'direvisi'])
                            ->count();

        // 3. Sesi Terjadwal (Ujian yang statusnya 'dijadwalkan' dan tanggalnya >= hari ini)
        $sesiTerjadwal = UjiKompetensi::where('dosen_penguji_id', $dosenId)
                            ->where('status', 'dijadwalkan')
                            ->where('tgl_ujian', '>=', now()->toDateString())
                            ->count();

        // 4. Telah Lulus (Ujian dengan status 'lulus'/'disetujui')
        $telahLulus = UjiKompetensi::where('dosen_penguji_id', $dosenId)
                            ->whereIn('status', ['lulus', 'disetujui'])
                            ->count();

        // Jadwal Ujian Hari Ini untuk Alert (Warning)
        $jadwalHariIni = UjiKompetensi::where('dosen_penguji_id', $dosenId)
                            ->where('status', 'dijadwalkan')
                            ->whereDate('tgl_ujian', now()->toDateString())
                            ->count();

        // Alert Merah (Tindakan Diperlukan)
        $menungguProposal = UjiKompetensi::where('dosen_penguji_id', $dosenId)
                            ->where('jenis_ujian', 'proposal')
                            ->whereIn('status', ['diajukan', 'menunggu'])
                            ->count();
                            
        $perluPerbaikanLaporan = UjiKompetensi::where('dosen_penguji_id', $dosenId)
                            ->where('jenis_ujian', 'laporan_akhir')
                            ->where('status', 'direvisi')
                            ->count();

        // Tabel Jadwal Ujian Mendatang (Top 5 jadwal terdekat)
        $jadwalMendatang = UjiKompetensi::with('pendaftaranMbkm.mahasiswa.user')
                            ->where('dosen_penguji_id', $dosenId)
                            ->where('status', 'dijadwalkan')
                            ->where('tgl_ujian', '>=', now()->toDateString())
                            ->orderBy('tgl_ujian', 'asc')
                            ->take(5)
                            ->get();

        // Aktivitas Terbaru (Log aktivitas terakhir)
        $aktivitasTerbaru = UjiKompetensi::with('pendaftaranMbkm.mahasiswa.user')
                            ->where('dosen_penguji_id', $dosenId)
                            ->orderBy('updated_at', 'desc')
                            ->take(5)
                            ->get();

        return view('dosen-penguji.dashboard.index', compact(
            'totalMahasiswa',
            'menungguReview',
            'sesiTerjadwal',
            'telahLulus',
            'jadwalHariIni',
            'menungguProposal',
            'perluPerbaikanLaporan',
            'jadwalMendatang',
            'aktivitasTerbaru'
        ));
    }

    /**
     * Menampilkan daftar mahasiswa yang diuji
     */
    public function mahasiswa(Request $request)
    {
        $dosen = Auth::user()->dosen;
        if (!$dosen) {
            abort(403, 'Akses ditolak.');
        }

        $query = PendaftaranMbkm::with(['mahasiswa.user', 'mitraMbkm'])
                    ->where('dosen_penguji_id', $dosen->id);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('mahasiswa', function($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pendaftarans = $query->latest()->paginate(15)->withQueryString();

        return view('dosen-penguji.mahasiswa.index', compact('pendaftarans'));
    }
}
