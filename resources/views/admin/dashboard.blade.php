@extends('layouts.admin')

@section('title', 'Dashboard - Admin MBKM')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Dashboard Admin</h1>
    <p class="text-slate-500 text-sm mt-1">Selamat datang, <span class="font-semibold text-blue-600">{{ auth()->user()->name }}</span>. Berikut ringkasan sistem MBKM.</p>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
    {{-- Total Mahasiswa Aktif --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-0.5 rounded-full">Aktif</span>
        </div>
        <p class="text-3xl font-bold text-slate-900 mb-1">{{ $stats['total_mahasiswa'] }}</p>
        <p class="text-sm text-slate-500">Total Mahasiswa Aktif</p>
    </div>

    {{-- Pending Konfirmasi --}}
    <a href="{{ route('admin.pendaftar.index') }}"
       class="bg-white rounded-xl border border-amber-200 shadow-sm p-6 hover:shadow-md hover:border-amber-400 transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            @if($stats['pending'] > 0)
                <span class="text-xs font-bold text-amber-700 bg-amber-100 px-2 py-0.5 rounded-full animate-pulse">
                    Perlu Aksi!
                </span>
            @endif
        </div>
        <p class="text-3xl font-bold text-slate-900 mb-1">{{ $stats['pending'] }}</p>
        <p class="text-sm text-slate-500 group-hover:text-amber-600 transition-colors">Menunggu Konfirmasi</p>
    </a>

    {{-- Total Dosen --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 rounded-xl bg-purple-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-900 mb-1">{{ $stats['total_dosen'] }}</p>
        <p class="text-sm text-slate-500">Total Dosen</p>
    </div>

    {{-- Total Mitra --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 rounded-xl bg-green-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-900 mb-1">{{ $stats['total_mitra'] }}</p>
        <p class="text-sm text-slate-500">Total Mitra MBKM</p>
    </div>
</div>

{{-- Pendaftar Terbaru --}}
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-slate-900">Pendaftar Terbaru</h2>
            <p class="text-xs text-slate-500 mt-0.5">Mahasiswa yang baru mendaftar dan menunggu konfirmasi</p>
        </div>
        <a href="{{ route('admin.pendaftar.index') }}"
           class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors flex items-center gap-1">
            Lihat Semua
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    @if($pendaftar_terbaru->isEmpty())
        <div class="py-12 flex flex-col items-center justify-center text-center">
            <div class="w-16 h-16 rounded-full bg-green-50 flex items-center justify-center mb-3">
                <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="font-medium text-slate-600">Tidak ada pendaftar yang menunggu konfirmasi</p>
        </div>
    @else
        <div class="divide-y divide-slate-100">
            @foreach($pendaftar_terbaru as $user)
            <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-slate-900 text-sm">{{ $user->name }}</p>
                        <p class="text-xs text-slate-400">{{ $user->mahasiswa?->nim ?? 'NIM belum ada' }} · {{ $user->email }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-xs text-slate-400">{{ $user->created_at->diffForHumans() }}</span>
                    <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-700 text-xs font-semibold px-2 py-0.5 rounded-full border border-amber-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 inline-block"></span>
                        Pending
                    </span>
                </div>
            </div>
            @endforeach
        </div>

        @if($stats['pending'] > 5)
        <div class="px-6 py-3 bg-amber-50 border-t border-amber-200 text-center">
            <a href="{{ route('admin.pendaftar.index') }}" class="text-sm font-semibold text-amber-700 hover:text-amber-900 transition-colors">
                + {{ $stats['pending'] - 5 }} pendaftar lainnya menunggu konfirmasi →
            </a>
        </div>
        @endif
    @endif
</div>
@endsection
