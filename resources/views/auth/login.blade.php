@extends('layouts.auth')

@section('title', 'Login - MBKM System')

@section('content')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.7s ease-out forwards;
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
    .glass-panel {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
</style>

<div class="min-h-screen flex bg-slate-50">
    {{-- Left Panel: Hero Section (Hidden on mobile) --}}
    <div class="hidden lg:flex lg:w-[45%] bg-gradient-to-br from-blue-800 to-blue-500 items-center justify-center relative overflow-hidden">
        {{-- Decorative Blobs --}}
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-sky-400 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-4000"></div>
        
        {{-- Abstract Pattern Grid Overlay --}}
        <div class="absolute inset-0 opacity-[0.05]" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 32px 32px;"></div>
        
        <div class="relative z-10 w-full max-w-lg px-12 text-white flex flex-col justify-center h-full">
            {{-- Illustration Element --}}
            <div class="mb-14 relative">
                <div class="absolute inset-0 bg-white/20 blur-2xl rounded-full"></div>
                <div class="relative glass-panel rounded-3xl p-6 inline-flex items-center justify-center shadow-2xl">
                    <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5.581m0 0H9m5.581 0a2 2 0 110-4m0 4a2 2 0 110 4m0-4V9m0 4H4m5.581 8H9"></path>
                    </svg>
                </div>
            </div>
            
            <h1 class="text-5xl font-black mb-6 leading-[1.15] tracking-tight text-white">
                Mulai Perjalanan<br>
                <span class="text-yellow-300">Karirmu Di Sini.</span>
            </h1>
            <p class="text-blue-100/90 text-lg font-light leading-relaxed max-w-md">
                Sistem Informasi Manajemen Merdeka Belajar Kampus Merdeka (MBKM) Program Studi Ilmu Komputer.
            </p>
            
            {{-- Simple interactive dots for aesthetic --}}
            <div class="flex gap-2 mt-12">
                <div class="w-8 h-1.5 bg-white rounded-full"></div>
                <div class="w-1.5 h-1.5 bg-white/30 rounded-full"></div>
                <div class="w-1.5 h-1.5 bg-white/30 rounded-full"></div>
            </div>
        </div>
    </div>

    {{-- Right Panel: Login Form --}}
    <div class="w-full lg:w-[55%] flex items-center justify-center p-6 md:p-12 relative overflow-hidden">
        {{-- Subtle background decoration for mobile --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 lg:hidden"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-sky-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 lg:hidden"></div>

        <div class="w-full max-w-[420px] bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100/60 p-8 sm:p-10 relative z-10 animate-fade-in-up">
            
            {{-- Logo Area --}}
            <div class="mb-10 text-center lg:text-left">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-50 rounded-2xl mb-6 shadow-sm border border-blue-100/50">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zm0 7.5l-10-5v2.5l10 5 10-5v-2.5l-10 5zM2 12v2.5l10 5 10-5V12l-10 5-10-5z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Selamat Datang</h2>
                <p class="text-slate-500 mt-2 font-medium">Silakan masuk ke akun Anda</p>
            </div>

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 border-l-4 border-green-500 text-green-700 text-sm flex items-start shadow-sm animate-fade-in-up">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="font-bold">Berhasil!</p>
                        <p class="mt-0.5 opacity-90">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @error('email')
                <div class="mb-6 p-4 rounded-xl bg-red-50 border-l-4 border-red-500 text-red-700 text-sm flex items-start shadow-sm animate-fade-in-up">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="font-bold">Gagal Masuk</p>
                        <p class="mt-0.5 opacity-90">{{ $message }}</p>
                    </div>
                </div>
            @enderror

            {{-- Form --}}
            <form action="{{ route('auth.login.process') }}" method="POST" class="space-y-6" onsubmit="showLoading()">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 font-medium" placeholder="nama@kampus.ac.id" required>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-bold text-slate-700">Password</label>
                        <a href="#" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">Lupa Password?</a>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input type="password" id="password" name="password" class="w-full pl-11 pr-12 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 font-medium" placeholder="••••••••" required>
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-slate-600 focus:outline-none transition-colors">
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <svg id="eyeSlashIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full relative group overflow-hidden bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded-xl transition-all duration-300 shadow-[0_8px_20px_rgb(37,99,235,0.25)] hover:shadow-[0_10px_25px_rgb(37,99,235,0.35)] hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center justify-center">
                        <span id="btnText" class="flex items-center gap-2">
                            Masuk
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </span>
                        <svg id="btnLoader" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center text-sm text-slate-600 font-medium">
                Belum punya akun? 
                <a href="{{ route('auth.register') }}" class="font-bold text-blue-600 hover:text-blue-800 transition-colors ml-1">Daftar Sekarang</a>
            </div>

            {{-- Quick Switch untuk Testing --}}
            @if(!app()->environment('production'))
                <div class="mt-8 text-center pt-6 border-t border-slate-100">
                    <a href="{{ route('auth.quick-switch') }}" class="inline-flex items-center gap-3 text-sm font-bold text-slate-700 hover:text-blue-700 bg-white hover:bg-slate-50 px-5 py-3.5 rounded-xl border border-slate-200 transition-all duration-300 hover:shadow-md group w-full justify-center">
                        <div class="bg-blue-50 p-1.5 rounded-lg text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                            </svg>
                        </div>
                        Quick Switch User (Testing Mode)
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeSlashIcon = document.getElementById('eyeSlashIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.add('hidden');
            eyeSlashIcon.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('hidden');
            eyeSlashIcon.classList.add('hidden');
        }
    }

    function showLoading() {
        document.getElementById('btnText').classList.add('hidden');
        document.getElementById('btnLoader').classList.remove('hidden');
    }
</script>
@endsection
