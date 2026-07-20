<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranMbkm;
use App\Models\UjiKompetensi;
use Illuminate\Support\Facades\Auth;

class DosenPengujiController extends Controller
{
    /**
     * Helper: ambil dosen yang login, abort jika bukan dosen
     */
    private function getDosenOrAbort()
    {
        $dosen = Auth::user()->dosen;
        if (!$dosen) {
            abort(403, 'Akses ditolak.');
        }
        return $dosen;
    }

    /**
     * Menampilkan halaman Dashboard Dosen Penguji
     */
    public function dashboard()
    {
        $dosen = $this->getDosenOrAbort();
        $dosenId = $dosen->id;

        // 1. Mahasiswa Diuji
        $totalMahasiswa = PendaftaranMbkm::where('dosen_penguji_id', $dosenId)
                            ->where('status', 'berjalan')
                            ->count();

        // 2. Menunggu Review (via pendaftaran agar konsisten)
        $menungguReview = UjiKompetensi::whereHas('pendaftaranMbkm', fn($q) =>
                                $q->where('dosen_penguji_id', $dosenId))
                            ->where('status', 'direview')
                            ->count();

        // 3. Sesi Terjadwal
        $sesiTerjadwal = UjiKompetensi::whereHas('pendaftaranMbkm', fn($q) =>
                                $q->where('dosen_penguji_id', $dosenId))
                            ->where('status', 'disetujui')
                            ->where('tgl_ujian', '>=', now()->toDateString())
                            ->count();

        // 4. Telah Selesai
        $telahLulus = UjiKompetensi::whereHas('pendaftaranMbkm', fn($q) =>
                                $q->where('dosen_penguji_id', $dosenId))
                            ->where('status', 'selesai')
                            ->count();

        // Jadwal Ujian Hari Ini
        $jadwalHariIni = UjiKompetensi::whereHas('pendaftaranMbkm', fn($q) =>
                                $q->where('dosen_penguji_id', $dosenId))
                            ->where('status', 'disetujui')
                            ->whereDate('tgl_ujian', now()->toDateString())
                            ->count();

        // Alert Proposal Menunggu
        $menungguProposal = UjiKompetensi::whereHas('pendaftaranMbkm', fn($q) =>
                                $q->where('dosen_penguji_id', $dosenId))
                            ->where('jenis_ujian', 'proposal')
                            ->where('status', 'direview')
                            ->count();

        $perluPerbaikanLaporan = UjiKompetensi::whereHas('pendaftaranMbkm', fn($q) =>
                                $q->where('dosen_penguji_id', $dosenId))
                            ->where('jenis_ujian', 'laporan_akhir')
                            ->where('status', 'revisi')
                            ->count();

        // Tabel Jadwal Mendatang (Top 5)
        $jadwalMendatang = UjiKompetensi::with('pendaftaranMbkm.mahasiswa.user')
                            ->whereHas('pendaftaranMbkm', fn($q) =>
                                $q->where('dosen_penguji_id', $dosenId))
                            ->where('status', 'disetujui')
                            ->where('tgl_ujian', '>=', now()->toDateString())
                            ->orderBy('tgl_ujian', 'asc')
                            ->take(5)
                            ->get();

        // Aktivitas Terbaru
        $aktivitasTerbaru = UjiKompetensi::with('pendaftaranMbkm.mahasiswa.user')
                            ->whereHas('pendaftaranMbkm', fn($q) =>
                                $q->where('dosen_penguji_id', $dosenId))
                            ->orderBy('updated_at', 'desc')
                            ->take(5)
                            ->get();

        return view('dosen-penguji.dashboard.index', compact(
            'totalMahasiswa', 'menungguReview', 'sesiTerjadwal', 'telahLulus',
            'jadwalHariIni', 'menungguProposal', 'perluPerbaikanLaporan',
            'jadwalMendatang', 'aktivitasTerbaru'
        ));
    }

