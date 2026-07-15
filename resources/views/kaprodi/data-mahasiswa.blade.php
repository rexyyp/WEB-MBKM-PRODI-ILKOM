@extends('layouts.kaprodi')

@section('title', 'Data Mahasiswa - Kaprodi MBKM System')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Data Mahasiswa</h1>
        </div>
        <p class="text-slate-600 text-lg">Kelola dan pantau data mahasiswa yang mengikuti program MBKM</p>
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
                <h3 class="text-3xl font-extrabold text-slate-900">{{ number_format($totalMahasiswa) }}</h3>
            </div>
        </div>

        {{-- Sedang Berjalan --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 flex items-center gap-6 hover:shadow-md transition-shadow">
            <div class="w-14 h-14 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-500 mb-1">Sedang Berjalan</p>
                <h3 class="text-3xl font-extrabold text-slate-900">{{ number_format($sedangBerjalan) }}</h3>
            </div>
        </div>

        {{-- Selesai --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 flex items-center gap-6 hover:shadow-md transition-shadow">
            <div class="w-14 h-14 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center flex-shrink-0 border border-slate-200">
                <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-500 mb-1">Selesai</p>
                <h3 class="text-3xl font-extrabold text-slate-900">{{ number_format($selesai) }}</h3>
            </div>
        </div>
    </div>

    {{-- Main Content: Filter and Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        {{-- Action Bar --}}
        <form action="{{ route('kaprodi.data-mahasiswa.index') }}" method="GET" class="p-6 border-b border-slate-100 flex flex-wrap items-center gap-4 bg-white">
            {{-- Search --}}
            <div class="relative w-full sm:w-80 md:w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2.5 border-none rounded-lg leading-5 bg-slate-100 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-sm font-medium" placeholder="Cari nama atau NIM...">
            </div>

            {{-- Filter --}}
            <div class="relative w-full sm:w-48 md:w-56">
                <select name="status" onchange="this.form.submit()" class="block w-full pl-4 pr-10 py-2.5 border-none rounded-lg leading-5 bg-slate-100 text-slate-700 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-sm appearance-none">
                    <option value="">Semua Status MBKM</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu Validasi</option>
                    <option value="berjalan" {{ request('status') == 'berjalan' ? 'selected' : '' }}>Sedang Berjalan</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
            
            <button type="submit" class="hidden">Search</button>
        </form>

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
                    @forelse ($pendaftarans as $p)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-8 py-6 whitespace-nowrap">
                                <p class="text-sm font-medium text-slate-600 uppercase tracking-wider">{{ $p->mahasiswa->nim ?? '-' }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-bold text-slate-900 leading-tight">{{ $p->mahasiswa->user->name ?? '-' }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-semibold text-slate-700">{{ $p->dosenPembimbing->user->name ?? '-' }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-bold text-slate-800">{{ $p->mitraMbkm->nama ?? '-' }}</p>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-16 bg-slate-200 rounded-full h-1.5">
                                        <div class="{{ $p->progress == 100 ? 'bg-green-500' : 'bg-blue-600' }} h-1.5 rounded-full" style="width: {{ $p->progress ?? 0 }}%"></div>
                                    </div>
                                    <span class="text-sm font-extrabold {{ $p->progress == 100 ? 'text-green-600' : 'text-blue-700' }}">{{ $p->progress ?? 0 }}%</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                @if ($p->status === 'menunggu')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                        Menunggu Validasi
                                    </span>
                                @elseif ($p->status === 'berjalan')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200">
                                        Berjalan
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-500 text-white shadow-sm border border-green-600">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap text-sm text-slate-500 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <button class="text-slate-400 hover:text-blue-600 transition-colors p-1" title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-8 py-8 text-center text-slate-400 font-medium">
                                Tidak ada data mahasiswa yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $pendaftarans->links() }}
        </div>
    </div>
@endsection
