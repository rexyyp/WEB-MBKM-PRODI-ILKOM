@extends('layouts.kaprodi')

@section('title', 'Daftar Mitra MBKM - Kaprodi Panel')

@section('content')
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-1">Daftar Mitra MBKM</h1>
        <p class="text-slate-500 text-lg">Pantau dan kelola data perusahaan mitra program MBKM.</p>
    </div>



    {{-- Main Content: Action Bar & Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        {{-- Action Bar --}}
        <div class="p-6 border-b border-slate-100 bg-white">
            {{-- Search --}}
            <div class="relative w-full sm:w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" class="block w-full pl-10 pr-3 py-2.5 border-none rounded-lg leading-5 bg-slate-100 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-sm font-medium" placeholder="Cari nama mitra atau industri...">
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Nama Mitra & Logo
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Lokasi
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Alamat
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider whitespace-nowrap">
                            Mahasiswa Magang
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
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-lg bg-green-100 flex items-center justify-center border border-green-200">
                                        <span class="text-green-700 font-bold text-lg">G</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-slate-900 leading-tight">PT. GoTo Gojek Tokopedia</div>
                                    <div class="text-sm font-medium text-slate-500">Kemitraan Strategis</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-semibold text-slate-700">Jakarta Selatan</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-medium text-slate-600">Gedung Pasaraya Blok M Gedung B Lt. 6</p>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-50 text-blue-700 font-bold text-sm border border-blue-100">
                                12
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-sm text-slate-500 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('kaprodi.mitra-mbkm.detail', 1) }}" class="text-slate-400 hover:text-blue-600 transition-colors p-1" title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>

                    {{-- Row 2 --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-lg bg-orange-100 flex items-center justify-center border border-orange-200">
                                        <span class="text-orange-700 font-bold text-lg">B</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-slate-900 leading-tight">Bank Mandiri (Persero) Tbk</div>
                                    <div class="text-sm font-medium text-slate-500">Kemitraan Reguler</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-semibold text-slate-700">Jakarta Pusat</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-medium text-slate-600">Plaza Mandiri, Jl. Jend. Gatot Subroto</p>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-50 text-blue-700 font-bold text-sm border border-blue-100">
                                8
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-sm text-slate-500 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('kaprodi.mitra-mbkm.detail', 2) }}" class="text-slate-400 hover:text-blue-600 transition-colors p-1" title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>

                    {{-- Row 3 --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-lg bg-red-100 flex items-center justify-center border border-red-200">
                                        <span class="text-red-700 font-bold text-lg">I</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-slate-900 leading-tight">PT. Inovasi Bangsa</div>
                                    <div class="text-sm font-medium text-slate-500">Proyek Mandiri</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-semibold text-slate-700">Bandung</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-medium text-slate-600">Jl. Pasteur No. 25, Pasteur, Sukajadi</p>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 text-slate-500 font-bold text-sm border border-slate-200">
                                0
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-sm text-slate-500 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('kaprodi.mitra-mbkm.detail', 3) }}" class="text-slate-400 hover:text-blue-600 transition-colors p-1" title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        {{-- Pagination Placeholder --}}
        <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between">
            <p class="text-sm text-slate-500 font-medium">Menampilkan <span class="font-bold text-slate-700">1</span> sampai <span class="font-bold text-slate-700">3</span> dari <span class="font-bold text-slate-700">58</span> hasil</p>
            <div class="flex items-center gap-2">
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-medium text-slate-400 bg-slate-50 cursor-not-allowed">Sebelah</button>
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-bold text-slate-700 hover:bg-slate-50 transition-colors">1</button>
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-bold text-slate-700 hover:bg-slate-50 transition-colors">2</button>
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-bold text-slate-700 hover:bg-slate-50 transition-colors">3</button>
                <span class="text-slate-400">...</span>
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-bold text-slate-700 hover:bg-slate-50 transition-colors">10</button>
                <button class="px-3 py-1 border border-slate-200 rounded-md text-sm font-bold text-slate-700 hover:bg-slate-50 transition-colors">Selanjutnya</button>
            </div>
        </div>
    </div>
@endsection
