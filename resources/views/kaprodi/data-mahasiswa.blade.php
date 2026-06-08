@extends('layouts.kaprodi')

@section('title', 'Data Mahasiswa - Kaprodi MBKM System')

@section('content')
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-1">Data Mahasiswa</h1>
        <p class="text-slate-500 text-lg">Pantau dan kelola data mahasiswa peserta MBKM</p>
    </div>

    {{-- Top Cards (3 Cards) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Total Mahasiswa --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 flex items-center gap-6 hover:shadow-md transition-shadow">
            <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-500 mb-1">Total Mahasiswa</p>
                <h3 class="text-3xl font-extrabold text-slate-900">342</h3>
            </div>
        </div>

        {{-- Sedang Berjalan --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 flex items-center gap-6 hover:shadow-md transition-shadow">
            <div class="w-14 h-14 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-500 mb-1">Sedang Berjalan</p>
                <h3 class="text-3xl font-extrabold text-slate-900">215</h3>
            </div>
        </div>

        {{-- Selesai --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 flex items-center gap-6 hover:shadow-md transition-shadow">
            <div class="w-14 h-14 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center flex-shrink-0 border border-slate-200">
                <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-500 mb-1">Selesai</p>
                <h3 class="text-3xl font-extrabold text-slate-900">127</h3>
            </div>
        </div>
    </div>

    {{-- Main Content: Filter and Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        {{-- Action Bar --}}
        <div class="p-6 border-b border-slate-100 flex items-center gap-4 bg-white">
            {{-- Search --}}
            <div class="relative w-80 sm:w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" class="block w-full pl-10 pr-3 py-2.5 border-none rounded-lg leading-5 bg-slate-100 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-sm font-medium" placeholder="Cari nama atau NIM...">
            </div>

            {{-- Filter --}}
            <div class="relative w-48 sm:w-56">
                <select class="block w-full pl-4 pr-10 py-2.5 border-none rounded-lg leading-5 bg-slate-100 text-slate-700 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-sm appearance-none">
                    <option>Status MBKM</option>
                    <option>Menunggu Validasi</option>
                    <option>Sedang Berjalan</option>
                    <option>Selesai</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            NIM
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Nama Mahasiswa
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Dosen Pembimbing
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Mitra MBKM
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap">
                            Progress MBKM
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap">
                            Status Validasi
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider text-right">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    {{-- Row 1 --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6 whitespace-nowrap">
                            <p class="text-sm font-medium text-slate-600 uppercase tracking-wider">200102030</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-bold text-slate-900 leading-tight">Ahmad Fikri Mubarok</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-semibold text-slate-700">Dr. M. Rizauddin</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-bold text-slate-800">PT. Teknologi Cerdas</p>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-16 bg-slate-200 rounded-full h-1.5">
                                    <div class="bg-blue-600 h-1.5 rounded-full" style="width: 75%"></div>
                                </div>
                                <span class="text-sm font-extrabold text-blue-700">75%</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                Tervalidasi / Berjalan
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-sm text-slate-500 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <button class="text-slate-400 hover:text-blue-600 transition-colors p-1" title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                <button class="text-slate-400 hover:text-green-600 transition-colors p-1" title="Validasi Dokumen">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Row 2 --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6 whitespace-nowrap">
                            <p class="text-sm font-medium text-slate-600 uppercase tracking-wider">200102031</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-bold text-slate-900 leading-tight">Budi Santoso</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-semibold text-slate-700">Prof. Wawan S.</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-bold text-slate-800">Kementerian Kominfo</p>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-16 bg-slate-200 rounded-full h-1.5">
                                    <div class="bg-blue-600 h-1.5 rounded-full" style="width: 25%"></div>
                                </div>
                                <span class="text-sm font-extrabold text-blue-700">25%</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                Menunggu Validasi
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-sm text-slate-500 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <button class="text-slate-400 hover:text-blue-600 transition-colors p-1" title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                <button class="text-slate-400 hover:text-green-600 transition-colors p-1" title="Validasi Dokumen">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Row 3 --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6 whitespace-nowrap">
                            <p class="text-sm font-medium text-slate-600 uppercase tracking-wider">200102032</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-bold text-slate-900 leading-tight">Citra Dewi Lestari</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-semibold text-slate-700">Dr. Dedi H.</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-bold text-slate-800">Bank Mandiri (Persero)</p>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-16 bg-slate-200 rounded-full h-1.5">
                                    <div class="bg-green-500 h-1.5 rounded-full" style="width: 100%"></div>
                                </div>
                                <span class="text-sm font-extrabold text-green-600">100%</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-500 text-white shadow-sm border border-green-600">
                                Selesai
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-sm text-slate-500 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <button class="text-slate-400 hover:text-blue-600 transition-colors p-1" title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                <button class="text-slate-400 hover:text-green-600 transition-colors p-1" title="Validasi Dokumen">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        {{-- Pagination Placeholder --}}
        <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between">
            <p class="text-sm text-slate-500 font-medium">Menampilkan <span class="font-bold text-slate-700">1</span> sampai <span class="font-bold text-slate-700">3</span> dari <span class="font-bold text-slate-700">342</span> hasil</p>
            <div class="flex items-center gap-2">
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-medium text-slate-400 bg-slate-50 cursor-not-allowed">Sebelah</button>
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-bold text-slate-700 hover:bg-slate-50 transition-colors">1</button>
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-bold text-slate-700 hover:bg-slate-50 transition-colors">2</button>
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-bold text-slate-700 hover:bg-slate-50 transition-colors">Selanjutnya</button>
            </div>
        </div>
    </div>
@endsection
