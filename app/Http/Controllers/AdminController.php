<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\MitraMbkm;
use App\Models\TenggantDokumen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // ── Dashboard ────────────────────────────────────────────────────
    public function dashboard()
    {
        $stats = [
            'total_mahasiswa' => Mahasiswa::count(),
            'pending'         => User::where('role', 'mahasiswa')->where('is_active', false)->count(),
            'total_dosen'     => Dosen::count(),
            'total_mitra'     => MitraMbkm::count(),
        ];

        $pendaftar_terbaru = User::where('role', 'mahasiswa')
            ->where('is_active', false)
            ->with('mahasiswa')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'pendaftar_terbaru'));
    }

    // ── Daftar Pendaftar Menunggu Konfirmasi ─────────────────────────
    public function pendaftar(Request $request)
    {
        $query = User::where('role', 'mahasiswa')
            ->where('is_active', false)
            ->with('mahasiswa');

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('mahasiswa', fn($m) => $m->where('nim', 'like', "%{$search}%"));
            });
        }

        $pendaftar = $query->latest()->paginate(15);

        return view('admin.pendaftar.index', compact('pendaftar'));
    }

    // ── Konfirmasi / ACC Pendaftar ───────────────────────────────────
    public function konfirmasi(Request $request, $id)
    {
        $user = User::where('role', 'mahasiswa')
            ->where('is_active', false)
            ->findOrFail($id);

        $user->update(['is_active' => true]);

        return redirect()->route('admin.pendaftar.index')
            ->with('success', "Akun mahasiswa \"{$user->name}\" berhasil dikonfirmasi.");
    }

    // ── Tolak / Hapus Pendaftar ──────────────────────────────────────
    public function tolak(Request $request, $id)
    {
        $user = User::where('role', 'mahasiswa')
            ->where('is_active', false)
            ->findOrFail($id);

        $name = $user->name;

        // Hapus record mahasiswa terlebih dahulu (foreign key), lalu user
        $user->mahasiswa()->delete();
        $user->delete();

        return redirect()->route('admin.pendaftar.index')
            ->with('warning', "Pendaftaran atas nama \"{$name}\" telah ditolak dan dihapus.");
    }

    // ── Daftar Semua Mahasiswa (Aktif) ────────────────────────────────
    public function mahasiswa(Request $request)
    {
        $query = User::where('role', 'mahasiswa')
            ->where('is_active', true)
            ->with('mahasiswa');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('mahasiswa', fn($m) => $m->where('nim', 'like', "%{$search}%"));
            });
        }

        $mahasiswas = $query->latest()->paginate(15);

        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    // ── Daftar Semua Dosen ────────────────────────────────────────────
    public function dosen(Request $request)
    {
        $query = User::where('role', 'dosen')
            ->where('is_active', true)
            ->with('dosen');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('dosen', fn($d) => $d->where('nip', 'like', "%{$search}%"));
            });
        }

        $dosens = $query->latest()->paginate(15);

        return view('admin.dosen.index', compact('dosens'));
    }

    // ── Form Create Dosen ─────────────────────────────────────────────
    public function createDosen()
    {
        return view('admin.dosen.create');
    }

    // ── Simpan Dosen Baru ─────────────────────────────────────────────
    public function storeDosen(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|string|min:8|confirmed',
            'nip'         => 'required|string|max:20|unique:dosens,nip',
            'jenis_dosen' => 'required|in:pembimbing,penguji',
            'no_telp'     => 'nullable|string|max:15',
        ], [
            'name.required'        => 'Nama lengkap wajib diisi.',
            'email.required'       => 'Email wajib diisi.',
            'email.unique'         => 'Email sudah terdaftar.',
            'password.required'    => 'Password wajib diisi.',
            'password.min'         => 'Password minimal 8 karakter.',
            'password.confirmed'   => 'Konfirmasi password tidak cocok.',
            'nip.required'         => 'NIP wajib diisi.',
            'nip.unique'           => 'NIP sudah terdaftar.',
            'jenis_dosen.required' => 'Jenis dosen wajib dipilih.',
            'jenis_dosen.in'       => 'Jenis dosen tidak valid.',
        ]);

        // Buat akun User
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => \Hash::make($request->password),
            'role'      => 'dosen',
            'is_active' => true,
        ]);

        // Buat record Dosen
        Dosen::create([
            'user_id'     => $user->id,
            'nip'         => $request->nip,
            'jenis_dosen' => $request->jenis_dosen,
            'no_telp'     => $request->no_telp,
        ]);

        $jenisDosen = $request->jenis_dosen == 'pembimbing' ? 'Pembimbing' : 'Penguji';

        return redirect()->route('admin.dosen.index')
            ->with('success', "Akun dosen {$jenisDosen} \"{$user->name}\" berhasil dibuat.");
    }

    // ── Hapus Dosen ───────────────────────────────────────────────────
    public function destroyDosen($id)
    {
        $user = User::where('role', 'dosen')
            ->where('is_active', true)
            ->findOrFail($id);

        $name = $user->name;

        // Hapus record dosen terlebih dahulu (foreign key), lalu user
        $user->dosen()->delete();
        $user->delete();

        return redirect()->route('admin.dosen.index')
            ->with('success', "Akun dosen \"{$name}\" berhasil dihapus.");
    }

    // ── Daftar Semua Mitra ────────────────────────────────────────────
    public function mitra(Request $request)
    {
        $query = MitraMbkm::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_mitra', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        $mitras = $query->latest()->paginate(15);

        return view('admin.mitra.index', compact('mitras'));
    }

    // ── Form Create Mitra ─────────────────────────────────────────────
    public function createMitra()
    {
        return view('admin.mitra.create');
    }

    // ── Simpan Mitra Baru ─────────────────────────────────────────────
    public function storeMitra(Request $request)
    {
        $request->validate([
            'nama_mitra'        => 'required|string|max:255',
            'alamat'            => 'required|string|max:1000',
            'lokasi'            => 'required|string|max:255',
            'narahubung'        => 'required|string|max:255',
            'no_telp_narahubung'=> 'required|string|max:20',
        ], [
            'nama_mitra.required'        => 'Nama mitra wajib diisi.',
            'alamat.required'            => 'Alamat wajib diisi.',
            'lokasi.required'            => 'Lokasi wajib diisi.',
            'narahubung.required'        => 'Narahubung wajib diisi.',
            'no_telp_narahubung.required'=> 'No. telepon narahubung wajib diisi.',
        ]);

        MitraMbkm::create($request->all());

        return redirect()->route('admin.mitra.index')
            ->with('success', "Mitra \"{$request->nama_mitra}\" berhasil ditambahkan.");
    }

    // ── Form Edit Mitra ───────────────────────────────────────────────
    public function editMitra($id)
    {
        $mitra = MitraMbkm::findOrFail($id);
        return view('admin.mitra.edit', compact('mitra'));
    }

    // ── Update Mitra ──────────────────────────────────────────────────
    public function updateMitra(Request $request, $id)
    {
        $mitra = MitraMbkm::findOrFail($id);

        $request->validate([
            'nama_mitra'        => 'required|string|max:255',
            'alamat'            => 'required|string|max:1000',
            'lokasi'            => 'required|string|max:255',
            'narahubung'        => 'required|string|max:255',
            'no_telp_narahubung'=> 'required|string|max:20',
        ]);

        $mitra->update($request->all());

        return redirect()->route('admin.mitra.index')
            ->with('success', "Mitra \"{$mitra->nama_mitra}\" berhasil diperbarui.");
    }

    // ── Hapus Mitra ───────────────────────────────────────────────────
    public function destroyMitra($id)
    {
        $mitra = MitraMbkm::findOrFail($id);
        $name = $mitra->nama_mitra;
        $mitra->delete();

        return redirect()->route('admin.mitra.index')
            ->with('success', "Mitra \"{$name}\" berhasil dihapus.");
    }

    // ── Daftar Semua Kaprodi ──────────────────────────────────────────
    public function kaprodi(Request $request)
    {
        $query = User::where('role', 'kaprodi')
            ->where('is_active', true);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $kaprodis = $query->latest()->paginate(15);

        return view('admin.kaprodi.index', compact('kaprodis'));
    }

    // ── Form Create Kaprodi ───────────────────────────────────────────
    public function createKaprodi()
    {
        return view('admin.kaprodi.create');
    }

    // ── Simpan Kaprodi Baru ───────────────────────────────────────────
    public function storeKaprodi(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required'      => 'Nama lengkap wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.unique'       => 'Email sudah terdaftar.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'kaprodi',
            'is_active' => true,
        ]);

        return redirect()->route('admin.kaprodi.index')
            ->with('success', "Akun Kaprodi \"{$user->name}\" berhasil dibuat.");
    }

    // ── Manajemen Tenggat Dokumen ──────────────────────────────────────
    public function tenggat()
    {
        $tenggats = TenggantDokumen::ordered()->get()->groupBy('kategori');
        $kategoris = TenggantDokumen::kategoris();
        return view('admin.tenggat-dokumen.index', compact('tenggats', 'kategoris'));
    }

    public function updateTenggat(Request $request, $id)
    {
        $tenggat = TenggantDokumen::findOrFail($id);

        $request->validate([
            'tenggat_waktu' => 'nullable|date|after_or_equal:today',
        ], [
            'tenggat_waktu.after_or_equal' => 'Tanggal tenggat tidak boleh di masa lalu.',
        ]);

        $tenggat->update([
            'tenggat_waktu' => $request->tenggat_waktu ?: null,
        ]);

        return back()->with('success', "Tenggat waktu untuk \"{$tenggat->nama_dokumen}\" berhasil diperbarui.");
    }

    public function resetTenggat($id)
    {
        $tenggat = TenggantDokumen::findOrFail($id);
        $tenggat->update(['tenggat_waktu' => null]);
        return back()->with('success', "Tenggat waktu untuk \"{$tenggat->nama_dokumen}\" berhasil direset.");
    }
}

