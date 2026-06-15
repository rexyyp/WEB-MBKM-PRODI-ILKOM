@extends('layouts.kaprodi')

@section('title', 'Detail Mitra MBKM - Kaprodi Panel')

@section('content')
    {{-- Breadcrumb & Back Button --}}
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('kaprodi.mitra-mbkm.index') }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-white border border-slate-200 text-slate-500 hover:text-blue-600 hover:border-blue-200 hover:bg-blue-50 transition-colors shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div class="flex items-center gap-3">
            <div class="bg-blue-100 p-2 rounded-xl text-blue-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Detail Mitra: PT. GoTo Gojek Tokopedia</h1>
        </div>
    </div>

    {{-- Panel Informasi Mitra (Atas) --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden mb-8">
        <div class="p-8">
            <div class="flex flex-col md:flex-row gap-8">
                {{-- Logo & Main Info --}}
                <div class="flex items-start gap-6 md:w-1/3 border-b md:border-b-0 md:border-r border-slate-100 pb-6 md:pb-0 md:pr-6">
                    <div class="flex-shrink-0">
                        <div class="w-24 h-24 rounded-2xl bg-green-100 flex items-center justify-center border border-green-200 shadow-sm">
                            <span class="text-green-700 font-extrabold text-4xl">G</span>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-2xl font-extrabold text-slate-900">PT. GoTo Gojek Tokopedia</h2>
                    </div>
                </div>

                {{-- Data Kontak & Lokasi --}}
                <div class="flex-1">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        Informasi Lokasi
                    </h3>
                    <ul class="space-y-5">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-slate-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <div>
                                <p class="text-xs font-semibold text-slate-500 mb-0.5">Lokasi Kegiatan</p>
                                <p class="text-sm font-medium text-slate-900">Jakarta Selatan</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-slate-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            <div>
                                <p class="text-xs font-semibold text-slate-500 mb-0.5">Alamat Lengkap Kantor/Lokasi</p>
                                <p class="text-sm font-medium text-slate-900 leading-relaxed">Gedung Pasaraya Blok M Gedung B Lt. 6, Jl. Iskandarsyah II No.2, Kebayoran Baru, Jakarta Selatan 12160</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content (Daftar Mahasiswa) --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        {{-- Table Header & Action Bar --}}
        <div class="px-6 py-5 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Daftar Mahasiswa Magang Saat Ini</h3>
            
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                {{-- Search --}}
                <div class="relative w-full sm:w-96">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" class="block w-full pl-10 pr-3 py-2.5 border-none rounded-lg leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-sm font-medium" placeholder="Cari mahasiswa...">
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            NIM & Nama Mahasiswa
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Angkatan
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Posisi Magang
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Dosen Pembimbing
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider text-right">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    {{-- Row 1 --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="text-sm font-medium text-slate-500 mb-1">200102030</div>
                            <div class="text-sm font-bold text-slate-900 leading-tight">Ahmad Fikri Mubarok</div>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-center">
                            <span class="text-sm font-semibold text-slate-700">2021</span>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-bold text-slate-800">Frontend Engineer Intern</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-semibold text-slate-700">Dr. M. Rizauddin</p>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-sm text-slate-500 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="#" class="text-slate-400 hover:text-blue-600 transition-colors p-1" title="Lihat Profil Mahasiswa">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>

                    {{-- Row 2 --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="text-sm font-medium text-slate-500 mb-1">200102045</div>
                            <div class="text-sm font-bold text-slate-900 leading-tight">Sarah Amalia</div>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-center">
                            <span class="text-sm font-semibold text-slate-700">2021</span>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-bold text-slate-800">UI/UX Designer Intern</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-semibold text-slate-700">Dr. Dedi H.</p>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-sm text-slate-500 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="#" class="text-slate-400 hover:text-blue-600 transition-colors p-1" title="Lihat Profil Mahasiswa">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        {{-- Pagination Placeholder --}}
        <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between bg-slate-50">
            <p class="text-sm text-slate-500 font-medium">Menampilkan <span class="font-bold text-slate-700">1</span> sampai <span class="font-bold text-slate-700">2</span> dari <span class="font-bold text-slate-700">12</span> hasil</p>
            <div class="flex items-center gap-2">
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-medium text-slate-400 bg-white cursor-not-allowed">Sebelah</button>
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-bold text-white bg-blue-600 shadow-sm">1</button>
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-bold text-slate-700 hover:bg-white bg-white transition-colors">2</button>
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-bold text-slate-700 hover:bg-white bg-white transition-colors">Selanjutnya</button>
            </div>
        </div>
    </div>
@endsection
