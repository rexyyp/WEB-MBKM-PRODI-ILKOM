@extends('layouts.admin')

@section('title', 'Data Mahasiswa - Admin MBKM')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Data Mahasiswa Aktif</h1>
        <p class="text-slate-500 text-sm mt-1">Daftar mahasiswa yang akunnya telah dikonfirmasi dan aktif.</p>
    </div>
    <span class="inline-flex items-center gap-2 bg-green-100 text-green-800 font-bold text-sm px-4 py-2 rounded-full">
        <span class="w-2 h-2 rounded-full bg-green-500 inline-block"></span>
        {{ $mahasiswas->total() }} Mahasiswa Aktif
    </span>
</div>

{{-- Search Bar --}}
<div class="mb-4">
    <form method="GET" action="{{ route('admin.mahasiswa.index') }}" class="flex gap-3">
        <div class="relative flex-1 max-w-md">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari nama, NIM, atau email..."
                class="w-full pl-10 pr-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
        </div>
        <button type="submit" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors">
            Cari
        </button>
        @if(request('search'))
            <a href="{{ route('admin.mahasiswa.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-lg transition-colors">
                Reset
            </a>
        @endif
    </form>
</div>

{{-- Table Card --}}
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    @if($mahasiswas->isEmpty())
        <div class="py-20 flex flex-col items-center justify-center text-center">
            <div class="w-20 h-20 rounded-full bg-slate-50 flex items-center justify-center mb-4">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                </svg>
            </div>
            <p class="font-semibold text-slate-700 text-lg">Belum Ada Mahasiswa</p>
            <p class="text-slate-400 text-sm mt-1">Belum ada mahasiswa yang akunnya aktif.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-3.5 text-left font-semibold text-slate-600 text-xs uppercase tracking-wide">#</th>
                        <th class="px-6 py-3.5 text-left font-semibold text-slate-600 text-xs uppercase tracking-wide">Mahasiswa</th>
                        <th class="px-6 py-3.5 text-left font-semibold text-slate-600 text-xs uppercase tracking-wide">NIM</th>
                        <th class="px-6 py-3.5 text-left font-semibold text-slate-600 text-xs uppercase tracking-wide">Angkatan</th>
                        <th class="px-6 py-3.5 text-left font-semibold text-slate-600 text-xs uppercase tracking-wide">Prodi</th>
                        <th class="px-6 py-3.5 text-left font-semibold text-slate-600 text-xs uppercase tracking-wide">Terdaftar</th>
                        <th class="px-6 py-3.5 text-left font-semibold text-slate-600 text-xs uppercase tracking-wide">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($mahasiswas as $index => $user)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 text-slate-400 font-mono">{{ $mahasiswas->firstItem() + $index }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-mono text-slate-700">{{ $user->mahasiswa?->nim ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-50 text-blue-700 font-semibold text-xs px-2.5 py-1 rounded-full">
                                {{ $user->mahasiswa?->angkatan ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $user->mahasiswa?->prodi ?? '-' }}</td>
                        <td class="px-6 py-4 text-slate-500 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full border border-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 inline-block"></span>
                                Aktif
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($mahasiswas->hasPages())
        <div class="px-6 py-4 border-t border-slate-200 flex items-center justify-between">
            <p class="text-sm text-slate-500">
                Menampilkan {{ $mahasiswas->firstItem() }}–{{ $mahasiswas->lastItem() }} dari {{ $mahasiswas->total() }} data
            </p>
            {{ $mahasiswas->withQueryString()->links() }}
        </div>
        @endif
    @endif
</div>
@endsection
