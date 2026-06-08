@extends('layouts.auth')

@section('title', 'Login - MBKM System')

@section('content')
<div class="min-h-screen flex">
    {{-- Left Panel: Visual/Branding (Hidden on mobile) --}}
    <div class="hidden lg:flex lg:w-1/2 bg-blue-700 items-center justify-center relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <svg patternUnits="userSpaceOnUse" width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                <path d="M54.627 0l.83.83-54.628 54.628-.83-.83L54.627 0zm0 10.435l.83.83-44.193 44.193-.83-.83L54.627 10.435zm0 10.435l.83.83-33.758 33.758-.83-.83L54.627 20.87zm0 10.435l.83.83-23.323 23.323-.83-.83L54.627 31.305zm0 10.435l.83.83-12.888 12.888-.83-.83L54.627 41.74zm0 10.435l.83.83-2.453 2.453-.83-.83L54.627 52.175zM44.192 0l.83.83-45.022 45.022-.83-.83L44.192 0zm-10.435 0l.83.83-34.587 34.587-.83-.83L33.757 0zm-10.435 0l.83.83-24.152 24.152-.83-.83L23.322 0zm-10.435 0l.83.83-13.717 13.717-.83-.83L12.887 0zm-10.435 0l.83.83-3.282 3.282-.83-.83L2.452 0z" fill="currentColor" fill-rule="evenodd"/>
            </svg>
        </div>
        
        <div class="relative z-10 w-full max-w-md px-12 text-white">
            <div class="mb-10">
                <svg class="w-24 h-24 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5.581m0 0H9m5.581 0a2 2 0 110-4m0 4a2 2 0 110 4m0-4V9m0 4H4m5.581 8H9"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-extrabold mb-4 leading-tight">Mulai Perjalanan<br>Karirmu Di Sini.</h1>
            <p class="text-blue-100 text-lg">Sistem Informasi Manajemen Merdeka Belajar Kampus Merdeka (MBKM) Prodi Ilmu Komputer.</p>
        </div>
    </div>

    {{-- Right Panel: Login Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
        <div class="w-full max-w-md">
            {{-- Logo Area --}}
            <div class="mb-10 text-center lg:text-left">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-100 rounded-xl mb-4">
                    <svg class="w-6 h-6 text-blue-700" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zm0 7.5l-10-5v2.5l10 5 10-5v-2.5l-10 5zM2 12v2.5l10 5 10-5V12l-10 5-10-5z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-slate-900">Selamat Datang</h2>
                <p class="text-slate-500 mt-2">Silakan masuk ke akun Anda</p>
            </div>

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @error('email')
                <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm flex items-start">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ $message }}
                </div>
            @enderror

            {{-- Form --}}
            <form action="{{ route('auth.login.process') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="nama@kampus.ac.id" required>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
                        <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors">Lupa Password?</a>
                    </div>
                    <input type="password" id="password" name="password" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="••••••••" required>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Masuk
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center text-sm text-slate-600">
                Belum punya akun? 
                <a href="{{ route('auth.register') }}" class="font-bold text-blue-600 hover:text-blue-800 transition-colors">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>
@endsection
