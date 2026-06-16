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

    {{-- Alert jika belum ada data --}}
    @if(!$hasData)
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        <strong>Belum ada data MBKM.</strong> Silakan isi formulir di bawah ini untuk menambahkan data MBKM Anda.
                    </p>
                </div>
            </div>
        </div>
    @endif

    {{-- Statistics Cards (Hanya tampil jika ada data) --}}
    @if($hasData && $pendaftaran)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Card 1 --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Mitra MBKM</p>
                    <h3 class="text-lg font-bold text-slate-900">{{ $pendaftaran->mitraMbkm->nama_mitra ?? '-' }}</h3>
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
                    <h3 class="text-lg font-bold text-slate-900">{{ $pendaftaran->mitraMbkm->lokasi ?? '-' }}</h3>
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
                    <h3 class="text-lg font-bold text-slate-900">
                        @if($pendaftaran->tgl_mulai && $pendaftaran->tgl_selesai)
                            {{ \Carbon\Carbon::parse($pendaftaran->tgl_mulai)->format('M Y') }} - {{ \Carbon\Carbon::parse($pendaftaran->tgl_selesai)->format('M Y') }}
                        @else
                            -
                        @endif
                    </h3>
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
                    <h3 class="text-lg font-bold text-slate-900">
                        @switch($pendaftaran->status)
                            @case('pending') Menunggu Persetujuan @break
                            @case('disetujui') Disetujui @break
                            @case('ditolak') Ditolak @break
                            @case('berjalan') Aktif Berjalan @break
                            @case('selesai') Selesai @break
                            @default {{ ucfirst($pendaftaran->status) }}
                        @endswitch
                    </h3>
                </div>
                <div class="
                    @if($pendaftaran->status == 'berjalan' || $pendaftaran->status == 'disetujui') bg-emerald-50 text-emerald-600 group-hover:bg-emerald-600
                    @elseif($pendaftaran->status == 'pending') bg-yellow-50 text-yellow-600 group-hover:bg-yellow-600
                    @elseif($pendaftaran->status == 'ditolak') bg-red-50 text-red-600 group-hover:bg-red-600
                    @else bg-blue-50 text-blue-600 group-hover:bg-blue-600
                    @endif
                    p-2.5 rounded-xl group-hover:text-white transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm font-medium 
                @if($pendaftaran->status == 'berjalan' || $pendaftaran->status == 'disetujui') text-emerald-600
                @elseif($pendaftaran->status == 'pending') text-yellow-600
                @elseif($pendaftaran->status == 'ditolak') text-red-600
                @else text-blue-600
                @endif">
                @if($pendaftaran->status == 'berjalan' || $pendaftaran->status == 'disetujui')
                    Terverifikasi Kaprodi
                @elseif($pendaftaran->status == 'pending')
                    Menunggu Verifikasi
                @elseif($pendaftaran->status == 'ditolak')
                    Ditolak oleh Kaprodi
                @else
                    Program Selesai
                @endif
            </p>
        </div>
    </div>
    @endif

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        {{-- Form/Info Section (2/3 width) --}}
        <div class="lg:col-span-2">
            
            @if($hasData && $pendaftaran)
                {{-- Display Mode: Info Card (Read-Only) --}}
                <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-slate-900">Informasi Data MBKM</h2>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold 
                            @if($pendaftaran->status == 'berjalan' || $pendaftaran->status == 'disetujui') bg-green-100 text-green-800
                            @elseif($pendaftaran->status == 'pending') bg-yellow-100 text-yellow-800
                            @else bg-blue-100 text-blue-800
                            @endif">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            @switch($pendaftaran->status)
                                @case('pending') Menunggu Persetujuan @break
                                @case('disetujui') Disetujui @break
                                @case('berjalan') Sedang Berjalan @break
                                @case('selesai') Selesai @break
                                @default {{ ucfirst($pendaftaran->status) }}
                            @endswitch
                        </span>
                    </div>

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
                            <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">MITRA MBKM</label>
                                <p class="text-base font-semibold text-slate-900">{{ $pendaftaran->mitraMbkm->nama_mitra ?? '-' }}</p>
                            </div>

                            {{-- Alamat Lengkap --}}
                            <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">ALAMAT LENGKAP KANTOR</label>
                                <p class="text-base text-slate-900">{{ $pendaftaran->mitraMbkm->alamat ?? '-' }}</p>
                            </div>

                            {{-- Posisi Magang --}}
                            <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">POSISI MAGANG</label>
                                <p class="text-base font-semibold text-slate-900">{{ $pendaftaran->posisi_magang ?? '-' }}</p>
                            </div>

                            {{-- Detail Pekerjaan --}}
                            <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">DETAIL PEKERJAAN / RENCANA PROYEK</label>
                                <p class="text-base text-slate-900 whitespace-pre-line">{{ $pendaftaran->detail_pekerjaan ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-slate-200 my-8"></div>

                    {{-- Section B: Periode Kegiatan --}}
                    <div class="mb-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                <span class="text-blue-700 font-bold text-sm">B</span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900">Periode Kegiatan</h3>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            {{-- Tanggal Mulai --}}
                            <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">TANGGAL MULAI</label>
                                <p class="text-base font-semibold text-slate-900">{{ $pendaftaran->tgl_mulai ? \Carbon\Carbon::parse($pendaftaran->tgl_mulai)->format('d F Y') : '-' }}</p>
                            </div>

                            {{-- Tanggal Selesai --}}
                            <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">TANGGAL SELESAI</label>
                                <p class="text-base font-semibold text-slate-900">{{ $pendaftaran->tgl_selesai ? \Carbon\Carbon::parse($pendaftaran->tgl_selesai)->format('d F Y') : '-' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Info Footer --}}
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-6">
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-blue-900 text-sm mb-1">Data Sudah Tersimpan</h4>
                                <p class="text-sm text-blue-800">
                                    Data MBKM Anda sudah tersimpan dan sedang dalam proses. Jika ada perubahan yang diperlukan, 
                                    silakan hubungi admin atau kaprodi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                {{-- Edit Mode: Form Input --}}
                <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Formulir Data</h2>

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Error Messages --}}
                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <ul class="text-sm text-red-700 list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('mahasiswa.data-mbkm.store') }}" method="POST">
                    @csrf

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
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">MITRA MBKM <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_mitra" value="{{ old('nama_mitra', $pendaftaran->mitraMbkm->nama_mitra ?? '') }}" placeholder="Contoh: PT Teknologi Nusantara" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nama_mitra') border-red-500 @enderror" required>
                                @error('nama_mitra')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Lokasi (Kota) --}}
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">LOKASI (KOTA) <span class="text-red-500">*</span></label>
                                <input type="text" name="lokasi" value="{{ old('lokasi', $pendaftaran->mitraMbkm->lokasi ?? '') }}" placeholder="Contoh: Jakarta, Bandung, Surabaya" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('lokasi') border-red-500 @enderror" required>
                                @error('lokasi')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-slate-500 mt-1">Nama kota tempat mitra berada</p>
                            </div>

                            {{-- Alamat Lengkap --}}
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">ALAMAT LENGKAP KANTOR/LOKASI <span class="text-red-500">*</span></label>
                                <textarea name="alamat_lengkap" placeholder="Contoh: Jl. Gatot Subroto No. 12, Kuningan Timur, Jakarta Selatan 12950" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none @error('alamat_lengkap') border-red-500 @enderror" rows="3" required>{{ old('alamat_lengkap', $pendaftaran->mitraMbkm->alamat ?? '') }}</textarea>
                                @error('alamat_lengkap')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Posisi Magang --}}
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">POSISI MAGANG <span class="text-red-500">*</span></label>
                                <input type="text" name="posisi_magang" value="{{ old('posisi_magang', $pendaftaran->posisi_magang ?? '') }}" placeholder="Contoh: Frontend Engineer" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('posisi_magang') border-red-500 @enderror" required>
                                @error('posisi_magang')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Detail Pekerjaan --}}
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">DETAIL PEKERJAAN / RENCANA PROYEK <span class="text-red-500">*</span></label>
                                <textarea name="detail_pekerjaan" placeholder="Jelaskan detail pekerjaan atau project yang akan Anda kerjakan..." class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none @error('detail_pekerjaan') border-red-500 @enderror" rows="4" required>{{ old('detail_pekerjaan', $pendaftaran->detail_pekerjaan ?? '') }}</textarea>
                                @error('detail_pekerjaan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
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
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">TANGGAL MULAI <span class="text-red-500">*</span></label>
                                <input type="date" name="tgl_mulai" value="{{ old('tgl_mulai', $pendaftaran->tgl_mulai ?? '') }}" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('tgl_mulai') border-red-500 @enderror" required>
                                @error('tgl_mulai')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tanggal Selesai --}}
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">TANGGAL SELESAI <span class="text-red-500">*</span></label>
                                <input type="date" name="tgl_selesai" value="{{ old('tgl_selesai', $pendaftaran->tgl_selesai ?? '') }}" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('tgl_selesai') border-red-500 @enderror" required>
                                @error('tgl_selesai')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Status Keikutsertaan (Read-only) --}}
                        @if($hasData && $pendaftaran)
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">STATUS KEIKUTSERTAAN</label>
                            <div class="w-full px-4 py-2.5 border border-slate-200 rounded-lg bg-slate-50 flex items-center">
                                @switch($pendaftaran->status)
                                    @case('pending')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Menunggu Verifikasi
                                        </span>
                                        @break

                                    @case('berjalan')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                            Sedang Berjalan
                                        </span>
                                        @break

                                    @case('selesai')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Selesai
                                        </span>
                                        @break

                                    @case('disetujui')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-800">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Disetujui
                                        </span>
                                        @break

                                    @case('ditolak')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            Ditolak
                                        </span>
                                        @break

                                    @default
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-slate-100 text-slate-800">
                                            {{ ucfirst($pendaftaran->status) }}
                                        </span>
                                @endswitch
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex gap-4 mt-8">
                        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                            </svg>
                            {{ $hasData ? 'Update Data' : 'Simpan Data' }}
                        </button>
                        <button type="reset" class="flex-1 border-2 border-slate-300 text-slate-600 hover:bg-slate-50 font-semibold py-3 px-6 rounded-lg transition-all duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset Form
                        </button>
                    </div>
                </form>
            </div>
            @endif
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
