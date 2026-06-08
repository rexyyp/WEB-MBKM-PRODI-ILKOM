<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        
        // Mock validation error
        return back()->withErrors(['email' => 'Email atau Password salah (Ini simulasi backend).'])->withInput();
    }

    public function register()
    {
        return view('auth.register');
    }

    public function processRegister(Request $request)
    {
        // Mock successful registration
        return redirect()->route('auth.pending')->with('success', 'Pendaftaran berhasil dikirim.');
    }

    public function pendingConfirmation()
    {
        return view('auth.pending');
    }
}
