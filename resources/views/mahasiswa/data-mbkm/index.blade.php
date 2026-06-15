@extends('layouts.mahasiswa')

@section('title', 'Data MBKM - Mahasiswa')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Data MBKM</h1>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Card 1 --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Mitra MBKM</p>
                    <h3 class="text-lg font-bold text-slate-900">PT Teknologi Nusantara</h3>
                </div>
                <div class="bg-blue-50 p-2.5 rounded-xl text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Card 2 --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Lokasi Kegiatan</p>
                    <h3 class="text-lg font-bold text-slate-900">Jakarta Selatan</h3>
                </div>
                <div class="bg-amber-50 p-2.5 rounded-xl text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Card 3 --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Periode</p>
                    <h3 class="text-lg font-bold text-slate-900">Feb - Jun 2024</h3>
                </div>
                <div class="bg-indigo-50 p-2.5 rounded-xl text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Card 4 --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Status</p>
                    <h3 class="text-lg font-bold text-slate-900">Aktif Berjalan</h3>
                </div>
                <div class="bg-emerald-50 p-2.5 rounded-xl text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm font-medium text-emerald-600">Terverifikasi Kaprodi</p>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        {{-- Form Section (2/3 width) --}}
        <div class="lg:col-span-2">
            {{-- Formulir Data Card --}}
            <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Formulir Data</h2>

                {{-- Section A: Informasi MBKM --}}
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="text-blue-700 font-bold text-sm">A</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Informasi MBKM</h3>
                    </div>

                    <div class="space-y-5">
                        {{-- Mitra MBKM --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">MITRA MBKM</label>
                            <input type="text" placeholder="Contoh: PT Teknologi Nusantara" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        </div>

                        {{-- Lokasi Kegiatan --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">LOKASI KEGIATAN</label>
                            <input type="text" placeholder="Contoh: Jakarta Selatan" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        </div>

                        {{-- Alamat Lengkap --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">ALAMAT LENGKAP KANTOR/LOKASI</label>
                            <textarea placeholder="Contoh: Jl. Gatot Subroto No. 12, Kuningan Timur..." class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none" rows="3"></textarea>
                        </div>

                        {{-- Posisi Magang --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">POSISI MAGANG</label>
                            <input type="text" placeholder="Contoh: Frontend Engineer" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        </div>

                        {{-- Detail Pekerjaan --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">DETAIL PEKERJAAN / RENCANA PROYEK</label>
                            <textarea placeholder="Jelaskan detail pekerjaan atau project yang akan Anda kerjakan..." class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none" rows="4"></textarea>
                        </div>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="border-t border-slate-200 my-8"></div>

                {{-- Section B: Periode Kegiatan --}}
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="text-blue-700 font-bold text-sm">B</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Periode Kegiatan</h3>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-5">
                        {{-- Tanggal Mulai --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">TANGGAL MULAI</label>
                            <input type="date" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-slate-500">
                        </div>

                        {{-- Tanggal Selesai --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">TANGGAL SELESAI</label>
                            <input type="date" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-slate-500">
                        </div>
                    </div>

                    {{-- Status Keikutsertaan --}}
                    @php
                        // Variabel dummy status (bisa diubah dari Controller nantinya)
                        $status = 'Sedang Berjalan'; 
                    @endphp
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">STATUS KEIKUTSERTAAN</label>
                        <div class="w-full px-4 py-2.5 border border-slate-200 rounded-lg bg-slate-50 flex items-center">
                            @switch($status)
                                @case('Menunggu Verifikasi')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $status }}
                                    </span>
                                    @break

                                @case('Sedang Berjalan')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                        {{ $status }}
                                    </span>
                                    @break

                                @case('Selesai')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        {{ $status }}
                                    </span>
                                    @break

                                @default
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-slate-100 text-slate-800">
                                        {{ $status }}
                                    </span>
                            @endswitch
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-4 mt-8">
                    <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Simpan Data
                    </button>
                    <button class="flex-1 border-2 border-blue-600 text-blue-600 hover:bg-blue-50 font-semibold py-3 px-6 rounded-lg transition-all duration-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Update Data
                    </button>
                </div>
            </div>
        </div>

        {{-- Right Sidebar (1/3 width) --}}
        <div class="lg:col-span-1 space-y-6">
            {{-- Informasi Tambahan Card --}}
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                <div class="flex gap-3">
                    <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-blue-900 mb-1">Informasi Tambahan</h4>
                        <p class="text-sm text-blue-800">Pastikan data MBKM Anda sudah divalidasi oleh institusi pendidikan dan pihak industri sebelum mengajukan perubahan. Untuk pertanyaan lebih lanjut, silakan hubungi Koordinator MBKM.</p>
                    </div>
                </div>
            </div>


        </div>
    </div>

    {{-- Footer Text --}}
    <div class="text-center text-sm text-slate-500 mt-12 py-8 border-t border-slate-200">
        <p>© 2026 Sistem Manajemen MBKM • Program Studi Ilmu Komputer</p>
    </div>
@endsection
