@extends('layouts.dosen-pembimbing')

@section('title', 'Mahasiswa Bimbingan - Dosen')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Mahasiswa Bimbingan</h1>
        </div>
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
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50">
                        <th class="text-left text-xs font-bold text-slate-500 uppercase tracking-wider py-4 px-6">NIM</th>
                        <th class="text-left text-xs font-bold text-slate-500 uppercase tracking-wider py-4 px-6">Nama</th>
                        <th class="text-left text-xs font-bold text-slate-500 uppercase tracking-wider py-4 px-6">Mitra MBKM</th>
                        <th class="text-left text-xs font-bold text-slate-500 uppercase tracking-wider py-4 px-6">Status MBKM</th>
                        <th class="text-left text-xs font-bold text-slate-500 uppercase tracking-wider py-4 px-6">Status Dokumen</th>
                        <th class="text-center text-xs font-bold text-slate-500 uppercase tracking-wider py-4 px-6">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    {{-- Row 1 --}}
                    <tr class="hover:bg-slate-50 transition-colors duration-200">
                        <td class="py-4 px-6 text-slate-600 font-medium">190204001</td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900">Andi Setiawan</div>
                        </td>
                        <td class="py-4 px-6 text-slate-600">PT. Telkom Indonesia</td>
                        <td class="py-4 px-6">
                            <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                                <span class="flex items-center gap-1">
                                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                    Aktif
                                </span>
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-block bg-emerald-100 text-emerald-700 text-xs font-semibold px-3 py-1 rounded-full">Lengkap</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <button class="text-blue-600 hover:text-blue-800 font-semibold transition-colors bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-xs">
                                Lihat Detail
                            </button>
                        </td>
                    </tr>

                    {{-- Row 2 --}}
                    <tr class="hover:bg-slate-50 transition-colors duration-200">
                        <td class="py-4 px-6 text-slate-600 font-medium">190204015</td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900">Siti Aminah</div>
                        </td>
                        <td class="py-4 px-6 text-slate-600">Gojek Indonesia</td>
                        <td class="py-4 px-6">
                            <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                                <span class="flex items-center gap-1">
                                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                    Aktif
                                </span>
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-block bg-emerald-100 text-emerald-700 text-xs font-semibold px-3 py-1 rounded-full">Lengkap</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <button class="text-blue-600 hover:text-blue-800 font-semibold transition-colors bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-xs">
                                Lihat Detail
                            </button>
                        </td>
                    </tr>

                    {{-- Row 3 --}}
                    <tr class="hover:bg-slate-50 transition-colors duration-200">
                        <td class="py-4 px-6 text-slate-600 font-medium">190204042</td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900">Budi Pratama</div>
                        </td>
                        <td class="py-4 px-6 text-slate-600">Bank Mandiri</td>
                        <td class="py-4 px-6">
                            <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                                <span class="flex items-center gap-1">
                                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                    Aktif
                                </span>
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-block bg-rose-100 text-rose-700 text-xs font-semibold px-3 py-1 rounded-full">Belum Lengkap</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <button class="text-blue-600 hover:text-blue-800 font-semibold transition-colors bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-xs">
                                Lihat Detail
                            </button>
                        </td>
                    </tr>

                    {{-- Row 4 --}}
                    <tr class="hover:bg-slate-50 transition-colors duration-200">
                        <td class="py-4 px-6 text-slate-600 font-medium">190204088</td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900">Diana Monica</div>
                        </td>
                        <td class="py-4 px-6 text-slate-600">Tokopedia</td>
                        <td class="py-4 px-6">
                            <span class="inline-block bg-slate-200 text-slate-700 text-xs font-semibold px-3 py-1 rounded-full">Selesai</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-block bg-emerald-100 text-emerald-700 text-xs font-semibold px-3 py-1 rounded-full">Lengkap</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <button class="text-blue-600 hover:text-blue-800 font-semibold transition-colors bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-xs">
                                Lihat Detail
                            </button>
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
