@extends('layouts.admin')

@section('title', 'Data Mitra - Admin')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Data Mitra MBKM</h1>
                <p class="text-slate-600 mt-1">Kelola data mitra industri dan perusahaan MBKM</p>
            </div>
            <a href="{{ route('admin.mitra.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Mitra
            </a>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500 font-semibold">Total Mitra</p>
                    <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $mitras->total() }}</h3>
                </div>
                <div class="bg-blue-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500 font-semibold">Mahasiswa Aktif</p>
                    <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ \App\Models\PendaftaranMbkm::whereIn('status', ['berjalan', 'disetujui'])->count() }}</h3>
                </div>
                <div class="bg-green-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500 font-semibold">Kota</p>
                    <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ \App\Models\MitraMbkm::distinct('lokasi')->count('lokasi') }}</h3>
                </div>
                <div class="bg-amber-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Search --}}
    <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4 mb-6">
        <form action="{{ route('admin.mitra.index') }}" method="GET" class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama mitra, bidang usaha, atau lokasi..." class="flex-1 px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.mitra.index') }}" class="bg-slate-200 text-slate-700 px-6 py-2 rounded-lg hover:bg-slate-300">Reset</a>
            @endif
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-100 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">No</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Nama Mitra</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Lokasi</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Narahubung</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">No. Telepon</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($mitras as $index => $mitra)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $mitras->firstItem() + $index }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-blue-700 font-bold text-sm">{{ substr($mitra->nama_mitra, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">{{ $mitra->nama_mitra }}</p>
                                        <p class="text-xs text-slate-500">{{ $mitra->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $mitra->lokasi ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $mitra->narahubung ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $mitra->no_telp_narahubung ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.mitra.edit', $mitra->id) }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.mitra.destroy', $mitra->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mitra {{ $mitra->nama_mitra }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                <svg class="w-16 h-16 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                                <p class="font-medium">Tidak ada data mitra</p>
                                <p class="text-sm mt-1">Silakan tambah mitra baru</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($mitras->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $mitras->links() }}
            </div>
        @endif
    </div>
@endsection
