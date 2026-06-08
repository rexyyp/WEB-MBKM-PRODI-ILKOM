@extends('layouts.admin')

@section('title', 'Laporan - Admin')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Laporan</h1>
            <p class="text-slate-600">Unduh laporan kegiatan MBKM</p>
        </div>
        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">📥 Unduh Laporan</button>
    </div>

    {{-- Report Types --}}
    <div class="grid grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow cursor-pointer">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h3 class="font-semibold text-slate-900">Laporan Keseluruhan</h3>
                    <p class="text-sm text-slate-500">Ringkasan semua kegiatan</p>
                </div>
                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">Unduh →</button>
        </div>

        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow cursor-pointer">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h3 class="font-semibold text-slate-900">Laporan per Mitra</h3>
                    <p class="text-sm text-slate-500">Statistik per mitra industri</p>
                </div>
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                </svg>
            </div>
            <button class="text-green-600 hover:text-green-800 text-sm font-medium">Unduh →</button>
        </div>

        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow cursor-pointer">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h3 class="font-semibold text-slate-900">Laporan Penilaian</h3>
                    <p class="text-sm text-slate-500">Hasil penilaian semua mahasiswa</p>
                </div>
                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
            </div>
            <button class="text-yellow-600 hover:text-yellow-800 text-sm font-medium">Unduh →</button>
        </div>
    </div>

    {{-- Recent Reports --}}
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-slate-900 mb-4">Laporan Terbaru</h2>
        <div class="space-y-3">
            <div class="flex items-center justify-between pb-3 border-b border-slate-200">
                <div>
                    <p class="font-medium text-slate-900">Laporan Bulanan - Mei 2024</p>
                    <p class="text-sm text-slate-500">Diunduh 2 hari lalu</p>
                </div>
                <button class="text-blue-600 hover:text-blue-800 text-sm">Unduh Ulang</button>
            </div>
        </div>
    </div>
@endsection
