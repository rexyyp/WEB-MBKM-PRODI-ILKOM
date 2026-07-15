@extends('layouts.kaprodi')

@section('title', 'Daftar Mitra MBKM - Kaprodi Panel')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Daftar Mitra MBKM</h1>
        </div>
        <p class="text-slate-600 text-lg">Pantau dan kelola data perusahaan mitra program MBKM</p>
    </div>



    {{-- Main Content: Action Bar & Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        {{-- Action Bar --}}
        <div class="p-6 border-b border-slate-100 bg-white">
            {{-- Search --}}
            <form action="{{ route('kaprodi.mitra-mbkm.index') }}" method="GET" class="relative w-full sm:w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2.5 border-none rounded-lg leading-5 bg-slate-100 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-sm font-medium" placeholder="Cari nama mitra atau industri...">
            </form>
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
                    @forelse ($mitras as $mitra)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center border border-blue-200">
                                        <span class="text-blue-700 font-bold text-lg">{{ strtoupper(substr($mitra->nama_mitra, 0, 1)) }}</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-slate-900 leading-tight">{{ $mitra->nama_mitra }}</div>
                                    <div class="text-sm font-medium text-slate-500">Kemitraan MBKM</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-semibold text-slate-700">{{ $mitra->lokasi ?? '-' }}</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-medium text-slate-600 truncate max-w-[200px]" title="{{ $mitra->alamat }}">{{ $mitra->alamat ?? '-' }}</p>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full {{ $mitra->pendaftaran_mbkm_count > 0 ? 'bg-blue-50 text-blue-700 border-blue-100' : 'bg-slate-100 text-slate-500 border-slate-200' }} font-bold text-sm border">
                                {{ $mitra->pendaftaran_mbkm_count }}
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-sm text-slate-500 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('kaprodi.mitra-mbkm.detail', $mitra->id) }}" class="text-slate-400 hover:text-blue-600 transition-colors p-1" title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-8 text-center text-slate-400 font-medium">
                            Tidak ada data mitra yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
            {{ $mitras->links() }}
        </div>
    </div>
@endsection
