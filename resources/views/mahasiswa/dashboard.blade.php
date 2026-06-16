@extends('layouts.mahasiswa')

@section('title', 'Dashboard - Mahasiswa')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Beranda</h1>
        </div>
    </div>

    {{-- Alur MBKM Stepper --}}
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-lg font-semibold text-slate-900 mb-2">Alur Kegiatan MBKM</h2>
        <x-stepper />
    </div>

    {{-- Alert Boxes --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        {{-- Alert Error --}}
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 flex items-start gap-3">
            <svg class="w-6 h-6 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            <div>
                <h3 class="font-semibold text-red-800">Laporan Harian Belum Terisi</h3>
                <p class="text-sm text-red-700">Anda memiliki 3 laporan harian yang belum diisi. Mohon segera lengkapi sebelum 14 Mei 2025.</p>
            </div>
        </div>

        {{-- Alert Warning --}}
        <div class="bg-yellow-50 border-l-4 border-yellow-400 rounded-lg p-4 flex items-start gap-3">
            <svg class="w-6 h-6 text-yellow-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            <div>
                <h3 class="font-semibold text-yellow-800">Dokumen MBKM belum lengkap</h3>
                <p class="text-sm text-yellow-700">Anda masih perlu mengunggah surat penempatan dan dokumen ijazah sementara.</p>
            </div>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        {{-- Status Program Card --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-slate-900">Status Program</h3>
                <span class="text-2xl">📋</span>
            </div>
            <p class="text-3xl font-bold text-blue-600 mb-2">
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
            <p class="text-xs text-slate-600">
                Durasi: 
                @if($pendaftaran && $pendaftaran->tgl_mulai && $pendaftaran->tgl_selesai)
                    {{ \Carbon\Carbon::parse($pendaftaran->tgl_mulai)->diffInMonths(\Carbon\Carbon::parse($pendaftaran->tgl_selesai)) }} bulan
                @else
                    -
                @endif
            </p>
        </div>

        {{-- Progress Card --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-slate-900">Progress Keseluruhan</h3>
                <span class="text-2xl">📊</span>
            </div>
            <div class="mb-2">
                <p class="text-3xl font-bold text-blue-600">{{ $progressPercent }}%</p>
                <p class="text-xs text-slate-600">{{ $progressText }}</p>
            </div>
            <div class="w-full bg-slate-200 rounded-full h-2">
                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $progressPercent }}%"></div>
            </div>
        </div>

        {{-- Verification Card --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-slate-900">Verifikasi Dokumen</h3>
                <span class="text-2xl">✅</span>
            </div>
            <p class="text-3xl font-bold text-blue-600 mb-2">{{ $dokumenPercent }}%</p>
            <p class="text-xs text-slate-600">{{ $dokumenUploaded }} dari {{ $totalDokumen }} dokumen</p>
        </div>

        {{-- Logbook Card --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-slate-900">Total Logbook</h3>
                <span class="text-2xl">📝</span>
            </div>
            <p class="text-3xl font-bold text-blue-600 mb-2">{{ $totalLogbook }}</p>
            <p class="text-xs text-slate-600">entri terdaftar</p>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        {{-- Left Column (2/3) --}}
        <div class="lg:col-span-2 space-y-8">
            {{-- Status Dokumen Administratori --}}
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-slate-900">Status Dokumen Administratori</h2>
                    <button class="text-blue-600 hover:text-blue-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    {{-- Document Item 1: Surat Penugasan --}}
                    @php
                        $hasSuratPenugasan = in_array('surat_penugasan', $uploadedDokumens) || in_array('Surat Penugasan', $uploadedDokumens);
                    @endphp
                    <div class="border border-slate-200 rounded-lg p-4 text-center hover:bg-slate-50 transition-colors">
                        <div class="flex justify-center mb-3">
                            <div class="w-12 h-12 {{ $hasSuratPenugasan ? 'bg-green-100' : 'bg-slate-100' }} rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 {{ $hasSuratPenugasan ? 'text-green-600' : 'text-slate-400' }}" fill="currentColor" viewBox="0 0 20 20">
                                    @if($hasSuratPenugasan)
                                        <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path>
                                    @else
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    @endif
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm font-medium text-slate-900">Surat Penugasan</p>
                        <p class="text-xs {{ $hasSuratPenugasan ? 'text-green-600' : 'text-slate-500' }} mt-1">
                            {{ $hasSuratPenugasan ? 'Terverifikasi' : 'Belum Upload' }}
                        </p>
                    </div>

                    {{-- Document Item 2: KTM Terbaru --}}
                    @php
                        $hasKtmTerbaru = in_array('ktm_terbaru', $uploadedDokumens) || in_array('KTM Terbaru', $uploadedDokumens);
                    @endphp
                    <div class="border border-slate-200 rounded-lg p-4 text-center hover:bg-slate-50 transition-colors">
                        <div class="flex justify-center mb-3">
                            <div class="w-12 h-12 {{ $hasKtmTerbaru ? 'bg-green-100' : 'bg-slate-100' }} rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 {{ $hasKtmTerbaru ? 'text-green-600' : 'text-slate-400' }}" fill="currentColor" viewBox="0 0 20 20">
                                    @if($hasKtmTerbaru)
                                        <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path>
                                    @else
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    @endif
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm font-medium text-slate-900">KTM Terbaru</p>
                        <p class="text-xs {{ $hasKtmTerbaru ? 'text-green-600' : 'text-slate-500' }} mt-1">
                            {{ $hasKtmTerbaru ? 'Terverifikasi' : 'Belum Upload' }}
                        </p>
                    </div>

                    {{-- Document Item 3: Ijazah Sementara --}}
                    @php
                        $hasIjazahSementara = in_array('ijazah_sementara', $uploadedDokumens) || in_array('Ijazah Sementara', $uploadedDokumens);
                    @endphp
                    <div class="border border-slate-200 rounded-lg p-4 text-center hover:bg-slate-50 transition-colors">
                        <div class="flex justify-center mb-3">
                            <div class="w-12 h-12 {{ $hasIjazahSementara ? 'bg-green-100' : 'bg-slate-100' }} rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 {{ $hasIjazahSementara ? 'text-green-600' : 'text-slate-400' }}" fill="currentColor" viewBox="0 0 20 20">
                                    @if($hasIjazahSementara)
                                        <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path>
                                    @else
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    @endif
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm font-medium text-slate-900">Ijazah Sementara</p>
                        <p class="text-xs {{ $hasIjazahSementara ? 'text-green-600' : 'text-slate-500' }} mt-1">
                            {{ $hasIjazahSementara ? 'Terverifikasi' : 'Belum Upload' }}
                        </p>
                    </div>

                    {{-- Document Item 4: Surat Keterangan --}}
                    @php
                        $hasSuratKeterangan = in_array('surat_keterangan', $uploadedDokumens) || in_array('Surat Keterangan', $uploadedDokumens);
                    @endphp
                    <div class="border border-slate-200 rounded-lg p-4 text-center hover:bg-slate-50 transition-colors">
                        <div class="flex justify-center mb-3">
                            <div class="w-12 h-12 {{ $hasSuratKeterangan ? 'bg-green-100' : 'bg-slate-100' }} rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 {{ $hasSuratKeterangan ? 'text-green-600' : 'text-slate-400' }}" fill="currentColor" viewBox="0 0 20 20">
                                    @if($hasSuratKeterangan)
                                        <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path>
                                    @else
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    @endif
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm font-medium text-slate-900">Surat Keterangan</p>
                        <p class="text-xs {{ $hasSuratKeterangan ? 'text-green-600' : 'text-slate-500' }} mt-1">
                            {{ $hasSuratKeterangan ? 'Terverifikasi' : 'Belum Upload' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Ringkasan Aktivitas Mingguan --}}
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-slate-900">Ringkasan Aktivitas Mingguan</h2>
                    <a href="{{ route('mahasiswa.logbook.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Lebih →</a>
                </div>

                {{-- Simple Chart --}}
                <div class="flex items-end justify-around h-48">
                    <div class="flex flex-col items-center">
                        <div class="w-12 bg-blue-500 rounded-t" style="height: 140px;"></div>
                        <p class="text-xs text-slate-600 mt-2">Senin</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-12 bg-blue-500 rounded-t" style="height: 160px;"></div>
                        <p class="text-xs text-slate-600 mt-2">Selasa</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-12 bg-blue-500 rounded-t" style="height: 180px;"></div>
                        <p class="text-xs text-slate-600 mt-2">Rabu</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-12 bg-blue-500 rounded-t" style="height: 120px;"></div>
                        <p class="text-xs text-slate-600 mt-2">Kamis</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-12 bg-blue-500 rounded-t" style="height: 170px;"></div>
                        <p class="text-xs text-slate-600 mt-2">Jumat</p>
                    </div>
                </div>
            </div>

            {{-- Riwayat Kegiatan Terbaru --}}
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-slate-900">Riwayat Kegiatan Terbaru</h2>
                    <a href="{{ route('mahasiswa.logbook.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Semua →</a>
                </div>

                <div class="space-y-4">
                    @forelse($logbookTerbaru as $logbook)
                        @php
                            // Decode if it's JSON from our store method
                            $kegData = json_decode($logbook->kegiatan, true);
                            $judul = is_array($kegData) ? $kegData['judul'] : $logbook->kegiatan;
                            $deskripsi = is_array($kegData) ? $kegData['deskripsi'] : '';
                        @endphp
                        <div class="flex gap-4 pb-4 border-b border-slate-200">
                            <div class="w-2 h-12 bg-blue-500 rounded flex-shrink-0"></div>
                            <div class="flex-1">
                                <p class="font-medium text-slate-900">{{ $judul }}</p>
                                @if($deskripsi)
                                    <p class="text-sm text-slate-600 line-clamp-2">{{ $deskripsi }}</p>
                                @endif
                                <p class="text-xs text-slate-500 mt-1">{{ \Carbon\Carbon::parse($logbook->tanggal)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-slate-500">
                            Belum ada riwayat logbook terdaftar.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Right Column (1/3) --}}
        <div class="space-y-8">
            {{-- Detail Penempatan MBKM --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Detail Penempatan MBKM</h2>

                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase">Mitra Industri</p>
                        <p class="text-sm font-medium text-slate-900 mt-1">
                            {{ $pendaftaran && $pendaftaran->mitraMbkm ? $pendaftaran->mitraMbkm->nama_mitra : '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase">Lokasi Kerja</p>
                        <p class="text-sm font-medium text-slate-900 mt-1">
                            {{ $pendaftaran && $pendaftaran->mitraMbkm ? $pendaftaran->mitraMbkm->alamat : '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase">Periode MBKM</p>
                        <p class="text-sm font-medium text-slate-900 mt-1">
                            @if($pendaftaran && $pendaftaran->tgl_mulai && $pendaftaran->tgl_selesai)
                                {{ \Carbon\Carbon::parse($pendaftaran->tgl_mulai)->translatedFormat('F Y') }} - {{ \Carbon\Carbon::parse($pendaftaran->tgl_selesai)->translatedFormat('F Y') }}
                            @else
                                -
                            @endif
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase">Status</p>
                        @if($pendaftaran)
                            <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full mt-1">
                                {{ ucfirst($pendaftaran->status) }}
                            </span>
                        @else
                            <span class="inline-block bg-slate-100 text-slate-800 text-xs font-semibold px-3 py-1 rounded-full mt-1">
                                Tidak Aktif
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Tim Pembimbing --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Tim Pembimbing</h2>

                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase">Pembimbing Akademik</p>
                        <p class="text-sm font-medium text-slate-900 mt-1">
                            {{ $pendaftaran && $pendaftaran->dosenPembimbing ? $pendaftaran->dosenPembimbing->user->name : '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase">Pembimbing Industri</p>
                        <p class="text-sm font-medium text-slate-900 mt-1">
                            {{ $pendaftaran ? 'Anugroh Bayu Satrio' : '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase">Penggawai Industri</p>
                        <p class="text-sm font-medium text-slate-900 mt-1">
                            {{ $pendaftaran ? 'Dr. Eddy Pratama Maguris, S.T., M.T.' : '-' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Akumulasi Nilai --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Akumulasi Nilai</h2>

                <div class="space-y-3">
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-sm font-medium text-slate-900">Nilai Pembimbing</p>
                            <span class="text-sm font-semibold text-slate-900">
                                {{ $nilaiPembimbingVal !== null ? number_format($nilaiPembimbingVal, 1) : 'Menunggu' }}
                            </span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $nilaiPembimbingVal !== null ? $nilaiPembimbingVal : 0 }}%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-sm font-medium text-slate-900">Nilai Lapangan</p>
                            <span class="text-sm font-semibold text-slate-900">
                                {{ $nilaiMitraVal !== null ? number_format($nilaiMitraVal, 1) : 'Menunggu' }}
                            </span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $nilaiMitraVal !== null ? $nilaiMitraVal : 0 }}%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-sm font-medium text-slate-900">Nilai Penguji</p>
                            <span class="text-sm font-semibold text-slate-900">
                                {{ $nilaiPengujiVal !== null ? number_format($nilaiPengujiVal, 1) : 'Menunggu' }}
                            </span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-slate-300 h-2 rounded-full" style="width: {{ $nilaiPengujiVal !== null ? $nilaiPengujiVal : 0 }}%"></div>
                        </div>
                    </div>
                </div>

                {{-- Grade Card --}}
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg p-4 mt-6 text-white text-center">
                    <p class="text-xs font-semibold uppercase mb-1">Prediksi Nilai Akhir</p>
                    <p class="text-5xl font-bold">{{ $gradePredicted }}</p>
                    <p class="text-xs mt-1 text-blue-100">Berdasarkan nilai saat ini</p>
                </div>
            </div>
        </div>
    </div>
@endsection
