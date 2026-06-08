@extends('layouts.mahasiswa')

@section('title', 'Data MBKM - Mahasiswa')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900 mb-2">Data MBKM Mahasiswa</h1>
        <p class="text-slate-600 text-lg">Informasi lengkap terkait kegiatan Merdeka Belajar Kampus Merdeka Anda.</p>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Card 1 --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">MITRA MBKM</p>
                    <h3 class="text-xl font-bold text-slate-900">PT Teknologi Nusantara</h3>
                </div>
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5.581m0 0H9m5.581 0a2 2 0 110-4m0 4a2 2 0 110 4m0-4V9m0 4H4m5.581 8H9"></path>
                </svg>
            </div>
            <p class="text-sm text-slate-600">Industri Teknologi Lunak</p>
        </div>

        {{-- Card 2 --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">LOKASI KEGIATAN</p>
                    <h3 class="text-xl font-bold text-slate-900">Bandung Kulon</h3>
                </div>
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <p class="text-sm text-slate-600">0 Joro Banding</p>
        </div>

        {{-- Card 3 --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">PERIODE</p>
                    <h3 class="text-xl font-bold text-slate-900">Feb - Jun 2024</h3>
                </div>
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <p class="text-sm text-slate-600">5 Semester Genap</p>
        </div>

        {{-- Card 4 --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">STATUS</p>
                    <h3 class="text-xl font-bold text-slate-900">Aktif Berjalan</h3>
                </div>
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-sm text-green-600 font-medium">Ter-verifikasi Fakultas</p>
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
                            <input type="text" value="PT Teknologi Nusantara" placeholder="Nama mitra MBKM" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        </div>

                        {{-- Lokasi Kegiatan --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">LOKASI KEGIATAN</label>
                            <input type="text" value="Jakarta Selatan" placeholder="Kota atau daerah kegiatan" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        </div>

                        {{-- Alamat Lengkap --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">ALAMAT LENGKAP KANTOR/LOKASI</label>
                            <textarea placeholder="Jl. Gatot Subroto No. 12, Kuningan Timur, Setiabudhi, Jakarta Selatan 12950" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none" rows="3">Jl. Gatot Subroto No. 12, Kuningan Timur, Setiabudhi, Jakarta Selatan 12950</textarea>
                        </div>

                        {{-- Posisi Magang --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">POSISI MAGANG</label>
                            <input type="text" value="Frontend Engineer" placeholder="Posisi magang atau peran yang diambil" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        </div>

                        {{-- Detail Pekerjaan --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">DETAIL PEKERJAAN / RENCANA PROYEK</label>
                            <textarea placeholder="Jelaskan pekerjaan yang akan dilakukan atau project yang akan dikerjakan" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none" rows="4">Membantia tim Engineering dalam pengembangan aplikasi mobile Flutter dan backend menggunakan Node.js. Bertanggung jawab dalam koding dan optimasi dengan fokus pada performa aplikasi. Database yang akan dipakai adalah MongoDB dan MySQL. Jawa atas modul autentikasi dan integrasi API pihak ketiga.</textarea>
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
                            <input type="date" value="2024-02-14" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        </div>

                        {{-- Tanggal Selesai --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">TANGGAL SELESAI</label>
                            <input type="date" value="2024-06-20" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
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

            {{-- Profile Section --}}
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                        AS
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-slate-900">Adi Satria</p>
                        <p class="text-xs text-slate-600">NIM: 2301001</p>
                        <p class="text-xs text-slate-600">Program: Internship 2024</p>
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
