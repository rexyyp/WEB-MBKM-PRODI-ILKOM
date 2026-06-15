@extends('layouts.dosen-penguji')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="space-y-8 font-['Inter',sans-serif]">
    
    {{-- Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Mahasiswa Diuji</h1>
        </div>
        <p class="text-slate-500">Daftar seluruh mahasiswa yang dialokasikan kepada Anda untuk uji kompetensi.</p>
    </div>

    {{-- Filter & Search Bar --}}
    <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="relative w-full md:w-96">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" class="block w-full pl-10 pr-3 py-2 border border-slate-300 rounded-lg leading-5 bg-white placeholder-slate-500 focus:outline-none focus:placeholder-slate-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out" placeholder="Cari nama atau NIM mahasiswa...">
        </div>
        <div class="flex items-center gap-3 w-full md:w-auto">
            <select class="block w-full pl-3 pr-10 py-2 text-base border-slate-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg">
                <option>Semua Status</option>
                <option>Aktif</option>
                <option>Selesai</option>
            </select>
            <button class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-2 px-4 rounded-lg transition-colors border border-slate-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                Filter
            </button>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">NIM</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Mitra MBKM</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Status MBKM</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    
                    {{-- Baris 1 --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-6 text-slate-600 font-medium">201011400333</td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900">Ahmad Faisal</div>
                        </td>
                        <td class="py-4 px-6 text-slate-600">PT Telkom Indonesia (Persero) Tbk</td>
                        <td class="py-4 px-6">
                            <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                                <span class="flex items-center gap-1">
                                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                    Aktif
                                </span>
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <button class="text-blue-600 hover:text-blue-800 font-semibold transition-colors bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-xs">
                                Lihat Detail
                            </button>
                        </td>
                    </tr>

                    {{-- Baris 2 --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-6 text-slate-600 font-medium">201011400123</td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900">Budi Santoso</div>
                        </td>
                        <td class="py-4 px-6 text-slate-600">Bank Mandiri (Persero) Tbk</td>
                        <td class="py-4 px-6">
                            <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                                <span class="flex items-center gap-1">
                                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                    Aktif
                                </span>
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <button class="text-blue-600 hover:text-blue-800 font-semibold transition-colors bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-xs">
                                Lihat Detail
                            </button>
                        </td>
                    </tr>

                    {{-- Baris 3 --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-6 text-slate-600 font-medium">201011400555</td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900">Diana Putri</div>
                        </td>
                        <td class="py-4 px-6 text-slate-600">Gojek Indonesia</td>
                        <td class="py-4 px-6">
                            <span class="inline-block bg-slate-200 text-slate-700 text-xs font-semibold px-3 py-1 rounded-full">Selesai</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <button class="text-blue-600 hover:text-blue-800 font-semibold transition-colors bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-xs">
                                Lihat Detail
                            </button>
                        </td>
                    </tr>

                    {{-- Baris 4 --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-6 text-slate-600 font-medium">201011400666</td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900">Rizky Pratama</div>
                        </td>
                        <td class="py-4 px-6 text-slate-600">Tokopedia</td>
                        <td class="py-4 px-6">
                            <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                                <span class="flex items-center gap-1">
                                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                    Aktif
                                </span>
                            </span>
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
        
        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-slate-200 flex items-center justify-between bg-slate-50">
            <span class="text-sm text-slate-500 font-medium">Menampilkan 1 hingga 4 dari 15 mahasiswa</span>
            <div class="flex gap-2">
                <button class="px-4 py-2 border border-slate-300 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors disabled:opacity-50" disabled>Sebelumnya</button>
                <button class="px-4 py-2 bg-white border border-slate-300 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-colors shadow-sm">Selanjutnya</button>
            </div>
        </div>
    </div>
</div>
@endsection
