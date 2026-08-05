@extends('layouts.mahasiswa')

@section('title', 'Data MBKM - Mahasiswa')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8 animate-fade-in-up">
        <div class="flex items-center gap-4">
            <div class="bg-blue-50 border border-blue-100 p-3.5 rounded-2xl text-blue-600 shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Data MBKM</h1>
                <p class="text-slate-500 mt-1 font-medium">Kelola informasi penempatan dan kegiatan MBKM Anda.</p>
            </div>
        </div>
    </div>

    {{-- Alert jika belum ada data --}}
    @if(!$hasData)
        <div class="bg-white border-l-4 border-yellow-400 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-8">
            <div class="bg-yellow-50 p-2.5 rounded-xl text-yellow-600 flex-shrink-0 mt-0.5 border border-yellow-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-lg mb-1">Belum Ada Data MBKM</h3>
                <p class="text-slate-600 text-sm leading-relaxed font-medium">Silakan isi formulir pendaftaran di bawah ini untuk menambahkan data MBKM Anda.</p>
            </div>
        </div>
    @endif

    {{-- Statistics Cards (Hanya tampil jika ada data) --}}
    @if($hasData && $pendaftaran)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Card 1: Mitra --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md hover:border-blue-200 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-slate-50 group-hover:bg-blue-50 p-3 rounded-xl transition-colors duration-300 border border-slate-100 group-hover:border-blue-100">
                    <svg class="w-6 h-6 text-slate-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Mitra MBKM</p>
                <p class="text-xl font-bold text-slate-800 line-clamp-1" title="{{ $pendaftaran->mitraMbkm->nama_mitra ?? '-' }}">{{ $pendaftaran->mitraMbkm->nama_mitra ?? '-' }}</p>
            </div>
        </div>

        {{-- Card 2: Lokasi --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md hover:border-blue-200 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-slate-50 group-hover:bg-blue-50 p-3 rounded-xl transition-colors duration-300 border border-slate-100 group-hover:border-blue-100">
                    <svg class="w-6 h-6 text-slate-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Lokasi Kegiatan</p>
                <p class="text-xl font-bold text-slate-800 line-clamp-1" title="{{ $pendaftaran->mitraMbkm->lokasi ?? '-' }}">{{ $pendaftaran->mitraMbkm->lokasi ?? '-' }}</p>
            </div>
        </div>

        {{-- Card 3: Periode --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md hover:border-blue-200 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-slate-50 group-hover:bg-blue-50 p-3 rounded-xl transition-colors duration-300 border border-slate-100 group-hover:border-blue-100">
                    <svg class="w-6 h-6 text-slate-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Periode</p>
                <p class="text-xl font-bold text-slate-800">
                    @if($pendaftaran->tgl_mulai && $pendaftaran->tgl_selesai)
                        {{ \Carbon\Carbon::parse($pendaftaran->tgl_mulai)->format('M y') }} - {{ \Carbon\Carbon::parse($pendaftaran->tgl_selesai)->format('M y') }}
                    @else
                        -
                    @endif
                </p>
            </div>
        </div>

        {{-- Card 4: Status --}}
        @php
            $isBerjalan = $pendaftaran->status == 'berjalan' || $pendaftaran->status == 'disetujui';
            $isPending = $pendaftaran->status == 'pending';
            $isDitolak = $pendaftaran->status == 'ditolak';
            
            $statusColorClass = $isBerjalan ? 'text-emerald-600' : ($isPending ? 'text-yellow-600' : ($isDitolak ? 'text-red-600' : 'text-blue-600'));
            $statusBgClass = $isBerjalan ? 'bg-emerald-50 border-emerald-100' : ($isPending ? 'bg-yellow-50 border-yellow-100' : ($isDitolak ? 'bg-red-50 border-red-100' : 'bg-blue-50 border-blue-100'));
        @endphp
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-all duration-300 group hover:border-slate-300">
            <div class="flex items-center justify-between mb-4">
                <div class="{{ $statusBgClass }} p-3 rounded-xl border transition-colors duration-300">
                    <svg class="w-6 h-6 {{ $statusColorClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Status Keikutsertaan</p>
                <p class="text-xl font-bold {{ $statusColorClass }}">
                    @switch($pendaftaran->status)
                        @case('pending') Menunggu @break
                        @case('disetujui') Disetujui @break
                        @case('ditolak') Ditolak @break
                        @case('berjalan') Aktif Berjalan @break
                        @case('selesai') Selesai @break
                        @default {{ ucfirst($pendaftaran->status) }}
                    @endswitch
                </p>
            </div>
        </div>
    </div>
    @endif

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        {{-- Form/Info Section (2/3 width) --}}
        <div class="lg:col-span-2">
            
            @if($hasData && $pendaftaran)
                {{-- Display Mode: Info Card (Read-Only) --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-8 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-slate-50 rounded-bl-full opacity-50 -z-10"></div>
                    
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <div class="bg-slate-50 p-2 rounded-lg text-slate-600 border border-slate-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h2 class="text-lg font-bold text-slate-800">Detail Pendaftaran MBKM</h2>
                        </div>
                    </div>

                    {{-- Section A: Informasi MBKM --}}
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 font-bold flex items-center justify-center border border-blue-100 text-sm">
                                A
                            </div>
                            <h3 class="text-md font-bold text-slate-700 uppercase tracking-wide">Informasi Mitra & Pekerjaan</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- Mitra MBKM --}}
                            <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Mitra MBKM</p>
                                <p class="text-base font-bold text-slate-800">{{ $pendaftaran->mitraMbkm->nama_mitra ?? '-' }}</p>
                            </div>

                            {{-- Posisi Magang --}}
                            <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Posisi Magang</p>
                                <p class="text-base font-bold text-slate-800">{{ $pendaftaran->posisi_magang ?? '-' }}</p>
                            </div>

                            {{-- Alamat Lengkap --}}
                            <div class="bg-slate-50 rounded-xl p-5 border border-slate-100 md:col-span-2">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Alamat Lengkap Kantor</p>
                                <p class="text-base font-medium text-slate-700">{{ $pendaftaran->mitraMbkm->alamat ?? '-' }}</p>
                            </div>

                            {{-- Detail Pekerjaan --}}
                            <div class="bg-slate-50 rounded-xl p-5 border border-slate-100 md:col-span-2">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Detail Pekerjaan / Rencana Proyek</p>
                                <p class="text-base font-medium text-slate-700 whitespace-pre-line">{{ $pendaftaran->detail_pekerjaan ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 my-8"></div>

                    {{-- Section B: Periode Kegiatan --}}
                    <div class="mb-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 font-bold flex items-center justify-center border border-blue-100 text-sm">
                                B
                            </div>
                            <h3 class="text-md font-bold text-slate-700 uppercase tracking-wide">Periode Kegiatan</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- Tanggal Mulai --}}
                            <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Tanggal Mulai</p>
                                <p class="text-base font-bold text-slate-800">{{ $pendaftaran->tgl_mulai ? \Carbon\Carbon::parse($pendaftaran->tgl_mulai)->translatedFormat('d F Y') : '-' }}</p>
                            </div>

                            {{-- Tanggal Selesai --}}
                            <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Tanggal Selesai</p>
                                <p class="text-base font-bold text-slate-800">{{ $pendaftaran->tgl_selesai ? \Carbon\Carbon::parse($pendaftaran->tgl_selesai)->translatedFormat('d F Y') : '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                {{-- Edit Mode: Form Input --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-8 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-slate-50 rounded-bl-full opacity-50 -z-10"></div>
                    
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <div class="bg-slate-50 p-2 rounded-lg text-slate-600 border border-slate-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </div>
                            <h2 class="text-lg font-bold text-slate-800">Formulir Pendaftaran Data MBKM</h2>
                        </div>
                    </div>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="bg-white border-l-4 border-green-500 rounded-xl p-5 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-6">
                            <div class="bg-green-50 p-2 rounded-lg text-green-600 flex-shrink-0 mt-0.5 border border-green-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-slate-800 font-bold text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Error Messages --}}
                    @if($errors->any())
                        <div class="bg-white border-l-4 border-red-500 rounded-xl p-5 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-6">
                            <div class="bg-red-50 p-2 rounded-lg text-red-600 flex-shrink-0 mt-0.5 border border-red-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </div>
                            <div>
                                <p class="text-red-800 font-bold text-sm mb-1">Terdapat kesalahan pengisian form:</p>
                                <ul class="text-sm text-slate-600 list-disc list-inside font-medium">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('mahasiswa.data-mbkm.store') }}" method="POST">
                        @csrf

                        {{-- Section A: Informasi MBKM --}}
                        <div class="mb-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 font-bold flex items-center justify-center border border-blue-100 text-sm">
                                    A
                                </div>
                                <h3 class="text-md font-bold text-slate-700 uppercase tracking-wide">Informasi MBKM</h3>
                            </div>

                            <div class="space-y-6">
                                {{-- Mitra MBKM --}}
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 tracking-wide">Nama Mitra MBKM <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_mitra" value="{{ old('nama_mitra', $pendaftaran->mitraMbkm->nama_mitra ?? '') }}" placeholder="Contoh: PT Teknologi Nusantara" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 font-medium @error('nama_mitra') border-red-500 bg-red-50 @enderror" required>
                                    @error('nama_mitra')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Lokasi (Kota) --}}
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 tracking-wide">Lokasi (Kota) <span class="text-red-500">*</span></label>
                                    <input type="text" name="lokasi" value="{{ old('lokasi', $pendaftaran->mitraMbkm->lokasi ?? '') }}" placeholder="Contoh: Jakarta, Bandung, Surabaya" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 font-medium @error('lokasi') border-red-500 bg-red-50 @enderror" required>
                                    @error('lokasi')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Alamat Lengkap --}}
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 tracking-wide">Alamat Lengkap Kantor/Lokasi <span class="text-red-500">*</span></label>
                                    <textarea name="alamat_lengkap" placeholder="Contoh: Jl. Gatot Subroto No. 12, Kuningan Timur..." class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 resize-none font-medium @error('alamat_lengkap') border-red-500 bg-red-50 @enderror" rows="3" required>{{ old('alamat_lengkap', $pendaftaran->mitraMbkm->alamat ?? '') }}</textarea>
                                    @error('alamat_lengkap')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Posisi Magang --}}
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 tracking-wide">Posisi Magang <span class="text-red-500">*</span></label>
                                    <input type="text" name="posisi_magang" value="{{ old('posisi_magang', $pendaftaran->posisi_magang ?? '') }}" placeholder="Contoh: Frontend Engineer" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 font-medium @error('posisi_magang') border-red-500 bg-red-50 @enderror" required>
                                    @error('posisi_magang')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Detail Pekerjaan --}}
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 tracking-wide">Detail Pekerjaan / Rencana Proyek <span class="text-red-500">*</span></label>
                                    <textarea name="detail_pekerjaan" placeholder="Jelaskan detail pekerjaan atau project yang akan Anda kerjakan..." class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 resize-none font-medium @error('detail_pekerjaan') border-red-500 bg-red-50 @enderror" rows="4" required>{{ old('detail_pekerjaan', $pendaftaran->detail_pekerjaan ?? '') }}</textarea>
                                    @error('detail_pekerjaan')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-slate-100 my-8"></div>

                        {{-- Section B: Periode Kegiatan --}}
                        <div class="mb-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 font-bold flex items-center justify-center border border-blue-100 text-sm">
                                    B
                                </div>
                                <h3 class="text-md font-bold text-slate-700 uppercase tracking-wide">Periode Kegiatan</h3>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                {{-- Tanggal Mulai --}}
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 tracking-wide">Tanggal Mulai <span class="text-red-500">*</span></label>
                                    <input type="date" name="tgl_mulai" value="{{ old('tgl_mulai', $pendaftaran->tgl_mulai ?? '') }}" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 font-medium @error('tgl_mulai') border-red-500 bg-red-50 @enderror" required>
                                    @error('tgl_mulai')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Tanggal Selesai --}}
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 tracking-wide">Tanggal Selesai <span class="text-red-500">*</span></label>
                                    <input type="date" name="tgl_selesai" value="{{ old('tgl_selesai', $pendaftaran->tgl_selesai ?? '') }}" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 font-medium @error('tgl_selesai') border-red-500 bg-red-50 @enderror" required>
                                    @error('tgl_selesai')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-6 border-t border-slate-100">
                            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-6 rounded-xl transition-all duration-300 shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                {{ $hasData ? 'Update Data' : 'Simpan Data MBKM' }}
                            </button>
                            <button type="reset" class="flex-1 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold py-3.5 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
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
            <div class="bg-white border-l-4 border-blue-500 rounded-2xl p-6 shadow-sm border-y border-r border-slate-200 relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-blue-50 rounded-full opacity-50 z-0"></div>
                <div class="relative z-10 flex gap-4">
                    <div class="bg-blue-50 p-2.5 rounded-xl text-blue-600 flex-shrink-0 mt-0.5 border border-blue-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-lg mb-1">Informasi Tambahan</h4>
                        <p class="text-sm text-slate-600 font-medium leading-relaxed">
                            Pastikan data MBKM Anda sudah divalidasi oleh institusi pendidikan dan pihak industri sebelum mengajukan perubahan. Untuk pertanyaan lebih lanjut, silakan hubungi Koordinator MBKM.
                        </p>
                    </div>
                </div>
            </div>
            
            {{-- Help Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-slate-100">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h4 class="font-bold text-slate-800 mb-2">Butuh Bantuan?</h4>
                <p class="text-sm text-slate-500 font-medium mb-5">Jika Anda mengalami kendala saat mengisi form pendataan, Anda dapat membaca panduan.</p>
                <a href="#" class="inline-flex items-center justify-center px-4 py-2 border border-slate-200 rounded-lg text-sm font-bold text-slate-700 bg-white hover:bg-slate-50 transition-colors w-full">Baca Panduan MBKM</a>
            </div>
        </div>
    </div>
@endsection
