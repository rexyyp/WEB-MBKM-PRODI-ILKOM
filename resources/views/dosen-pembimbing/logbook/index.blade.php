@extends('layouts.dosen-pembimbing')

@section('title', 'Review Logbook - Dosen')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Review Logbook</h1>
        </div>
        <p class="text-slate-600 text-lg">Tinjau dan validasi logbook mahasiswa bimbingan Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left & Center Column: Logbook Activities --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Student Selector Card --}}
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-sm font-semibold text-slate-600 uppercase tracking-wider mb-4">Pilih Mahasiswa</h3>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        B
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-slate-900">Budi Santoso</p>
                        <p class="text-sm text-slate-600">NIM: 1902345 • Magang Industri</p>
                    </div>
                    <div class="relative">
                        <select id="studentSelect" class="px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none cursor-pointer bg-white hover:border-slate-400 transition-colors duration-200 pr-10">
                            <option>Budi Santoso</option>
                            <option>Andi Wijaya</option>
                            <option>Siti Aminah</option>
                            <option>Budi Pratama</option>
                            <option>Clara Monica</option>
                            <option>Dewi Kusuma</option>
                            <option>Reza Firmansyah</option>
                            <option>Farah Nathania</option>
                            <option>Hari Sutrisno</option>
                            <option>Mentari Putri</option>
                        </select>
                        <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-slate-600 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Weekly Summary Card --}}
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900">Minggu ke-4</h3>
                        <p class="text-slate-600 text-sm mt-1">22 – 28 Maret 2026</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="text-center">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm text-slate-600">5 Aktivitas</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm text-slate-600">38 Jam</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Activities List --}}
            <div class="space-y-3">
                {{-- Activity 1 (Pending Review - Selected) --}}
                <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-4 cursor-pointer transition-all duration-200 hover:shadow-md">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-slate-500 mb-1">Jumat, 26 Maret 2026</p>
                            <p class="font-semibold text-slate-900 text-sm mb-2">Implementasi API Endpoint untuk Modul Pembayaran</p>
                            <div class="flex items-center gap-3">
                                <span class="inline-block bg-slate-200 text-slate-700 text-xs font-semibold px-2 py-1 rounded">8 Jam Kerja</span>
                                <span class="inline-block bg-blue-200 text-blue-700 text-xs font-semibold px-2 py-1 rounded">Pending Review</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Activity 2 (Disetujui) --}}
                <div class="bg-white border border-slate-200 rounded-xl p-4 cursor-pointer transition-all duration-200 hover:shadow-md hover:border-slate-300">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-slate-500 mb-1">Kamis, 25 Maret 2026</p>
                            <p class="font-semibold text-slate-900 text-sm mb-2">Merancang Skema Database untuk Sistem Logistik</p>
                            <div class="flex items-center gap-3">
                                <span class="inline-block bg-slate-200 text-slate-700 text-xs font-semibold px-2 py-1 rounded">8 Jam Kerja</span>
                                <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">Disetujui</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Activity 3 (Disetujui) --}}
                <div class="bg-white border border-slate-200 rounded-xl p-4 cursor-pointer transition-all duration-200 hover:shadow-md hover:border-slate-300">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-slate-500 mb-1">Rabu, 24 Maret 2026</p>
                            <p class="font-semibold text-slate-900 text-sm mb-2">Meeting Koordinasi Tim & Sprint Planning</p>
                            <div class="flex items-center gap-3">
                                <span class="inline-block bg-slate-200 text-slate-700 text-xs font-semibold px-2 py-1 rounded">6 Jam Kerja</span>
                                <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">Disetujui</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Detail & Review Form --}}
        <div class="space-y-6">
            {{-- Detail Aktivitas Card --}}
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-6">Detail Aktivitas</h3>
                
                {{-- Activity Date --}}
                <div class="mb-6">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Tanggal</p>
                    <p class="text-slate-700">Jumat, 26 Maret 2026</p>
                </div>

                {{-- Kegiatan --}}
                <div class="mb-6">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Kegiatan</p>
                    <p class="text-slate-900 font-semibold">Implementasi API Endpoint untuk Modul Pembayaran</p>
                </div>

                {{-- Deskripsi Lengkap --}}
                <div class="mb-6">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Deskripsi Lengkap</p>
                    <p class="text-slate-700 text-sm leading-relaxed">Menindaklanjuti task dari sprint sebelumnya. Fokus pekerjaan hari ini adalah membuat endpoint RESTful untuk integrasi payment gateway. Melakukan pengujian endpoint menggunakan Postman dan memastikan webhook listener dapat menerima callback pembayaran dengan baik. Seluruh fitur diuji pada lingkungan staging sebelum deployment.</p>
                </div>

                {{-- Ringkasan Waktu --}}
                <div class="bg-slate-50 rounded-lg p-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4">Ringkasan Waktu</p>
                    <div class="grid grid-cols-3 gap-3 text-center">
                        <div>
                            <p class="text-xs text-slate-600 mb-1">Jam Mulai</p>
                            <p class="font-bold text-slate-900">09:00 WIB</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 mb-1">Jam Selesai</p>
                            <p class="font-bold text-slate-900">17:00 WIB</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 mb-1">Total</p>
                            <p class="font-bold text-slate-900">8 Jam</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Review Form Card --}}
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-6">Form Review</h3>

                {{-- Komentar Dosen --}}
                <div class="mb-6">
                    <label for="komentar" class="block text-sm font-semibold text-slate-700 mb-2">Komentar Dosen</label>
                    <textarea id="komentar" placeholder="Berikan masukan atau catatan untuk aktivitas ini..." rows="4" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none transition-all duration-200"></textarea>
                </div>

                {{-- Status Validasi --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-3">Status Validasi</label>
                    <div class="space-y-2">
                        <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-lg cursor-pointer hover:bg-blue-50 transition-colors duration-200">
                            <input type="radio" name="status" value="disetujui" checked class="w-4 h-4 text-blue-600 cursor-pointer">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-slate-900 font-medium">Disetujui</span>
                        </label>
                        <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-lg cursor-pointer hover:bg-blue-50 transition-colors duration-200">
                            <input type="radio" name="status" value="perlu-revisi" class="w-4 h-4 text-blue-600 cursor-pointer">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-slate-900 font-medium">Perlu Revisi</span>
                        </label>
                    </div>
                </div>

                {{-- Submit Button --}}
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Review
                </button>
            </div>
        </div>
    </div>
@endsection
