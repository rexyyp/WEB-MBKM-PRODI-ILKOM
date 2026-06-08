@extends('layouts.mahasiswa')

@section('title', 'Dashboard - Mahasiswa')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-2">Selamat Datang</h1>
        <p class="text-slate-600">Pantau progres dan aktivitas MBKM Anda secara real-time.</p>
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
            <p class="text-3xl font-bold text-blue-600 mb-2">Berjalan</p>
            <p class="text-xs text-slate-600">Durasi: 6 bulan</p>
        </div>

        {{-- Progress Card --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-slate-900">Progress Keseluruhan</h3>
                <span class="text-2xl">📊</span>
            </div>
            <div class="mb-2">
                <p class="text-3xl font-bold text-blue-600">65%</p>
                <p class="text-xs text-slate-600">4 bulan tercapai</p>
            </div>
            <div class="w-full bg-slate-200 rounded-full h-2">
                <div class="bg-blue-600 h-2 rounded-full" style="width: 65%"></div>
            </div>
        </div>

        {{-- Verification Card --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-slate-900">Verifikasi Dokumen</h3>
                <span class="text-2xl">✅</span>
            </div>
            <p class="text-3xl font-bold text-blue-600 mb-2">50%</p>
            <p class="text-xs text-slate-600">2 dari 4 dokumen</p>
        </div>

        {{-- Logbook Card --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-slate-900">Total Logbook</h3>
                <span class="text-2xl">📝</span>
            </div>
            <p class="text-3xl font-bold text-blue-600 mb-2">42</p>
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
                    {{-- Document Item 1 --}}
                    <div class="border border-slate-200 rounded-lg p-4 text-center hover:bg-slate-50 transition-colors">
                        <div class="flex justify-center mb-3">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm font-medium text-slate-900">Surat Penugasan</p>
                        <p class="text-xs text-green-600 mt-1">Terverifikasi</p>
                    </div>

                    {{-- Document Item 2 --}}
                    <div class="border border-slate-200 rounded-lg p-4 text-center hover:bg-slate-50 transition-colors">
                        <div class="flex justify-center mb-3">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm font-medium text-slate-900">KTM Terbaru</p>
                        <p class="text-xs text-green-600 mt-1">Terverifikasi</p>
                    </div>

                    {{-- Document Item 3 --}}
                    <div class="border border-slate-200 rounded-lg p-4 text-center hover:bg-slate-50 transition-colors">
                        <div class="flex justify-center mb-3">
                            <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm font-medium text-slate-900">Ijazah Sementara</p>
                        <p class="text-xs text-slate-500 mt-1">Belum Upload</p>
                    </div>

                    {{-- Document Item 4 --}}
                    <div class="border border-slate-200 rounded-lg p-4 text-center hover:bg-slate-50 transition-colors">
                        <div class="flex justify-center mb-3">
                            <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm font-medium text-slate-900">Surat Keterangan</p>
                        <p class="text-xs text-slate-500 mt-1">Belum Upload</p>
                    </div>
                </div>
            </div>

            {{-- Ringkasan Aktivitas Mingguan --}}
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-slate-900">Ringkasan Aktivitas Mingguan</h2>
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Lebih →</a>
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
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Semua →</a>
                </div>

                <div class="space-y-4">
                    {{-- Activity Item 1 --}}
                    <div class="flex gap-4 pb-4 border-b border-slate-200">
                        <div class="w-2 h-12 bg-blue-500 rounded flex-shrink-0"></div>
                        <div class="flex-1">
                            <p class="font-medium text-slate-900">Pengiriman Logbook Mingguan ke-12</p>
                            <p class="text-sm text-slate-600">Dokumentasi hasil development project kerjasama dengan tim backend.</p>
                            <p class="text-xs text-slate-500 mt-1">+12 Juni</p>
                        </div>
                    </div>

                    {{-- Activity Item 2 --}}
                    <div class="flex gap-4">
                        <div class="w-2 h-12 bg-slate-300 rounded flex-shrink-0"></div>
                        <div class="flex-1">
                            <p class="font-medium text-slate-900">Pembimbingan Tatap Muka</p>
                            <p class="text-sm text-slate-600">Pemberian masukan untuk penyelesaian project akhir MBKM dari dosen pembimbing dan industri.</p>
                            <p class="text-xs text-slate-500 mt-1">5 Juni</p>
                        </div>
                    </div>
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
                        <p class="text-sm font-medium text-slate-900 mt-1">PT. Prodi Ilmu Komputer FPIPKA UPI</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase">Lokasi Kerja</p>
                        <p class="text-sm font-medium text-slate-900 mt-1">Jl. Setiabudhi No. 229, Bandung Jawa Barat, Jakarta Selatan, DKI Jakarta</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase">Periode MBKM</p>
                        <p class="text-sm font-medium text-slate-900 mt-1">April 2026 - Agustus 2026</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase">Status</p>
                        <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full mt-1">Aktif</span>
                    </div>
                </div>
            </div>

            {{-- Tim Pembimbing --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Tim Pembimbing</h2>

                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase">Pembimbing Akademik</p>
                        <p class="text-sm font-medium text-slate-900 mt-1">Dr. Muhammad Rizauddin, M.T.</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase">Pembimbing Industri</p>
                        <p class="text-sm font-medium text-slate-900 mt-1">Anugroh Bayu Satrio</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase">Penggawai Industri</p>
                        <p class="text-sm font-medium text-slate-900 mt-1">Dr. Eddy Pratama Maguris, S.T., M.T.</p>
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
                            <span class="text-sm font-semibold text-slate-900">88.5</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 88.5%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-sm font-medium text-slate-900">Nilai Lapangan</p>
                            <span class="text-sm font-semibold text-slate-900">92.0</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 92%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-sm font-medium text-slate-900">Nilai Akhir</p>
                            <span class="text-sm font-semibold text-slate-900">Menunggu</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-slate-300 h-2 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>
                </div>

                {{-- Grade Card --}}
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg p-4 mt-6 text-white text-center">
                    <p class="text-xs font-semibold uppercase mb-1">Prediksi Nilai Akhir</p>
                    <p class="text-5xl font-bold">A-</p>
                    <p class="text-xs mt-1 text-blue-100">Berdasarkan nilai saat ini</p>
                </div>
            </div>
        </div>
    </div>
@endsection
