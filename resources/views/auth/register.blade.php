@extends('layouts.auth')

@section('title', 'Register - MBKM System')

@section('content')
<div class="min-h-screen flex">
    {{-- Left Panel: Visual/Branding --}}
    <div class="hidden lg:flex lg:w-1/2 bg-blue-700 items-center justify-center relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <svg patternUnits="userSpaceOnUse" width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                <path d="M54.627 0l.83.83-54.628 54.628-.83-.83L54.627 0zm0 10.435l.83.83-44.193 44.193-.83-.83L54.627 10.435zm0 10.435l.83.83-33.758 33.758-.83-.83L54.627 20.87zm0 10.435l.83.83-23.323 23.323-.83-.83L54.627 31.305zm0 10.435l.83.83-12.888 12.888-.83-.83L54.627 41.74zm0 10.435l.83.83-2.453 2.453-.83-.83L54.627 52.175z" fill="currentColor" fill-rule="evenodd"/>
            </svg>
        </div>
        
        <div class="relative z-10 w-full max-w-md px-12 text-white">
            <div class="mb-10">
                <svg class="w-24 h-24 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-extrabold mb-4 leading-tight">Bergabung Bersama<br>Komunitas Kami.</h1>
            <p class="text-blue-100 text-lg">Pendaftaran akun Mahasiswa untuk Sistem MBKM.</p>
        </div>
    </div>

    {{-- Right Panel: Register Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white min-h-screen py-12">
        <div class="w-full max-w-md">
            {{-- Header --}}
            <div class="mb-8 text-center lg:text-left">
                <h2 class="text-3xl font-bold text-slate-900 mb-2">Buat Akun</h2>
                <p class="text-slate-500">Lengkapi data pendaftaran akun Mahasiswa Anda.</p>
            </div>

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="mb-5 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Form Mahasiswa --}}
            <form id="form-mahasiswa" action="{{ route('auth.register.process') }}" method="POST" class="space-y-4" novalidate>
                @csrf
                <input type="hidden" name="role" value="mahasiswa">
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name_mhs" value="{{ old('name_mhs') }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Sesuai KTP/KTM" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">NIM</label>
                        <input type="text" name="nim" value="{{ old('nim') }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Nomor Induk Mahasiswa" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Angkatan</label>
                        <select name="angkatan" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors" required>
                            <option value="">Pilih Angkatan</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <input type="email" name="email_mhs" value="{{ old('email_mhs') }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Disarankan menggunakan email kampus" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                        <input type="password" name="password_mhs" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="••••••••" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi</label>
                        <input type="password" name="password_mhs_confirmation" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="flex items-start pt-2">
                    <div class="flex items-center h-5">
                        <input id="tos-mhs" type="checkbox" required class="w-4 h-4 border border-slate-300 rounded bg-slate-50 focus:ring-3 focus:ring-blue-300">
                    </div>
                    <label for="tos-mhs" class="ml-2 text-sm text-slate-600">Saya menyetujui <a href="#" class="text-blue-600 hover:underline">Syarat dan Ketentuan</a> yang berlaku.</label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                        Daftar sebagai Mahasiswa
                    </button>
                </div>
            </form>


            <div class="mt-8 text-center text-sm text-slate-600">
                Sudah punya akun? 
                <a href="{{ route('auth.login') }}" class="font-bold text-blue-600 hover:text-blue-800 transition-colors">Masuk di sini</a>
            </div>
        </div>
    </div>
</div>

@endsection
