@extends('layouts.dosen-pembimbing')

@section('title', 'Mahasiswa Bimbingan - Dosen')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900 mb-2">Mahasiswa Bimbingan</h1>
        <p class="text-slate-600 text-lg">Daftar mahasiswa yang berada di bawah bimbingan Anda</p>
    </div>

    {{-- Main Content Card --}}
    <div class="bg-white rounded-xl shadow-md p-6">
        {{-- Filter and Search Section --}}
        <div class="mb-6 pb-6 border-b border-slate-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Search Box --}}
                <div class="relative">
                    <svg class="absolute left-3 top-3 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" placeholder="Cari nama atau NIM mahasiswa" class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                </div>

                {{-- Status MBKM Dropdown --}}
                <div>
                    <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 appearance-none cursor-pointer bg-white">
                        <option value="">Semua Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="selesai">Selesai</option>
                        <option value="bermasalah">Bermasalah</option>
                    </select>
                </div>

                {{-- Status Dokumen Dropdown --}}
                <div>
                    <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 appearance-none cursor-pointer bg-white">
                        <option value="">Semua Dokumen</option>
                        <option value="lengkap">Lengkap</option>
                        <option value="belum">Belum Lengkap</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4 px-4">NIM</th>
                        <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4 px-4">Mitra MBKM</th>
                        <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4 px-4">Status MBKM</th>
                        <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4 px-4">Aksi</th>
                        <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4 px-4">Status Dokumen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    {{-- Row 1: PT. Telkom Indonesia --}}
                    <tr class="hover:bg-slate-50 transition-colors duration-200">
                        <td class="py-4 px-4">
                            <span class="font-semibold text-slate-900">190204001</span>
                        </td>
                        <td class="py-4 px-4 text-slate-700">PT. Telkom Indonesia</td>
                        <td class="py-4 px-4">
                            <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                                <span class="flex items-center gap-1">
                                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                    Aktif
                                </span>
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <a href="#" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 font-medium text-sm rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                Detail
                            </a>
                        </td>
                        <td class="py-4 px-4">
                            <span class="inline-block bg-slate-100 text-slate-700 text-xs font-semibold px-3 py-1 rounded-full">Lengkap</span>
                        </td>
                    </tr>

                    {{-- Row 2: Gojek Indonesia --}}
                    <tr class="hover:bg-slate-50 transition-colors duration-200">
                        <td class="py-4 px-4">
                            <span class="font-semibold text-slate-900">190204015</span>
                        </td>
                        <td class="py-4 px-4 text-slate-700">Gojek Indonesia</td>
                        <td class="py-4 px-4">
                            <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                                <span class="flex items-center gap-1">
                                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                    Aktif
                                </span>
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <a href="#" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 font-medium text-sm rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                Detail
                            </a>
                        </td>
                        <td class="py-4 px-4">
                            <span class="inline-block bg-slate-100 text-slate-700 text-xs font-semibold px-3 py-1 rounded-full">Lengkap</span>
                        </td>
                    </tr>

                    {{-- Row 3: Bank Mandiri --}}
                    <tr class="hover:bg-slate-50 transition-colors duration-200">
                        <td class="py-4 px-4">
                            <span class="font-semibold text-slate-900">190204042</span>
                        </td>
                        <td class="py-4 px-4 text-slate-700">Bank Mandiri</td>
                        <td class="py-4 px-4">
                            <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                                <span class="flex items-center gap-1">
                                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                    Aktif
                                </span>
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <a href="#" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 font-medium text-sm rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                Detail
                            </a>
                        </td>
                        <td class="py-4 px-4">
                            <span class="inline-block bg-red-100 text-red-700 text-xs font-semibold px-3 py-1 rounded-full">Belum Lengkap</span>
                        </td>
                    </tr>

                    {{-- Row 4: Tokopedia --}}
                    <tr class="hover:bg-slate-50 transition-colors duration-200">
                        <td class="py-4 px-4">
                            <span class="font-semibold text-slate-900">190204088</span>
                        </td>
                        <td class="py-4 px-4 text-slate-700">Tokopedia</td>
                        <td class="py-4 px-4">
                            <span class="inline-block bg-slate-200 text-slate-700 text-xs font-semibold px-3 py-1 rounded-full">Selesai</span>
                        </td>
                        <td class="py-4 px-4">
                            <a href="#" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 font-medium text-sm rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                Detail
                            </a>
                        </td>
                        <td class="py-4 px-4">
                            <span class="inline-block bg-slate-100 text-slate-700 text-xs font-semibold px-3 py-1 rounded-full">Lengkap</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Footer Section --}}
        <div class="mt-6 pt-4 border-t border-slate-200 flex items-center justify-between text-sm">
            <p class="text-slate-600">Menampilkan <span class="font-semibold">4 mahasiswa</span> bimbingan</p>
            <p class="text-slate-500 text-xs">Scroll horizontal untuk melihat semua kolom</p>
        </div>
    </div>
@endsection