    /**
     * Menampilkan daftar mahasiswa yang diuji
     */
    public function mahasiswa(Request $request)
    {
        $dosen = $this->getDosenOrAbort();

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

    // ── Uji Kompetensi: Proposal ──────────────────────────────────────

    /**
     * Menampilkan halaman review proposal mahasiswa
     */
    public function proposal()
    {
        $dosen = $this->getDosenOrAbort();

        // Proposal menunggu review (status: direview)
        $menungguReview = UjiKompetensi::with([
                'pendaftaranMbkm.mahasiswa.user',
                'pendaftaranMbkm.mahasiswa',
                'pendaftaranMbkm.dokumenMbkms' => fn($q) => $q->where('kode_dokumen', 'proposal_mbkm'),
            ])
            ->where('jenis_ujian', 'proposal')
            ->where('status', 'direview')
            ->whereHas('pendaftaranMbkm', fn($q) =>
                $q->where('dosen_penguji_id', $dosen->id)
            )
            ->orderBy('diajukan_at', 'asc')
            ->get();

        // Monitoring: sudah dijadwalkan (disetujui) atau selesai
        $monitoring = UjiKompetensi::with([
                'pendaftaranMbkm.mahasiswa.user',
                'pendaftaranMbkm.mahasiswa',
                'pendaftaranMbkm.dokumenMbkms' => fn($q) => $q->where('kode_dokumen', 'proposal_mbkm'),
            ])
            ->where('jenis_ujian', 'proposal')
            ->whereIn('status', ['disetujui', 'selesai', 'revisi'])
            ->whereHas('pendaftaranMbkm', fn($q) =>
                $q->where('dosen_penguji_id', $dosen->id)
            )
            ->orderBy('tgl_ujian', 'asc')
            ->get();

        return view('dosen-penguji.uji-kompetensi.proposal', compact(
            'menungguReview', 'monitoring'
        ));
    }

    /**
     * Simpan keputusan validasi proposal (setuju = jadwalkan, revisi = kembalikan)
     */
    public function validasiProposal(Request $request, $id)
    {
        $dosen = $this->getDosenOrAbort();

        $ujian = UjiKompetensi::whereHas('pendaftaranMbkm', fn($q) =>
                    $q->where('dosen_penguji_id', $dosen->id)
                )->where('jenis_ujian', 'proposal')
                 ->where('status', 'direview')
                 ->findOrFail($id);

        $request->validate([
            'keputusan'      => 'required|in:setuju,revisi',
            'catatan_revisi' => 'required_if:keputusan,revisi|nullable|string|max:2000',
            'tgl_ujian'      => 'required_if:keputusan,setuju|nullable|date|after_or_equal:today',
        ], [
            'keputusan.required'         => 'Pilih keputusan terlebih dahulu.',
            'catatan_revisi.required_if' => 'Catatan revisi wajib diisi.',
            'tgl_ujian.required_if'      => 'Tanggal ujian wajib diisi jika setuju.',
            'tgl_ujian.after_or_equal'   => 'Tanggal ujian tidak boleh di masa lalu.',
        ]);

        if ($request->keputusan === 'setuju') {
            $ujian->update([
                'status'           => 'disetujui',
                'tgl_ujian'        => $request->tgl_ujian,
                'catatan_revisi'   => null,
                'dosen_penguji_id' => $dosen->id,
            ]);
            $pesan = 'Proposal disetujui dan jadwal ujian berhasil disimpan.';
        } else {
            $ujian->update([
                'status'         => 'revisi',
                'catatan_revisi' => $request->catatan_revisi,
            ]);
            $pesan = 'Proposal dikembalikan dengan catatan revisi.';
        }

        return redirect()->route('dosen-penguji.uji-kompetensi.proposal')
            ->with('success', $pesan);
    }

    /**
     * Tandai ujian proposal sebagai selesai
     */
    public function selesaikanUjianProposal($id)
    {
        $dosen = $this->getDosenOrAbort();

        $ujian = UjiKompetensi::whereHas('pendaftaranMbkm', fn($q) =>
                    $q->where('dosen_penguji_id', $dosen->id)
                )->where('jenis_ujian', 'proposal')
                 ->where('status', 'disetujui')
                 ->findOrFail($id);

        $ujian->update(['status' => 'selesai']);

        return redirect()->route('dosen-penguji.uji-kompetensi.proposal')
            ->with('success', 'Ujian proposal berhasil diselesaikan.');
    }
    // ── Uji Kompetensi: Laporan Akhir ───────────────────────────────

    /**
     * Menampilkan halaman review laporan akhir mahasiswa
     */
    public function laporan()
    {
        $dosen = $this->getDosenOrAbort();

        // Laporan menunggu review (status: direview)
        $menungguReview = UjiKompetensi::with([
                'pendaftaranMbkm.mahasiswa.user',
                'pendaftaranMbkm.mahasiswa',
                'pendaftaranMbkm.dokumenMbkms' => fn($q) => $q->where('kode_dokumen', 'laporan_mbkm'),
            ])
            ->where('jenis_ujian', 'laporan_akhir')
            ->where('status', 'direview')
            ->whereHas('pendaftaranMbkm', fn($q) =>
                $q->where('dosen_penguji_id', $dosen->id)
            )
            ->orderBy('diajukan_at', 'asc')
            ->get();

        // Monitoring: sudah dijadwalkan (disetujui) atau selesai
        $monitoring = UjiKompetensi::with([
                'pendaftaranMbkm.mahasiswa.user',
                'pendaftaranMbkm.mahasiswa',
                'pendaftaranMbkm.dokumenMbkms' => fn($q) => $q->where('kode_dokumen', 'laporan_mbkm'),
            ])
            ->where('jenis_ujian', 'laporan_akhir')
            ->whereIn('status', ['disetujui', 'selesai', 'revisi'])
            ->whereHas('pendaftaranMbkm', fn($q) =>
                $q->where('dosen_penguji_id', $dosen->id)
            )
            ->orderBy('tgl_ujian', 'asc')
            ->get();

        return view('dosen-penguji.uji-kompetensi.laporan-akhir', compact(
            'menungguReview', 'monitoring'
        ));
    }

    /**
     * Simpan keputusan validasi laporan (setuju = jadwalkan, revisi = kembalikan)
     */
    public function validasiLaporan(Request $request, $id)
    {
        $dosen = $this->getDosenOrAbort();

        $ujian = UjiKompetensi::whereHas('pendaftaranMbkm', fn($q) =>
                    $q->where('dosen_penguji_id', $dosen->id)
                )->where('jenis_ujian', 'laporan_akhir')
                 ->where('status', 'direview')
                 ->findOrFail($id);

        $request->validate([
            'keputusan'      => 'required|in:setuju,revisi',
            'catatan_revisi' => 'required_if:keputusan,revisi|nullable|string|max:2000',
            'tgl_ujian'      => 'required_if:keputusan,setuju|nullable|date|after_or_equal:today',
        ], [
            'keputusan.required'         => 'Pilih keputusan terlebih dahulu.',
            'catatan_revisi.required_if' => 'Catatan revisi wajib diisi.',
            'tgl_ujian.required_if'      => 'Tanggal ujian wajib diisi jika setuju.',
            'tgl_ujian.after_or_equal'   => 'Tanggal ujian tidak boleh di masa lalu.',
        ]);

        if ($request->keputusan === 'setuju') {
            $ujian->update([
                'status'           => 'disetujui',
                'tgl_ujian'        => $request->tgl_ujian,
                'catatan_revisi'   => null,
                'dosen_penguji_id' => $dosen->id,
            ]);
            $pesan = 'Laporan Akhir disetujui dan jadwal ujian berhasil disimpan.';
        } else {
            $ujian->update([
                'status'         => 'revisi',
                'catatan_revisi' => $request->catatan_revisi,
            ]);
            $pesan = 'Laporan Akhir dikembalikan dengan catatan revisi.';
        }

        return redirect()->route('dosen-penguji.uji-kompetensi.laporan-akhir')
            ->with('success', $pesan);
    }

    /**
     * Tandai ujian laporan sebagai selesai
     */
    public function selesaikanUjianLaporan($id)
    {
        $dosen = $this->getDosenOrAbort();

        $ujian = UjiKompetensi::whereHas('pendaftaranMbkm', fn($q) =>
                    $q->where('dosen_penguji_id', $dosen->id)
                )->where('jenis_ujian', 'laporan_akhir')
                 ->where('status', 'disetujui')
                 ->findOrFail($id);

        $ujian->update(['status' => 'selesai']);

        return redirect()->route('dosen-penguji.uji-kompetensi.laporan-akhir')
            ->with('success', 'Ujian Laporan Akhir berhasil diselesaikan.');
    }
}
