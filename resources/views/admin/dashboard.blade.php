@extends('layouts.admin')

@section('title', 'Dashboard - Admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-slate-900">Dashboard Admin</h1>
        <p class="text-slate-600">Selamat datang di panel admin MBKM System</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm">Total Mahasiswa</p>
                    <p class="text-2xl font-bold text-slate-900">245</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5M6.5 6.5a2 2 0 114 0 2 2 0 01-4 0zM2.5 15.5c0-2 2-3.5 4-3.5s4 1.5 4 3.5"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm">Total Mitra</p>
                    <p class="text-2xl font-bold text-slate-900">42</p>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm">Total Dosen</p>
                    <p class="text-2xl font-bold text-slate-900">18</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.5 1.5a1 1 0 00-1 1v1.5h-2V2.5a1 1 0 10-2 0v1.5H2a2 2 0 00-2 2v14a2 2 0 002 2h16a2 2 0 002-2v-14a2 2 0 00-2-2h-3.5V2.5a1 1 0 10-2 0v1.5h-2V2.5a1 1 0 00-1-1zM2 6h16v12H2V6z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm">Penempatan Aktif</p>
                    <p class="text-2xl font-bold text-slate-900">198</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 17v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.381z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-slate-900 mb-4">Aktivitas Terbaru</h2>
        <div class="space-y-4">
            <div class="flex items-center gap-4 pb-4 border-b border-slate-200">
                <div class="flex-1">
                    <p class="font-medium text-slate-900">Mahasiswa baru mendaftar</p>
                    <p class="text-sm text-slate-500">10 menit yang lalu</p>
                </div>
                <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Baru</span>
            </div>
            <div class="flex items-center gap-4 pb-4 border-b border-slate-200">
                <div class="flex-1">
                    <p class="font-medium text-slate-900">Dosen menginput penilaian</p>
                    <p class="text-sm text-slate-500">1 jam yang lalu</p>
                </div>
                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">Update</span>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <p class="font-medium text-slate-900">Laporan bulanan diunduh</p>
                    <p class="text-sm text-slate-500">2 jam yang lalu</p>
                </div>
                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">Download</span>
            </div>
        </div>
    </div>
@endsection
