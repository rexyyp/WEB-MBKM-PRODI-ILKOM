@extends('layouts.mahasiswa')

@section('title', 'Laporan - Mahasiswa')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900 mb-2">Laporan MBKM</h1>
        <p class="text-slate-600 text-lg">Kelola dan download laporan hasil kegiatan MBKM Anda.</p>
    </div>

    {{-- Action Button --}}
    <div class="mb-8">
        <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Laporan Baru
        </button>
    </div>

    {{-- Reports List --}}
    <div class="space-y-4 mb-8">
        {{-- Report 1: Progress Report --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-start justify-between">
                <div class="flex items-start gap-4 flex-1">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 12h6m-6 4h6m2-5a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-slate-900 mb-1">Laporan Progress Bulan Mei</h3>
                        <p class="text-sm text-slate-600 mb-3">Laporan perkembangan aktivitas MBKM bulan pertama</p>
                        <div class="flex items-center gap-4">
                            <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">✓ Disetujui</span>
                            <span class="text-xs text-slate-500">Dibuat: 31 Mei 2024</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button class="text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                    </button>
                    <button class="text-slate-400 hover:text-slate-600 p-2 hover:bg-slate-100 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Report 2: Mid-term Report --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-start justify-between">
                <div class="flex items-start gap-4 flex-1">
                    <div class="w-14 h-14 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8 text-amber-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 12h6m-6 4h6m2-5a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-slate-900 mb-1">Laporan Tengah Semester</h3>
                        <p class="text-sm text-slate-600 mb-3">Evaluasi progress dan capaian hingga 2 bulan pertama MBKM</p>
                        <div class="flex items-center gap-4">
                            <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">⏳ Pending Review</span>
                            <span class="text-xs text-slate-500">Dibuat: 15 Juni 2024</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button class="text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                    </button>
                    <button class="text-slate-400 hover:text-slate-600 p-2 hover:bg-slate-100 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Report 3: Draft Report --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-start justify-between">
                <div class="flex items-start gap-4 flex-1">
                    <div class="w-14 h-14 bg-slate-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8 text-slate-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 12h6m-6 4h6m2-5a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-slate-900 mb-1">Laporan Bulan Juli (Draft)</h3>
                        <p class="text-sm text-slate-600 mb-3">Draft laporan perkembangan aktivitas MBKM bulan ketiga</p>
                        <div class="flex items-center gap-4">
                            <span class="inline-block bg-slate-100 text-slate-800 text-xs font-semibold px-3 py-1 rounded-full">📝 Draft</span>
                            <span class="text-xs text-slate-500">Dibuat: 5 Juli 2024</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button class="text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <button class="text-slate-400 hover:text-slate-600 p-2 hover:bg-slate-100 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Report Template Section --}}
    <div class="bg-white rounded-xl shadow-md p-8 mb-8">
        <h3 class="text-2xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-200">Template Laporan</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <button class="border-2 border-slate-200 hover:border-blue-500 hover:bg-blue-50 rounded-lg p-6 text-left transition-all duration-200">
                <svg class="w-8 h-8 text-blue-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-5a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="font-semibold text-slate-900 mb-1">Laporan Progress</p>
                <p class="text-sm text-slate-600">Template untuk laporan progress bulanan</p>
            </button>
            <button class="border-2 border-slate-200 hover:border-blue-500 hover:bg-blue-50 rounded-lg p-6 text-left transition-all duration-200">
                <svg class="w-8 h-8 text-blue-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                </svg>
                <p class="font-semibold text-slate-900 mb-1">Laporan Akhir</p>
                <p class="text-sm text-slate-600">Template untuk laporan akhir MBKM</p>
            </button>
        </div>
    </div>

    {{-- Footer Text --}}
    <div class="text-center text-sm text-slate-500 mt-12 py-8 border-t border-slate-200">
        <p>© 2026 Sistem Manajemen MBKM • Program Studi Ilmu Komputer</p>
    </div>
@endsection
