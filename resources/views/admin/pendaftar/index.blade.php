@extends('layouts.admin')

@section('title', 'Konfirmasi Pendaftar - Admin MBKM')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Pendaftar Menunggu Konfirmasi</h1>
        <p class="text-slate-500 text-sm mt-1">Daftar mahasiswa yang mendaftar dan menunggu persetujuan Admin.</p>
    </div>
    <span class="inline-flex items-center gap-2 bg-amber-100 text-amber-800 font-bold text-sm px-4 py-2 rounded-full">
        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse inline-block"></span>
        {{ $pendaftar->total() }} Menunggu
    </span>
</div>

{{-- Flash Messages --}}
@if(session('success'))
    <div class="mb-5 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm flex items-center gap-3">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

@if(session('warning'))
    <div class="mb-5 p-4 rounded-xl bg-orange-50 border border-orange-200 text-orange-700 text-sm flex items-center gap-3">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('warning') }}
    </div>
@endif

{{-- Search Bar --}}
<div class="mb-4">
    <form method="GET" action="{{ route('admin.pendaftar.index') }}" class="flex gap-3">
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
            <a href="{{ route('admin.pendaftar.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-lg transition-colors">
                Reset
            </a>
        @endif
    </form>
</div>

{{-- Table Card --}}
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    @if($pendaftar->isEmpty())
        {{-- Empty State --}}
        <div class="py-20 flex flex-col items-center justify-center text-center">
            <div class="w-20 h-20 rounded-full bg-green-50 flex items-center justify-center mb-4">
                <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="font-semibold text-slate-700 text-lg">Semua Bersih!</p>
            <p class="text-slate-400 text-sm mt-1">Tidak ada pendaftar yang menunggu konfirmasi saat ini.</p>
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
                        <th class="px-6 py-3.5 text-left font-semibold text-slate-600 text-xs uppercase tracking-wide">Tanggal Daftar</th>
                        <th class="px-6 py-3.5 text-left font-semibold text-slate-600 text-xs uppercase tracking-wide">Status</th>
                        <th class="px-6 py-3.5 text-right font-semibold text-slate-600 text-xs uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($pendaftar as $index => $user)
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <td class="px-6 py-4 text-slate-400 font-mono">
                            {{ $pendaftar->firstItem() + $index }}
                        </td>
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
                        <td class="px-6 py-4">
                            <span class="font-mono text-slate-700">{{ $user->mahasiswa?->nim ?? '-' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-50 text-blue-700 font-semibold text-xs px-2.5 py-1 rounded-full">
                                {{ $user->mahasiswa?->angkatan ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-500">
                            {{ $user->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 text-xs font-semibold px-2.5 py-1 rounded-full border border-amber-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 inline-block"></span>
                                Menunggu
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                {{-- Tombol ACC --}}
                                <form method="POST" action="{{ route('admin.pendaftar.confirm', $user->id) }}"
                                      onsubmit="return confirm('Konfirmasi akun mahasiswa ini?\n\nNama: {{ $user->name }}\nNIM: {{ $user->mahasiswa?->nim }}')">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold px-3.5 py-2 rounded-lg transition-colors shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        ACC
                                    </button>
                                </form>

                                {{-- Tombol Tolak --}}
                                <form method="POST" action="{{ route('admin.pendaftar.reject', $user->id) }}"
                                      onsubmit="return confirm('⚠️ PERHATIAN!\n\nAnda akan menolak dan menghapus pendaftaran ini secara permanen.\n\nNama: {{ $user->name }}\nNIM: {{ $user->mahasiswa?->nim }}\n\nLanjutkan?')">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-1.5 bg-white hover:bg-red-50 text-red-600 border border-red-200 hover:border-red-400 text-xs font-semibold px-3.5 py-2 rounded-lg transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($pendaftar->hasPages())
        <div class="px-6 py-4 border-t border-slate-200 flex items-center justify-between">
            <p class="text-sm text-slate-500">
                Menampilkan {{ $pendaftar->firstItem() }}–{{ $pendaftar->lastItem() }} dari {{ $pendaftar->total() }} data
            </p>
            {{ $pendaftar->withQueryString()->links() }}
        </div>
        @endif
    @endif
</div>
@endsection
