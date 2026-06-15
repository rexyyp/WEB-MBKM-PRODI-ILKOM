@extends('layouts.mahasiswa')

@section('title', 'Logbook - Mahasiswa')

@section('content')
<div x-data="{ showReviewModal: false, activeReview: '' }">
    {{-- Header Section --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Logbook MBKM</h1>
            </div>
            <p class="text-slate-600 text-lg">Catatan kegiatan harian selama pelaksanaan MBKM</p>
        </div>
        <a href="{{ route('mahasiswa.logbook.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-full transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg shrink-0 w-fit">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 5v14m7-7H5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Tambah Logbook
        </a>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Total Entri Logbook --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-600 uppercase mb-2">Total Entri Logbook</p>
                    <p class="text-4xl font-bold text-slate-900">24</p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Jam Kerja --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-600 uppercase mb-2">Total Jam Kerja</p>
                    <p class="text-4xl font-bold text-slate-900">192 <span class="text-xl font-semibold">Jam</span></p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Jumlah Hari Aktif --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-600 uppercase mb-2">Jumlah Hari Aktif</p>
                    <p class="text-4xl font-bold text-slate-900">24 <span class="text-xl font-semibold">Hari</span></p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Logbook Timeline Section --}}
    <div class="space-y-4">
        {{-- WEEK 4 (EXPANDED) --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200">
            {{-- Section Header --}}
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200 flex items-center justify-between cursor-pointer hover:bg-slate-100 transition-colors duration-200" onclick="toggleWeek(this)">
                <div class="flex items-center gap-4 flex-1">
                    <svg class="w-6 h-6 text-slate-600 transition-transform duration-200" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 10l5 5 5-5z"/>
                    </svg>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Minggu ke-4 (23 - 29 Maret 2026)</h3>
                        <p class="text-sm text-slate-600 mt-1">Total: 40 Jam | 5 Aktivitas</p>
                    </div>
                </div>
                <div class="w-16 h-1 bg-slate-200 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-600 rounded-full" style="width: 85%"></div>
                </div>
            </div>

            {{-- Week Content --}}
            <div class="p-6 space-y-4">
                {{-- SENIN - Pending Review --}}
                <div class="bg-white border border-slate-200 rounded-xl p-5 hover:shadow-md transition-all duration-200 group">
                    <div class="flex items-start justify-between">
                        <div class="flex gap-4 flex-1">
                            <div class="text-center min-w-fit">
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">SENIN</p>
                                <p class="text-xl font-bold text-slate-900 mt-1">23 Mar</p>
                            </div>
                            <div class="flex-1 pt-1">
                                <h4 class="font-semibold text-slate-900 mb-2">Pengembangan Modul Auth</h4>
                                <p class="text-sm text-slate-600 mb-4">Implementasi JWT and middleware pada backend Node.js untuk menangani otentikasi user dan pengelolaan token akses.</p>
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="inline-flex items-center justify-center bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full border border-blue-100">8 Jam</span>
                                    <span class="inline-flex items-center justify-center bg-amber-50 text-amber-600 text-xs font-bold px-3 py-1.5 rounded-full border border-amber-200 gap-1.5 shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Pending Review
                                    </span>
                                </div>
                            </div>
                        </div>
                        {{-- Action Menu --}}
                        <div class="flex flex-col gap-2 ml-3 shrink-0">
                            <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-400 bg-slate-50 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200" title="Edit Logbook">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-400 bg-slate-50 hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200" title="Detail Logbook">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- SELASA - Sudah Direview --}}
                <div class="bg-white border border-slate-200 rounded-xl p-5 hover:shadow-md transition-all duration-200 group border-l-4 border-l-emerald-500">
                    <div class="flex items-start justify-between">
                        <div class="flex gap-4 flex-1">
                            <div class="text-center min-w-fit">
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">SELASA</p>
                                <p class="text-xl font-bold text-slate-900 mt-1">24 Mar</p>
                            </div>
                            <div class="flex-1 pt-1">
                                <h4 class="font-semibold text-slate-900 mb-2">Desain Skema Database User</h4>
                                <p class="text-sm text-slate-600 mb-4">Optimalisasi relasi antara tabel user, roles, dan profil mahasiswa pada PostgreSQL menggunakan Prisma ORM.</p>
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="inline-flex items-center justify-center bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full border border-blue-100">8 Jam</span>
                                    <span class="inline-flex items-center justify-center bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full border border-emerald-200 gap-1.5 shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Sudah Direview
                                    </span>
                                    <button @click="activeReview = 'Logbook hari ini sangat bagus. Penjelasan mengenai optimasi Prisma ORM terlihat jelas. Tolong pastikan index pada kolom tabel roles sudah diterapkan agar query lebih cepat.'; showReviewModal = true" class="inline-flex items-center justify-center bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold px-3 py-1.5 rounded-full border border-slate-300 transition-colors gap-1.5 cursor-pointer shadow-sm ml-1">
                                        <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                        Lihat Komentar
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- Action Menu --}}
                        <div class="flex flex-col gap-2 ml-3 shrink-0">
                            <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-400 bg-slate-50 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200" title="Edit Logbook">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-400 bg-slate-50 hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200" title="Detail Logbook">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- RABU - Perlu Revisi --}}
                <div class="bg-white border border-slate-200 rounded-xl p-5 hover:shadow-md transition-all duration-200 group border-l-4 border-l-red-500">
                    <div class="flex items-start justify-between">
                        <div class="flex gap-4 flex-1">
                            <div class="text-center min-w-fit">
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">RABU</p>
                                <p class="text-xl font-bold text-slate-900 mt-1">25 Mar</p>
                            </div>
                            <div class="flex-1 pt-1">
                                <h4 class="font-semibold text-slate-900 mb-2">Bug Fixing Login UI</h4>
                                <p class="text-sm text-slate-600 mb-4">Memperbaiki bug responsive pada halaman login di perangkat mobile dan integrasi error handling form.</p>
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="inline-flex items-center justify-center bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full border border-blue-100">6 Jam</span>
                                    <span class="inline-flex items-center justify-center bg-red-50 text-red-600 text-xs font-bold px-3 py-1.5 rounded-full border border-red-200 gap-1.5 shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        Perlu Revisi
                                    </span>
                                    <button @click="activeReview = 'Mohon tambahkan screenshot hasil perbaikan bug UI pada perangkat mobile agar lebih jelas. Selain itu, pastikan error handling sudah meng-cover validasi email.'; showReviewModal = true" class="inline-flex items-center justify-center bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold px-3 py-1.5 rounded-full border border-slate-300 transition-colors gap-1.5 cursor-pointer shadow-sm ml-1">
                                        <svg class="w-3.5 h-3.5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                        Lihat Komentar
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- Action Menu --}}
                        <div class="flex flex-col gap-2 ml-3 shrink-0">
                            <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-400 bg-slate-50 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200" title="Edit Logbook">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-400 bg-slate-50 hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200" title="Detail Logbook">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- KAMIS - Sudah Direview --}}
                <div class="bg-white border border-slate-200 rounded-xl p-5 hover:shadow-md transition-all duration-200 group border-l-4 border-l-emerald-500">
                    <div class="flex items-start justify-between">
                        <div class="flex gap-4 flex-1">
                            <div class="text-center min-w-fit">
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">KAMIS</p>
                                <p class="text-xl font-bold text-slate-900 mt-1">26 Mar</p>
                            </div>
                            <div class="flex-1 pt-1">
                                <h4 class="font-semibold text-slate-900 mb-2">Integrasi API REST</h4>
                                <p class="text-sm text-slate-600 mb-4">Mengintegrasikan endpoint API untuk autentikasi dan pengelolaan data pengguna dengan dokumentasi Swagger.</p>
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="inline-flex items-center justify-center bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full border border-blue-100">9 Jam</span>
                                    <span class="inline-flex items-center justify-center bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full border border-emerald-200 gap-1.5 shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Sudah Direview
                                    </span>
                                    <button @click="activeReview = 'Kerja yang hebat! Swagger sangat membantu dalam dokumentasi backend. Usahakan semua endpoint masa depan juga didokumentasikan di Swagger.'; showReviewModal = true" class="inline-flex items-center justify-center bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold px-3 py-1.5 rounded-full border border-slate-300 transition-colors gap-1.5 cursor-pointer shadow-sm ml-1">
                                        <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                        Lihat Komentar
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- Action Menu --}}
                        <div class="flex flex-col gap-2 ml-3 shrink-0">
                            <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-400 bg-slate-50 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200" title="Edit Logbook">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-400 bg-slate-50 hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200" title="Detail Logbook">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- JUMAT - Sudah Direview --}}
                <div class="bg-white border border-slate-200 rounded-xl p-5 hover:shadow-md transition-all duration-200 group border-l-4 border-l-emerald-500">
                    <div class="flex items-start justify-between">
                        <div class="flex gap-4 flex-1">
                            <div class="text-center min-w-fit">
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">JUMAT</p>
                                <p class="text-xl font-bold text-slate-900 mt-1">27 Mar</p>
                            </div>
                            <div class="flex-1 pt-1">
                                <h4 class="font-semibold text-slate-900 mb-2">Testing & Code Review</h4>
                                <p class="text-sm text-slate-600 mb-4">Unit testing untuk semua fungsi autentikasi dan melakukan code review bersama tim development.</p>
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="inline-flex items-center justify-center bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full border border-blue-100">9 Jam</span>
                                    <span class="inline-flex items-center justify-center bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full border border-emerald-200 gap-1.5 shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Sudah Direview
                                    </span>
                                    <button @click="activeReview = 'Good job! Coverage unit testnya memuaskan. Pertahankan rutinitas code review ini karena sangat membantu kualitas kode.'; showReviewModal = true" class="inline-flex items-center justify-center bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold px-3 py-1.5 rounded-full border border-slate-300 transition-colors gap-1.5 cursor-pointer shadow-sm ml-1">
                                        <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                        Lihat Komentar
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- Action Menu --}}
                        <div class="flex flex-col gap-2 ml-3 shrink-0">
                            <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-400 bg-slate-50 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200" title="Edit Logbook">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-400 bg-slate-50 hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200" title="Detail Logbook">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- WEEK 3 (COLLAPSED) --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200">
            {{-- Section Header --}}
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200 flex items-center justify-between cursor-pointer hover:bg-slate-100 transition-colors duration-200" onclick="toggleWeek(this)">
                <div class="flex items-center gap-4 flex-1">
                    <svg class="w-6 h-6 text-slate-600 transition-transform duration-200 rotate-180" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 10l5 5 5-5z"/>
                    </svg>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Minggu ke-3 (16 - 22 Maret 2026)</h3>
                        <p class="text-sm text-slate-600 mt-1">Total: 40 Jam | 5 Aktivitas</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center justify-center px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">
                        Selesai Direview
                    </span>
                </div>
            </div>

            {{-- Week Content (Hidden) --}}
            <div class="hidden p-6 space-y-4">
                <p class="text-slate-500 text-center py-4">Aktivitas minggu sebelumnya...</p>
            </div>
        </div>
    </div>

    {{-- Alpine Modal Detail Review Dosen --}}
    <div x-show="showReviewModal" 
         style="display: none;" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
         
        {{-- Backdrop --}}
        <div x-show="showReviewModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm"
             @click="showReviewModal = false"></div>

        {{-- Modal Box --}}
        <div x-show="showReviewModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden relative z-10 transform p-6 text-center">
            
            {{-- Simple Header Icon --}}
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-50 mb-4 text-blue-600 shadow-sm">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
            </div>
            
            <h3 class="text-xl font-extrabold text-slate-900 mb-4">Komentar Dosen</h3>
            
            {{-- Body Modal: Just the comment --}}
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 text-slate-700 text-sm leading-relaxed mb-6">
                <p x-text="activeReview"></p>
            </div>
            
            {{-- Footer Modal --}}
            <button type="button" @click="showReviewModal = false" class="w-full inline-flex justify-center items-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white hover:bg-blue-700 transition-colors focus:outline-none shadow-sm">
                Tutup Komentar
            </button>
        </div>
    </div>

    {{-- Footer --}}
    <div class="mt-16 pt-8 border-t border-slate-200 flex items-center justify-between text-sm text-slate-500">
        <p>© 2026 Lumni University Academic System</p>
        <div class="flex items-center gap-6">
            <a href="#" class="hover:text-slate-700 transition-colors duration-200">Kebijakan Privasi</a>
            <a href="#" class="hover:text-slate-700 transition-colors duration-200">Syarat & Ketentuan</a>
        </div>
    </div>
</div>

<script>
    function toggleWeek(element) {
        const section = element.closest('.rounded-xl');
        const content = section.querySelector('[class*="hidden"]') || section.querySelector('div:last-child');
        const arrow = section.querySelector('svg:first-child');

        // Toggle content visibility
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            arrow.classList.remove('rotate-180');
        } else {
            content.classList.add('hidden');
            arrow.classList.add('rotate-180');
        }
    }
</script>
@endsection
