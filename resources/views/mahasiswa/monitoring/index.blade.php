@extends('layouts.mahasiswa')

@section('title', 'Monitoring - Mahasiswa')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Monitoring MBKM</h1>
        </div>
        <p class="text-slate-600 text-lg">Pantau progress dan pencapaian Anda selama MBKM.</p>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        {{-- Card 1: Progress Waktu --}}
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-slate-900">Progres Waktu</h3>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-blue-600">75%</p>
            <p class="text-sm text-slate-600 mt-2">3 bulan dari 4 bulan</p>
        </div>

        {{-- Card 2: Dokumen Terserah --}}
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-slate-900">Dokumen</h3>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-green-600">4/5</p>
            <p class="text-sm text-slate-600 mt-2">Serah terima lengkap</p>
        </div>

        {{-- Card 3: Logbook Entries --}}
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-slate-900">Logbook</h3>
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17.25m20 0c0-6.252-4.5-10.997-10-11.747m0 0c-5.5.75-10 5.495-10 11.747m20 0H4.5"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-purple-600">52</p>
            <p class="text-sm text-slate-600 mt-2">Total entries tercatat</p>
        </div>

        {{-- Card 4: Penilaian --}}
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-slate-900">Penilaian</h3>
                <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-amber-600">88.5</p>
            <p class="text-sm text-slate-600 mt-2">Nilai rata-rata</p>
        </div>
    </div>

    {{-- Progress Tracker Card --}}
    <div class="bg-white rounded-xl shadow-md p-8 mb-8">
        <h3 class="text-2xl font-bold text-slate-900 mb-8 pb-4 border-b border-slate-200">Timeline Progress</h3>
        
        <div class="space-y-6">
            {{-- Milestone 1 --}}
            <div class="flex gap-6">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="w-1 h-16 bg-slate-200 mt-2"></div>
                </div>
                <div class="flex-1 pt-2">
                    <p class="text-lg font-bold text-slate-900">Onboarding & Perkenalan</p>
                    <p class="text-sm text-slate-600 mt-1">Minggu 1-2 | Selesai 15 Mei 2024</p>
                    <p class="text-sm text-slate-700 mt-3">Mengikuti orientation program dan memahami lingkungan kerja.</p>
                </div>
            </div>

            {{-- Milestone 2 --}}
            <div class="flex gap-6">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="w-1 h-16 bg-slate-200 mt-2"></div>
                </div>
                <div class="flex-1 pt-2">
                    <p class="text-lg font-bold text-slate-900">Project Development Phase 1</p>
                    <p class="text-sm text-slate-600 mt-1">Minggu 3-6 | Selesai 12 Juni 2024</p>
                    <p class="text-sm text-slate-700 mt-3">Memulai development dashboard dan setup infrastructure.</p>
                </div>
            </div>

            {{-- Milestone 3 --}}
            <div class="flex gap-6">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="w-1 h-16 bg-slate-200 mt-2"></div>
                </div>
                <div class="flex-1 pt-2">
                    <p class="text-lg font-bold text-slate-900">Project Development Phase 2</p>
                    <p class="text-sm text-slate-600 mt-1">Minggu 7-12 | Sedang berlangsung</p>
                    <p class="text-sm text-slate-700 mt-3">Testing, optimization, dan finalisasi project.</p>
                </div>
            </div>

            {{-- Milestone 4 --}}
            <div class="flex gap-6">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-slate-200 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 pt-2">
                    <p class="text-lg font-bold text-slate-500">Final Report & Presentation</p>
                    <p class="text-sm text-slate-500 mt-1">Minggu 13-16 | Akan datang</p>
                    <p class="text-sm text-slate-500 mt-3">Persiapan laporan akhir dan presentasi hasil MBKM.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer Text --}}
    <div class="text-center text-sm text-slate-500 mt-12 py-8 border-t border-slate-200">
        <p>© 2026 Sistem Manajemen MBKM • Program Studi Ilmu Komputer</p>
    </div>
@endsection
