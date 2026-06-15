@extends('layouts.mahasiswa')

@section('title', 'Pembimbing - Mahasiswa')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Pembimbing</h1>
        </div>
    </div>

    {{-- Dosen Pembimbing Card --}}
    <div class="bg-white rounded-xl shadow-md p-8 mb-8">
        {{-- Card Header --}}
        <div class="flex items-center justify-between mb-8 pb-6 border-b border-slate-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM15 20H9m0 0H4m11 0a3 3 0 01-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900">Dosen Pembimbing</h3>
            </div>
            <span class="inline-block bg-blue-600 text-white text-xs font-semibold px-4 py-2 rounded-full">Ditentukan oleh Admin</span>
        </div>

        {{-- Content: 2 columns --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Dosen Pembimbing Section --}}
            <div class="bg-slate-50 rounded-xl p-6">
                <p class="text-xs font-semibold text-slate-600 uppercase mb-4">Dosen Pembimbing</p>
                <h4 class="text-lg font-bold text-slate-900 mb-1">Dr. Ir. Hendra Wijaya, M.Kom</h4>
                <p class="text-sm text-slate-600 mb-4">Dosen Pembimbing Akademik</p>
                <div class="space-y-2">
                    <div>
                        <p class="text-xs text-slate-600">NIP</p>
                        <p class="text-sm font-semibold text-slate-900">198203112008122002</p>
                    </div>
                </div>
            </div>

            {{-- Dosen Penguji Section --}}
            <div class="bg-slate-50 rounded-xl p-6">
                <p class="text-xs font-semibold text-slate-600 uppercase mb-4">Dosen Penguji</p>
                <h4 class="text-lg font-bold text-slate-900 mb-1">Budi Santoso, S.T., M.T.</h4>
                <p class="text-sm text-slate-600 mb-4">Dosen Penguji MBKM</p>
                <div class="space-y-2">
                    <div>
                        <p class="text-xs text-slate-600">NIP</p>
                        <p class="text-sm font-semibold text-slate-900">197509272005011003</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pembimbing Lapangan Card --}}
    <div class="bg-white rounded-xl shadow-md p-8 mb-8 relative overflow-hidden">
        {{-- Decorative shape --}}
        <div class="absolute top-0 right-0 w-32 h-32 bg-slate-100 rounded-bl-3xl opacity-50"></div>

        {{-- Card Header --}}
        <div class="flex items-center gap-4 mb-8 pb-6 border-b border-slate-200 relative z-10">
            <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-900">Pembimbing Lapangan</h3>
        </div>

        {{-- Form Content --}}
        <div class="space-y-6 relative z-10">
            {{-- Nama Pembimbing Lapangan --}}
            <div>
                <label class="block text-xs font-semibold text-slate-700 uppercase mb-3">Nama Pembimbing Lapangan</label>
                <input type="text" placeholder="Masukkan nama pembimbing" class="w-full bg-slate-100 text-slate-900 placeholder-slate-500 rounded-full px-6 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-200" value="">
            </div>

            {{-- Nomor WhatsApp --}}
            <div>
                <label class="block text-xs font-semibold text-slate-700 uppercase mb-3">Nomor WhatsApp</label>
                <input type="text" placeholder="+62 812xxxxxxxx" class="w-full bg-slate-100 text-slate-900 placeholder-slate-500 rounded-full px-6 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-200" value="">
            </div>

            {{-- Info Box --}}
            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 mt-6">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm text-blue-800">Isi sesuai dengan pembimbing di tempat magang. Data ini digunakan untuk verifikasi laporan anda</p>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-slate-200">
                <button class="text-blue-600 hover:text-blue-700 font-semibold py-2 px-6 transition-all duration-200">
                    Update
                </button>
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transition-all duration-200">
                    Simpan
                </button>
            </div>
        </div>
    </div>

    {{-- Footer Text --}}
    <div class="text-center text-sm text-slate-500 mt-12 py-8 border-t border-slate-200">
        <p>© 2024 Lumni University Academic System</p>
    </div>
@endsection
