<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $path = storage_path('app/users.json');
        $users = [];
        if (file_exists($path)) {
            $jsonString = file_get_contents($path);
            $users = json_decode($jsonString, true) ?? [];
        }

        $userFound = null;
        foreach ($users as $user) {
            if ($user['email'] === $request->email && $user['password'] === $request->password) {
                $userFound = $user;
                break;
            }
        }

        if ($userFound) {
            Session::put('user', $userFound);
            
            if ($userFound['role'] == 'kaprodi') return redirect()->route('kaprodi.dashboard.index');
            if ($userFound['role'] == 'dosen_pembimbing') return redirect()->route('dosen-pembimbing.dashboard.index');
            if ($userFound['role'] == 'dosen_penguji') return redirect()->route('dosen-penguji.dashboard.index');
            if ($userFound['role'] == 'mahasiswa') return redirect()->route('mahasiswa.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau Password salah.'])->withInput();
    }

    public function register()
    {
        return view('auth.register');
    }

    public function processRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'nim' => 'required'
        ]);

        $path = storage_path('app/users.json');
        $users = [];
        if (file_exists($path)) {
            $jsonString = file_get_contents($path);
            $users = json_decode($jsonString, true) ?? [];
        }

        // Cek apakah email sudah terdaftar
        foreach ($users as $user) {
            if ($user['email'] === $request->email) {
                return back()->withErrors(['email' => 'Email sudah terdaftar.'])->withInput();
            }
        }

        $newUser = [
            'id' => count($users) + 1,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'mahasiswa',
            'nim' => $request->nim
        ];

        array_push($users, $newUser);
        file_put_contents($path, json_encode($users, JSON_PRETTY_PRINT));

        return redirect()->route('auth.pending')->with('success', 'Pendaftaran berhasil dikirim.');
    }

    public function pendingConfirmation()
    {
        return view('auth.pending');
    }

    public function logout()
    {
        Session::forget('user');
        return redirect()->route('auth.login');
    }
}
