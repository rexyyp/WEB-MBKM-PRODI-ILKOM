@extends('layouts.dosen-pembimbing')

@section('title', 'Dashboard Dosen - Manajemen MBKM')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Dashboard Dosen</h1>
        </div>
        <p class="text-slate-600 text-lg">Pantau dan kelola kegiatan MBKM mahasiswa bimbingan</p>
    </div>

    {{-- Alert Section --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Peringatan Alert (Yellow) --}}
        <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-6 flex items-start gap-4">
            <div class="flex-shrink-0 w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="font-semibold text-yellow-900 mb-1">Peringatan</h3>
                <p class="text-yellow-800 text-sm">5 mahasiswa belum mengisi logbook hari ini</p>
            </div>
        </div>

        {{-- Tindakan Diperlukan Alert (Red) --}}
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6">
            <h3 class="font-semibold text-red-900 mb-2">Tindakan Diperlukan</h3>
            <ul class="space-y-1 text-red-800 text-sm">
                <li class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                    3 mahasiswa dokumen belum lengkap
                </li>
                <li class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                    2 mahasiswa belum dinilai
                </li>
            </ul>
        </div>
    </div>

    {{-- Statistics Dashboard --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Jumlah Mahasiswa Bimbingan --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Jumlah Mahasiswa Bimbingan</p>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3.414a2 2 0 01-2-2V6.414a2 2 0 012-2h15.172a2 2 0 012 2v12.172a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-slate-900">24</p>
            <p class="text-xs text-slate-500 mt-2">Total mahasiswa</p>
        </div>

        {{-- Mahasiswa Aktif --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Mahasiswa Aktif</p>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-slate-900">20</p>
            <p class="text-xs text-slate-500 mt-2">Sedang aktif</p>
        </div>

        {{-- Logbook Belum Direview --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Logbook Belum Direview</p>
                <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-slate-900">12</p>
            <p class="text-xs text-slate-500 mt-2">Menunggu review</p>
        </div>

        {{-- Penilaian Belum Diisi --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Penilaian Belum Diisi</p>
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-slate-900">5</p>
            <p class="text-xs text-slate-500 mt-2">Belum dinilai</p>
        </div>
    </div>

    {{-- Main Content Area --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Daftar Mahasiswa (Main Section - 2 columns) --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-200">Daftar Mahasiswa Bimbingan</h2>

                {{-- Responsive Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Nama Mahasiswa</th>
                                <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Status MBKM</th>
                                <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Progress</th>
                                <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Dokumen</th>
                                <th class="text-center text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            {{-- Row 1: Andi Wijaya --}}
                            <tr class="hover:bg-slate-50 transition-colors duration-200">
                                <td class="py-4 text-slate-900 font-semibold">Andi Wijaya</td>
                                <td class="py-4">
                                    <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">Berjalan</span>
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-24 h-2 bg-slate-200 rounded-full overflow-hidden">
                                            <div class="h-full bg-blue-600 rounded-full" style="width: 45%"></div>
                                        </div>
                                        <span class="text-xs font-semibold text-slate-600">45%</span>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">Lengkap</span>
                                </td>
                                <td class="py-4 text-center">
                                    <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold text-sm transition-colors duration-200">Lihat Detail</a>
                                </td>
                            </tr>

                            {{-- Row 2: Siti Aminah --}}
                            <tr class="hover:bg-slate-50 transition-colors duration-200">
                                <td class="py-4 text-slate-900 font-semibold">Siti Aminah</td>
                                <td class="py-4">
                                    <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">Selesai</span>
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-24 h-2 bg-slate-200 rounded-full overflow-hidden">
                                            <div class="h-full bg-green-600 rounded-full" style="width: 100%"></div>
                                        </div>
                                        <span class="text-xs font-semibold text-slate-600">100%</span>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <span class="inline-block bg-red-100 text-red-700 text-xs font-semibold px-3 py-1 rounded-full">Belum Lengkap</span>
                                </td>
                                <td class="py-4 text-center">
                                    <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold text-sm transition-colors duration-200">Lihat Detail</a>
                                </td>
                            </tr>

                            {{-- Row 3: Budi Pratama --}}
                            <tr class="hover:bg-slate-50 transition-colors duration-200">
                                <td class="py-4 text-slate-900 font-semibold">Budi Pratama</td>
                                <td class="py-4">
                                    <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">Berjalan</span>
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-24 h-2 bg-slate-200 rounded-full overflow-hidden">
                                            <div class="h-full bg-blue-600 rounded-full" style="width: 20%"></div>
                                        </div>
                                        <span class="text-xs font-semibold text-slate-600">20%</span>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <span class="inline-block bg-red-100 text-red-700 text-xs font-semibold px-3 py-1 rounded-full">Belum Lengkap</span>
                                </td>
                                <td class="py-4 text-center">
                                    <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold text-sm transition-colors duration-200">Lihat Detail</a>
                                </td>
                            </tr>

                            {{-- Row 4: Clara Monica --}}
                            <tr class="hover:bg-slate-50 transition-colors duration-200">
                                <td class="py-4 text-slate-900 font-semibold">Clara Monica</td>
                                <td class="py-4">
                                    <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">Berjalan</span>
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-24 h-2 bg-slate-200 rounded-full overflow-hidden">
                                            <div class="h-full bg-blue-600 rounded-full" style="width: 60%"></div>
                                        </div>
                                        <span class="text-xs font-semibold text-slate-600">60%</span>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">Lengkap</span>
                                </td>
                                <td class="py-4 text-center">
                                    <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold text-sm transition-colors duration-200">Lihat Detail</a>
                                </td>
                            </tr>

                            {{-- Row 5: Dewi Kusuma --}}
                            <tr class="hover:bg-slate-50 transition-colors duration-200">
                                <td class="py-4 text-slate-900 font-semibold">Dewi Kusuma</td>
                                <td class="py-4">
                                    <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">Berjalan</span>
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-24 h-2 bg-slate-200 rounded-full overflow-hidden">
                                            <div class="h-full bg-blue-600 rounded-full" style="width: 75%"></div>
                                        </div>
                                        <span class="text-xs font-semibold text-slate-600">75%</span>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">Lengkap</span>
                                </td>
                                <td class="py-4 text-center">
                                    <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold text-sm transition-colors duration-200">Lihat Detail</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-6 flex items-center justify-between">
                    <p class="text-sm text-slate-600">Menampilkan <span class="font-semibold">1-5</span> dari <span class="font-semibold">24</span> mahasiswa</p>
                    <div class="flex items-center gap-2">
                        <button class="px-3 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors duration-200 text-sm">Sebelumnya</button>
                        <button class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm">1</button>
                        <button class="px-3 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors duration-200 text-sm">2</button>
                        <button class="px-3 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors duration-200 text-sm">Berikutnya</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Aktivitas Terbaru (Right Sidebar) --}}
        <div>
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                <h2 class="text-xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-200">Aktivitas Terbaru</h2>

                {{-- Activity Timeline --}}
                <div class="space-y-5">
                    {{-- Activity 1 --}}
                    <div class="pb-5 border-b border-slate-200 last:border-b-0">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-blue-600 rounded-full mt-2 flex-shrink-0"></div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-slate-900 text-sm truncate">Andi Wijaya</p>
                                <p class="text-xs text-slate-600 mb-2">Submit Logbook Minggu 4</p>
                                <p class="text-xs text-slate-500 mb-3">2 hari lalu</p>
                                <div class="flex items-center gap-2">
                                    <button class="text-xs bg-blue-100 text-blue-700 hover:bg-blue-200 px-2 py-1 rounded transition-colors duration-200">Review</button>
                                    <button class="text-xs bg-slate-100 text-slate-700 hover:bg-slate-200 px-2 py-1 rounded transition-colors duration-200">Lihat</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Activity 2 --}}
                    <div class="pb-5 border-b border-slate-200 last:border-b-0">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-green-600 rounded-full mt-2 flex-shrink-0"></div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-slate-900 text-sm truncate">Siti Aminah</p>
                                <p class="text-xs text-slate-600 mb-2">Upload Laporan Akhir</p>
                                <p class="text-xs text-slate-500 mb-3">Hari ini</p>
                                <div class="flex items-center gap-2">
                                    <button class="text-xs bg-blue-100 text-blue-700 hover:bg-blue-200 px-2 py-1 rounded transition-colors duration-200">Lihat</button>
                                    <button class="text-xs bg-slate-100 text-slate-700 hover:bg-slate-200 px-2 py-1 rounded transition-colors duration-200">Download</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Activity 3 --}}
                    <div class="pb-5 border-b border-slate-200 last:border-b-0">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-amber-600 rounded-full mt-2 flex-shrink-0"></div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-slate-900 text-sm truncate">Budi Pratama</p>
                                <p class="text-xs text-slate-600 mb-2">Meminta Jadwal Bimbingan Offline</p>
                                <p class="text-xs text-slate-500 mb-3">1 jam lalu</p>
                                <div class="flex items-center gap-2">
                                    <button class="text-xs bg-blue-100 text-blue-700 hover:bg-blue-200 px-2 py-1 rounded transition-colors duration-200">Tanggapi</button>
                                    <button class="text-xs bg-slate-100 text-slate-700 hover:bg-slate-200 px-2 py-1 rounded transition-colors duration-200">Jadwal</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Activity 4 --}}
                    <div class="pb-5">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-purple-600 rounded-full mt-2 flex-shrink-0"></div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-slate-900 text-sm truncate">Clara Monica</p>
                                <p class="text-xs text-slate-600 mb-2">Submit Logbook Minggu 3</p>
                                <p class="text-xs text-slate-500 mb-3">3 hari lalu</p>
                                <div class="flex items-center gap-2">
                                    <button class="text-xs bg-blue-100 text-blue-700 hover:bg-blue-200 px-2 py-1 rounded transition-colors duration-200">Review</button>
                                    <button class="text-xs bg-slate-100 text-slate-700 hover:bg-slate-200 px-2 py-1 rounded transition-colors duration-200">Lihat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- View All Button --}}
                <button class="w-full mt-6 py-2 border border-slate-300 text-slate-700 hover:bg-slate-50 font-semibold rounded-lg transition-colors duration-200 text-sm">
                    Lihat Semua Aktivitas
                </button>
            </div>
        </div>
    </div>
@endsection
