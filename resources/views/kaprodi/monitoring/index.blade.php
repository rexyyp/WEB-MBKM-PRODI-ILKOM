@extends('layouts.kaprodi')

@section('title', 'Monitoring Bimbingan')

@section('content')
<div class="max-w-7xl mx-auto py-6">
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Monitoring Bimbingan Mahasiswa</h1>
        </div>
        <p class="text-slate-600 text-lg">Helicopter view untuk memantau progres bimbingan seluruh mahasiswa aktif MBKM</p>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Card 1 --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Mahasiswa Aktif</p>
                <p class="text-3xl font-bold text-slate-900">124</p>
            </div>
            <div class="p-3 bg-blue-50 rounded-full text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
        </div>
        {{-- Card 2 --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Rata-rata Bimbingan</p>
                <p class="text-3xl font-bold text-slate-900">3.5 <span class="text-lg font-medium text-slate-500">kali/mhs</span></p>
            </div>
            <div class="p-3 bg-green-50 rounded-full text-green-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            </div>
        </div>
        {{-- Card 3 --}}
        <div class="bg-white rounded-xl shadow-sm border border-red-200 p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-red-500 uppercase tracking-wider mb-1">Perlu Perhatian</p>
                <p class="text-3xl font-bold text-red-700">18 <span class="text-lg font-medium text-red-500">mhs</span></p>
            </div>
            <div class="p-3 bg-red-50 rounded-full text-red-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
        </div>
    </div>

    {{-- Filters & Search --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Cari nama atau NIM mahasiswa...">
            </div>
            <div class="w-full md:w-56">
                <select class="w-full py-2.5 px-4 bg-slate-50 border-slate-200 rounded-lg text-sm text-slate-700 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Dosen Pembimbing</option>
                    <option value="1">Bpk. Hendra Saputra</option>
                    <option value="2">Ibu Rini Susanti</option>
                    <option value="3">Bpk. Budi Santoso</option>
                </select>
            </div>
            <div class="w-full md:w-48">
                <select class="w-full py-2.5 px-4 bg-slate-50 border-slate-200 rounded-lg text-sm text-slate-700 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif Bimbingan</option>
                    <option value="kurang">Kurang Aktif</option>
                    <option value="mandek">Mandek / 0 Bimbingan</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Makro Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Mahasiswa & NIM</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Mitra & Pembimbing</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Total Bimbingan</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Update Terakhir</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    {{-- Row 1: Good --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-6">
                            <a href="#" class="font-bold text-blue-600 hover:underline">Ahmad Faisal</a>
                            <p class="text-xs text-slate-500 mt-0.5">190204001</p>
                        </td>
                        <td class="py-4 px-6">
                            <p class="font-semibold text-slate-800">PT Telkom Indonesia</p>
                            <p class="text-xs text-slate-500 mt-0.5">Bpk. Hendra Saputra</p>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                4 Kali
                            </span>
                        </td>
                        <td class="py-4 px-6 text-slate-600">
                            12 Mei 2026
                        </td>
                        <td class="py-4 px-6 text-right">
                            <button class="inline-flex items-center justify-center px-3 py-1.5 border border-blue-200 text-blue-600 rounded-lg hover:bg-blue-50 font-medium transition-colors text-xs">
                                Lihat Detail
                            </button>
                        </td>
                    </tr>

                    {{-- Row 2: Warning --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-6">
                            <a href="#" class="font-bold text-blue-600 hover:underline">Siti Aminah</a>
                            <p class="text-xs text-slate-500 mt-0.5">190204045</p>
                        </td>
                        <td class="py-4 px-6">
                            <p class="font-semibold text-slate-800">Bank Mandiri</p>
                            <p class="text-xs text-slate-500 mt-0.5">Ibu Rini Susanti</p>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                2 Kali
                            </span>
                        </td>
                        <td class="py-4 px-6 text-slate-600">
                            28 Apr 2026
                        </td>
                        <td class="py-4 px-6 text-right">
                            <button class="inline-flex items-center justify-center px-3 py-1.5 border border-blue-200 text-blue-600 rounded-lg hover:bg-blue-50 font-medium transition-colors text-xs">
                                Lihat Detail
                            </button>
                        </td>
                    </tr>

                    {{-- Row 3: Danger --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-6">
                            <a href="#" class="font-bold text-blue-600 hover:underline">Budi Hermawan</a>
                            <p class="text-xs text-slate-500 mt-0.5">190204077</p>
                        </td>
                        <td class="py-4 px-6">
                            <p class="font-semibold text-slate-800">Gojek Indonesia</p>
                            <p class="text-xs text-slate-500 mt-0.5">Bpk. Budi Santoso</p>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                0 Kali
                            </span>
                        </td>
                        <td class="py-4 px-6 text-slate-400 italic">
                            Belum Pernah
                        </td>
                        <td class="py-4 px-6 text-right">
                            <button class="inline-flex items-center justify-center px-3 py-1.5 border border-blue-200 text-blue-600 rounded-lg hover:bg-blue-50 font-medium transition-colors text-xs">
                                Lihat Detail
                            </button>
                        </td>
                    </tr>

                    {{-- Row 4: Danger (1 time) --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-6">
                            <a href="#" class="font-bold text-blue-600 hover:underline">Rina Wati</a>
                            <p class="text-xs text-slate-500 mt-0.5">190204092</p>
                        </td>
                        <td class="py-4 px-6">
                            <p class="font-semibold text-slate-800">PT Pertamina</p>
                            <p class="text-xs text-slate-500 mt-0.5">Bpk. Hendra Saputra</p>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                1 Kali
                            </span>
                        </td>
                        <td class="py-4 px-6 text-slate-600">
                            10 Mar 2026
                        </td>
                        <td class="py-4 px-6 text-right">
                            <button class="inline-flex items-center justify-center px-3 py-1.5 border border-blue-200 text-blue-600 rounded-lg hover:bg-blue-50 font-medium transition-colors text-xs">
                                Lihat Detail
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        {{-- Pagination Placeholder --}}
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/50 flex items-center justify-between text-sm text-slate-500">
            <p>Menampilkan 1 hingga 4 dari 124 mahasiswa</p>
            <div class="flex gap-1">
                <button class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100" disabled>&laquo;</button>
                <button class="px-3 py-1 border border-slate-300 rounded bg-blue-50 text-blue-600 font-bold">1</button>
                <button class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">2</button>
                <button class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">3</button>
                <button class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">&raquo;</button>
            </div>
        </div>
    </div>
</div>
@endsection
