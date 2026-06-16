<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ── Halaman Login ────────────────────────────────────────────────
    public function login()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }
        return view('auth.login');
    }

    // ── Proses Login ─────────────────────────────────────────────────
    public function processLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Cari user terlebih dahulu untuk cek is_active
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email atau Password salah.'])->withInput();
        }

        // Cek apakah password cocok
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Email atau Password salah.'])->withInput();
        }

        // Cek apakah akun sudah diaktifkan admin
        if (!$user->is_active) {
            return redirect()->route('auth.pending')
                ->with('info', 'Akun Anda masih menunggu konfirmasi dari Admin.');
        }

        // Login user
        Auth::login($user, true);
        $request->session()->regenerate();

        return $this->redirectByRole($user->role);
    }

    // ── Helper: Redirect berdasarkan role ────────────────────────────
    private function redirectByRole(string $role)
    {
        if ($role === 'dosen') {
            // Ambil jenis dosen dari relasi
            $user = Auth::user();
            $dosen = $user->dosen;
            
            if ($dosen && $dosen->jenis_dosen === 'penguji') {
                return redirect()->route('dosen-penguji.dashboard.index');
            }
            
            // Default ke dosen pembimbing jika tidak ada data atau pembimbing
            return redirect()->route('dosen-pembimbing.dashboard.index');
        }
        
        return match ($role) {
            'admin'     => redirect()->route('admin.dashboard'),
            'kaprodi'   => redirect()->route('kaprodi.dashboard.index'),
            'mahasiswa' => redirect()->route('mahasiswa.dashboard'),
            default     => redirect()->route('auth.login'),
        };
    }

    // ── Halaman Register ─────────────────────────────────────────────
    public function register()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }
        return view('auth.register');
    }

    // ── Proses Register ──────────────────────────────────────────────
    public function processRegister(Request $request)
    {
        $request->validate([
            'name_mhs'                  => 'required|string|max:255',
            'nim'                       => 'required|string|max:20|unique:mahasiswas,nim',
            'angkatan'                  => 'required|integer|min:2000|max:2099',
            'email_mhs'                 => 'required|email|unique:users,email',
            'password_mhs'              => 'required|string|min:8|confirmed',
            'password_mhs_confirmation' => 'required',
        ], [
            'name_mhs.required'     => 'Nama lengkap wajib diisi.',
            'nim.required'          => 'NIM wajib diisi.',
            'nim.unique'            => 'NIM sudah terdaftar.',
            'angkatan.required'     => 'Angkatan wajib dipilih.',
            'email_mhs.required'    => 'Email wajib diisi.',
            'email_mhs.unique'      => 'Email sudah terdaftar.',
            'password_mhs.min'      => 'Password minimal 8 karakter.',
            'password_mhs.confirmed'=> 'Konfirmasi password tidak cocok.',
        ]);

        // Buat akun User (is_active = false, role = mahasiswa by default)
        $user = User::create([
            'name'      => $request->name_mhs,
            'email'     => $request->email_mhs,
            'password'  => Hash::make($request->password_mhs),
            'role'      => 'mahasiswa',
            'is_active' => false,
        ]);

        // Buat record Mahasiswa terkait
        Mahasiswa::create([
            'user_id'  => $user->id,
            'nim'      => $request->nim,
            'angkatan' => $request->angkatan,
            'prodi'    => 'Ilmu Komputer',
        ]);

        return redirect()->route('auth.pending')
            ->with('success', 'Pendaftaran berhasil! Akun Anda sedang menunggu konfirmasi dari Admin.');
    }

    // ── Halaman Pending Konfirmasi ───────────────────────────────────
    public function pendingConfirmation()
    {
        return view('auth.pending');
    }

    // ── Halaman Quick Switch (untuk testing) ────────────────────────
    public function quickSwitch()
    {
        return view('auth.quick-switch');
    }

    // ── Quick Login (untuk testing) ──────────────────────────────────
    public function quickLogin(Request $request)
    {
        // Hanya untuk development/testing
        if (app()->environment('production')) {
            abort(404);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $user = User::where('email', $request->email)->first();

        if (!$user || !\Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Login gagal!');
        }

        if (!$user->is_active) {
            return redirect()->route('auth.pending')
                ->with('info', 'Akun Anda masih menunggu konfirmasi dari Admin.');
        }

        Auth::login($user, true);
        $request->session()->regenerate();

        return $this->redirectByRole($user->role);
    }

    // ── Logout ───────────────────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login')
            ->with('success', 'Anda berhasil keluar dari sistem.');
    }
}
