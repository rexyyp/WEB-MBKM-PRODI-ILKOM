@extends('layouts.mahasiswa')

@section('title', 'Dashboard - Mahasiswa')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8 animate-fade-in-up">
        <div class="flex items-center gap-4">
            <div class="bg-blue-50 border border-blue-100 p-3.5 rounded-2xl text-blue-600 shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight">Beranda Mahasiswa</h1>
                <p class="text-sm md:text-base text-slate-500 mt-1 font-medium">Pantau perkembangan kegiatan MBKM Anda di sini.</p>
            </div>
        </div>
    </div>

    {{-- Alert Boxes --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        {{-- Alert Error --}}
        <div class="bg-white border-l-4 border-red-500 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200">
            <div class="bg-red-50 p-2.5 rounded-xl text-red-500 flex-shrink-0 mt-0.5 border border-red-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-lg mb-1">Laporan Harian Belum Terisi</h3>
                <p class="text-slate-600 text-sm leading-relaxed font-medium">Anda memiliki 3 laporan harian yang belum diisi. Mohon segera lengkapi sebelum 14 Mei 2025.</p>
            </div>
        </div>

        {{-- Alert Warning --}}
        <div class="bg-white border-l-4 border-yellow-400 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200">
            <div class="bg-yellow-50 p-2.5 rounded-xl text-yellow-600 flex-shrink-0 mt-0.5 border border-yellow-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-lg mb-1">Dokumen MBKM Belum Lengkap</h3>
                <p class="text-slate-600 text-sm leading-relaxed font-medium">Anda masih perlu mengunggah surat penempatan dan dokumen ijazah sementara.</p>
            </div>
        </div>
    </div>

    {{-- Progress MBKM (Steppers) --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-8 relative overflow-hidden">
        <div class="flex items-center gap-3 mb-6">
            <div class="bg-blue-50 p-2 rounded-lg text-blue-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h2 class="text-lg md:text-xl font-bold text-slate-800">Alur Kegiatan MBKM</h2>
        </div>
        
        <div class="relative z-10">
            <x-stepper />
        </div>
        
        {{-- Decorative background curve --}}
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-slate-50 rounded-full opacity-50 z-0"></div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Status Program Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md hover:border-blue-200 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-slate-50 group-hover:bg-blue-50 p-3 rounded-xl transition-colors duration-300">
                    <svg class="w-6 h-6 text-slate-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                </div>
            </div>
            <div>
                <p class="text-sm font-bold text-slate-500 mb-1">Status Program</p>
                <p class="text-3xl font-black text-slate-800">
                    @if($pendaftaran)
                        @if($pendaftaran->status == 'berjalan')
                            Berjalan
                        @elseif($pendaftaran->status == 'pending')
                            Pending
                        @elseif($pendaftaran->status == 'disetujui')
                            Disetujui
                        @elseif($pendaftaran->status == 'ditolak')
                            Ditolak
                        @elseif($pendaftaran->status == 'selesai')
                            Selesai
                        @else
                            {{ ucfirst($pendaftaran->status) }}
                        @endif
                    @else
                        Tidak Aktif
                    @endif
                </p>
                <p class="text-xs font-medium text-slate-400 mt-2">
                    Durasi: 
                    @if($pendaftaran && $pendaftaran->tgl_mulai && $pendaftaran->tgl_selesai)
                        <span class="text-blue-600 font-bold">{{ \Carbon\Carbon::parse($pendaftaran->tgl_mulai)->diffInMonths(\Carbon\Carbon::parse($pendaftaran->tgl_selesai)) }} bulan</span>
                    @else
                        -
                    @endif
                </p>
            </div>
        </div>

        {{-- Progress Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md hover:border-blue-200 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-slate-50 group-hover:bg-blue-50 p-3 rounded-xl transition-colors duration-300">
                    <svg class="w-6 h-6 text-slate-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
            </div>
            <div>
                <p class="text-sm font-bold text-slate-500 mb-1">Progress</p>
                <div class="flex items-end gap-2 mb-2">
                    <p class="text-3xl font-black text-slate-800">{{ $progressPercent }}<span class="text-xl text-slate-500 font-bold">%</span></p>
                    <p class="text-xs font-medium text-blue-600 mb-1">{{ $progressText }}</p>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2 mt-2">
                    <div class="bg-blue-600 h-2 rounded-full transition-all duration-1000" style="width: {{ $progressPercent }}%"></div>
                </div>
            </div>
        </div>

        {{-- Verification Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md hover:border-blue-200 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-slate-50 group-hover:bg-blue-50 p-3 rounded-xl transition-colors duration-300">
                    <svg class="w-6 h-6 text-slate-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>
            <div>
                <p class="text-sm font-bold text-slate-500 mb-1">Dokumen</p>
                <p class="text-3xl font-black text-slate-800">{{ $dokumenPercent }}<span class="text-xl text-slate-500 font-bold">%</span></p>
                <p class="text-xs font-medium text-slate-400 mt-2">
                    Terverifikasi <span class="text-blue-600 font-bold">{{ $dokumenUploaded }} dari {{ $totalDokumen }}</span>
                </p>
            </div>
        </div>

        {{-- Logbook Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md hover:border-blue-200 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-slate-50 group-hover:bg-blue-50 p-3 rounded-xl transition-colors duration-300">
                    <svg class="w-6 h-6 text-slate-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
            </div>
            <div>
                <p class="text-sm font-bold text-slate-500 mb-1">Total Logbook</p>
                <p class="text-3xl font-black text-slate-800">{{ $totalLogbook }}</p>
                <p class="text-xs font-medium text-slate-400 mt-2">entri logbook terdaftar</p>
            </div>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        
        {{-- Left Column (2/3) --}}
        <div class="lg:col-span-2 space-y-8">
            
            {{-- Status Dokumen Administratori --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="bg-slate-50 p-2 rounded-lg text-slate-600 border border-slate-100 hidden sm:block">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                        </div>
                        <h2 class="text-base md:text-lg font-bold text-slate-800">Status Dokumen Administrasi</h2>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Document Item 1: Surat Penugasan --}}
                    @php
                        $hasSuratPenugasan = in_array('surat_penugasan', $uploadedDokumens) || in_array('Surat Penugasan', $uploadedDokumens);
                    @endphp
                    <div class="flex items-center gap-4 p-4 rounded-xl border {{ $hasSuratPenugasan ? 'border-blue-100 bg-blue-50/30' : 'border-slate-200 bg-white' }} hover:shadow-sm transition-all duration-300">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 {{ $hasSuratPenugasan ? 'bg-blue-100 text-blue-600' : 'bg-slate-100 text-slate-400' }}">
                            @if($hasSuratPenugasan)
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">Surat Penugasan</p>
                            <p class="text-xs font-semibold mt-1 {{ $hasSuratPenugasan ? 'text-blue-600' : 'text-slate-500' }}">
                                {{ $hasSuratPenugasan ? 'Terverifikasi' : 'Belum Diunggah' }}
                            </p>
                        </div>
                    </div>

                    {{-- Document Item 2: KTM Terbaru --}}
                    @php
                        $hasKtmTerbaru = in_array('ktm_terbaru', $uploadedDokumens) || in_array('KTM Terbaru', $uploadedDokumens);
                    @endphp
                    <div class="flex items-center gap-4 p-4 rounded-xl border {{ $hasKtmTerbaru ? 'border-blue-100 bg-blue-50/30' : 'border-slate-200 bg-white' }} hover:shadow-sm transition-all duration-300">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 {{ $hasKtmTerbaru ? 'bg-blue-100 text-blue-600' : 'bg-slate-100 text-slate-400' }}">
                            @if($hasKtmTerbaru)
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">KTM Terbaru</p>
                            <p class="text-xs font-semibold mt-1 {{ $hasKtmTerbaru ? 'text-blue-600' : 'text-slate-500' }}">
                                {{ $hasKtmTerbaru ? 'Terverifikasi' : 'Belum Diunggah' }}
                            </p>
                        </div>
                    </div>

                    {{-- Document Item 3: Ijazah Sementara --}}
                    @php
                        $hasIjazahSementara = in_array('ijazah_sementara', $uploadedDokumens) || in_array('Ijazah Sementara', $uploadedDokumens);
                    @endphp
                    <div class="flex items-center gap-4 p-4 rounded-xl border {{ $hasIjazahSementara ? 'border-blue-100 bg-blue-50/30' : 'border-slate-200 bg-white' }} hover:shadow-sm transition-all duration-300">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 {{ $hasIjazahSementara ? 'bg-blue-100 text-blue-600' : 'bg-slate-100 text-slate-400' }}">
                            @if($hasIjazahSementara)
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">Ijazah Sementara</p>
                            <p class="text-xs font-semibold mt-1 {{ $hasIjazahSementara ? 'text-blue-600' : 'text-slate-500' }}">
                                {{ $hasIjazahSementara ? 'Terverifikasi' : 'Belum Diunggah' }}
                            </p>
                        </div>
                    </div>

                    {{-- Document Item 4: Surat Keterangan --}}
                    @php
                        $hasSuratKeterangan = in_array('surat_keterangan', $uploadedDokumens) || in_array('Surat Keterangan', $uploadedDokumens);
                    @endphp
                    <div class="flex items-center gap-4 p-4 rounded-xl border {{ $hasSuratKeterangan ? 'border-blue-100 bg-blue-50/30' : 'border-slate-200 bg-white' }} hover:shadow-sm transition-all duration-300">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 {{ $hasSuratKeterangan ? 'bg-blue-100 text-blue-600' : 'bg-slate-100 text-slate-400' }}">
                            @if($hasSuratKeterangan)
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">Surat Keterangan</p>
                            <p class="text-xs font-semibold mt-1 {{ $hasSuratKeterangan ? 'text-blue-600' : 'text-slate-500' }}">
                                {{ $hasSuratKeterangan ? 'Terverifikasi' : 'Belum Diunggah' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ringkasan Aktivitas Mingguan --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="bg-slate-50 p-2 rounded-lg text-slate-600 border border-slate-100 hidden sm:block">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-base md:text-lg font-bold text-slate-800">Aktivitas Logbook Mingguan</h2>
                            <p class="text-xs text-slate-500 font-medium mt-0.5">Grafik jumlah jam pengerjaan</p>
                        </div>
                    </div>
                    <a href="{{ route('mahasiswa.logbook.index') }}" class="text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-lg text-sm font-bold transition-colors w-full sm:w-auto text-center">Lihat Detail</a>
                </div>

                {{-- Modern Simple Bar Chart --}}
                <div class="flex items-end justify-between h-56 px-4 bg-slate-50 rounded-xl pt-8 pb-4 border border-slate-100">
                    <div class="flex flex-col items-center w-full group">
                        <div class="w-10 md:w-16 bg-blue-400 group-hover:bg-blue-500 rounded-t-lg transition-all duration-300" style="height: 140px;"></div>
                        <p class="text-xs font-bold text-slate-500 mt-3">Sen</p>
                    </div>
                    <div class="flex flex-col items-center w-full group">
                        <div class="w-10 md:w-16 bg-blue-400 group-hover:bg-blue-500 rounded-t-lg transition-all duration-300" style="height: 160px;"></div>
                        <p class="text-xs font-bold text-slate-500 mt-3">Sel</p>
                    </div>
                    <div class="flex flex-col items-center w-full group">
                        <div class="w-10 md:w-16 bg-blue-600 rounded-t-lg transition-all duration-300 relative shadow-sm" style="height: 180px;">
                            <span class="absolute -top-7 left-1/2 transform -translate-x-1/2 bg-slate-800 text-white text-[10px] font-bold px-2 py-1 rounded">Peak</span>
                        </div>
                        <p class="text-xs font-bold text-slate-800 mt-3">Rab</p>
                    </div>
                    <div class="flex flex-col items-center w-full group">
                        <div class="w-10 md:w-16 bg-blue-400 group-hover:bg-blue-500 rounded-t-lg transition-all duration-300" style="height: 120px;"></div>
                        <p class="text-xs font-bold text-slate-500 mt-3">Kam</p>
                    </div>
                    <div class="flex flex-col items-center w-full group">
                        <div class="w-10 md:w-16 bg-blue-400 group-hover:bg-blue-500 rounded-t-lg transition-all duration-300" style="height: 170px;"></div>
                        <p class="text-xs font-bold text-slate-500 mt-3">Jum</p>
                    </div>
                </div>
            </div>

            {{-- Riwayat Kegiatan Terbaru --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="bg-slate-50 p-2 rounded-lg text-slate-600 border border-slate-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h2 class="text-lg font-bold text-slate-800">Riwayat Kegiatan Terbaru</h2>
                    </div>
                </div>

                <div class="space-y-0 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:ml-6 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-200 before:to-transparent">
                    @forelse($logbookTerbaru as $logbook)
                        @php
                            $kegData = json_decode($logbook->kegiatan, true);
                            $judul = is_array($kegData) ? $kegData['judul'] : $logbook->kegiatan;
                            $deskripsi = is_array($kegData) ? $kegData['deskripsi'] : '';
                        @endphp
                        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active py-4">
                            <!-- Icon -->
                            <div class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-blue-100 text-blue-600 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <!-- Card -->
                            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-4 rounded-xl border border-slate-200 shadow-sm group-hover:border-blue-200 transition-colors">
                                <div class="flex items-center justify-between mb-1">
                                    <h3 class="font-bold text-slate-800 text-sm">{{ $judul }}</h3>
                                </div>
                                @if($deskripsi)
                                    <p class="text-sm text-slate-600 line-clamp-2 mt-1 mb-2">{{ $deskripsi }}</p>
                                @endif
                                <time class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-md inline-block">{{ \Carbon\Carbon::parse($logbook->tanggal)->translatedFormat('d F Y') }}</time>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-slate-50 mb-3">
                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            </div>
                            <p class="text-slate-500 font-medium">Belum ada riwayat kegiatan tercatat.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Right Column (1/3) --}}
        <div class="space-y-8">
            
            {{-- Detail Penempatan MBKM --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 overflow-hidden relative">
                <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-bl-full opacity-50 -z-10"></div>
                <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5.581m0 0H9m5.581 0a2 2 0 110-4m0 4a2 2 0 110 4m0-4V9m0 4H4m5.581 8H9"></path></svg>
                    Detail Penempatan
                </h2>

                <div class="space-y-5">
                    <div class="flex gap-3 items-start">
                        <div class="bg-blue-50 p-2 rounded-lg text-blue-600 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Mitra Industri</p>
                            <p class="text-sm font-bold text-slate-800 mt-1">
                                {{ $pendaftaran && $pendaftaran->mitraMbkm ? $pendaftaran->mitraMbkm->nama_mitra : 'Belum Ditentukan' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-3 items-start">
                        <div class="bg-blue-50 p-2 rounded-lg text-blue-600 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Lokasi Kerja</p>
                            <p class="text-sm font-bold text-slate-800 mt-1 line-clamp-2">
                                {{ $pendaftaran && $pendaftaran->mitraMbkm ? $pendaftaran->mitraMbkm->alamat : '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-3 items-start">
                        <div class="bg-blue-50 p-2 rounded-lg text-blue-600 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Periode MBKM</p>
                            <p class="text-sm font-bold text-slate-800 mt-1">
                                @if($pendaftaran && $pendaftaran->tgl_mulai && $pendaftaran->tgl_selesai)
                                    {{ \Carbon\Carbon::parse($pendaftaran->tgl_mulai)->translatedFormat('M Y') }} - {{ \Carbon\Carbon::parse($pendaftaran->tgl_selesai)->translatedFormat('M Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-3 items-start">
                        <div class="bg-blue-50 p-2 rounded-lg text-blue-600 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Status</p>
                            <div class="mt-1.5">
                                @if($pendaftaran)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-green-100 text-green-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                        {{ ucfirst($pendaftaran->status) }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-slate-100 text-slate-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mr-1.5"></span>
                                        Tidak Aktif
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tim Pembimbing --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Tim Pembimbing
                </h2>

                <div class="space-y-4">
                    {{-- Dosen Akademik --}}
                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-slate-50 border border-transparent hover:border-slate-100 transition-colors">
                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
                            {{ $pendaftaran && $pendaftaran->dosenPembimbing ? substr($pendaftaran->dosenPembimbing->user->name, 0, 1) : '?' }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800 line-clamp-1">
                                {{ $pendaftaran && $pendaftaran->dosenPembimbing ? $pendaftaran->dosenPembimbing->user->name : 'Belum Ditentukan' }}
                            </p>
                            <p class="text-xs font-medium text-slate-500">Dosen Pembimbing Akademik</p>
                        </div>
                    </div>

                    {{-- Mentor Industri --}}
                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-slate-50 border border-transparent hover:border-slate-100 transition-colors">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
                            A
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800 line-clamp-1">
                                {{ $pendaftaran ? 'Anugroh Bayu Satrio' : '-' }}
                            </p>
                            <p class="text-xs font-medium text-slate-500">Mentor Industri</p>
                        </div>
                    </div>

                    {{-- Penguji --}}
                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-slate-50 border border-transparent hover:border-slate-100 transition-colors">
                        <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
                            E
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800 line-clamp-1">
                                {{ $pendaftaran ? 'Dr. Eddy Pratama, S.T., M.T.' : '-' }}
                            </p>
                            <p class="text-xs font-medium text-slate-500">Dosen Penguji</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Akumulasi Nilai --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Akumulasi Nilai
                </h2>

                <div class="space-y-5">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-bold text-slate-700">Nilai Pembimbing</p>
                            <span class="text-sm font-black {{ $nilaiPembimbingVal !== null ? 'text-blue-600' : 'text-slate-400' }}">
                                {{ $nilaiPembimbingVal !== null ? number_format($nilaiPembimbingVal, 1) : '0.0' }}
                            </span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $nilaiPembimbingVal !== null ? $nilaiPembimbingVal : 0 }}%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-bold text-slate-700">Nilai Lapangan</p>
                            <span class="text-sm font-black {{ $nilaiMitraVal !== null ? 'text-blue-600' : 'text-slate-400' }}">
                                {{ $nilaiMitraVal !== null ? number_format($nilaiMitraVal, 1) : '0.0' }}
                            </span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $nilaiMitraVal !== null ? $nilaiMitraVal : 0 }}%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-bold text-slate-700">Nilai Penguji</p>
                            <span class="text-sm font-black {{ $nilaiPengujiVal !== null ? 'text-slate-800' : 'text-slate-400' }}">
                                {{ $nilaiPengujiVal !== null ? number_format($nilaiPengujiVal, 1) : 'Menunggu' }}
                            </span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-slate-300 h-2 rounded-full" style="width: {{ $nilaiPengujiVal !== null ? $nilaiPengujiVal : 0 }}%"></div>
                        </div>
                    </div>
                </div>

                {{-- Grade Card --}}
                <div class="bg-blue-600 rounded-2xl p-5 mt-8 text-white text-center shadow-md relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-16 h-16 bg-white opacity-10 rounded-full"></div>
                    <div class="absolute -left-6 -bottom-6 w-24 h-24 bg-white opacity-10 rounded-full"></div>
                    
                    <p class="text-xs font-bold uppercase tracking-wider mb-1 opacity-90">Prediksi Nilai Akhir</p>
                    <p class="text-5xl font-black my-2">{{ $gradePredicted }}</p>
                    <p class="text-xs font-medium opacity-80">Berdasarkan kalkulasi saat ini</p>
                </div>
            </div>
            
        </div>
    </div>
@endsection
