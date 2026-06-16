<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\MitraMbkm;
use App\Models\User;
use Illuminate\Http\Request;

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
}
