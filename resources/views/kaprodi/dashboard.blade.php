@extends('layouts.kaprodi')

@section('title', 'Dashboard Kaprodi - MBKM System')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Dashboard Kaprodi</h1>
        </div>
        <p class="text-slate-600 text-lg">Ringkasan statistik dan aktivitas MBKM di program studi</p>
    </div>

    {{-- Top Cards (4 Cards) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Total Mahasiswa Aktif --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 flex flex-col hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <span class="text-xs font-bold text-slate-400 bg-slate-100 px-2 py-1 rounded-full">TOTAL</span>
            </div>
            <p class="text-sm font-semibold text-slate-500 mb-1">Mahasiswa Aktif MBKM</p>
            <h3 class="text-3xl font-extrabold text-slate-900">{{ number_format($totalMahasiswa) }}</h3>
        </div>

        {{-- Menunggu Validasi --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 flex flex-col border-b-4 border-b-red-500 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-xs font-bold text-red-600 bg-red-100 px-2 py-1 rounded-full flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-600 {{ $menungguValidasi > 0 ? 'animate-pulse' : '' }}"></span> Pending
                </span>
            </div>
            <p class="text-sm font-semibold text-slate-500 mb-1">Menunggu Validasi</p>
            <h3 class="text-3xl font-extrabold {{ $menungguValidasi > 0 ? 'text-red-600' : 'text-slate-900' }}">{{ number_format($menungguValidasi) }}</h3>
        </div>

        {{-- Sedang Berjalan --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 flex flex-col hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </div>
                <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">AKTIF</span>
            </div>
            <p class="text-sm font-semibold text-slate-500 mb-1">Sedang Berjalan</p>
            <h3 class="text-3xl font-extrabold text-slate-900">{{ number_format($sedangBerjalan) }}</h3>
        </div>

        {{-- Selesai & Lulus --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 flex flex-col hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded-full">DONE</span>
            </div>
            <p class="text-sm font-semibold text-slate-500 mb-1">Selesai & Lulus</p>
            <h3 class="text-3xl font-extrabold text-slate-900">{{ number_format($selesai) }}</h3>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        {{-- KIRI: Grafik / Informasi --}}
        <div class="xl:col-span-2 space-y-8">

            {{-- Top Row: Status MBKM & Kepatuhan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Status Aktivitas MBKM (Pie Chart) --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 flex flex-col">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 border-b border-slate-100 pb-3">Status Aktivitas MBKM</h3>

                    <div class="flex-1 flex flex-col items-center justify-center py-4">
                        {{-- Donut Chart — data dari DB --}}
                        <div class="relative w-40 h-40 rounded-full shadow-sm flex items-center justify-center"
                             style="background: {{ $chartGradient }};">
                            <div class="w-28 h-28 bg-white rounded-full flex flex-col items-center justify-center">
                                <span class="text-xs text-slate-500 font-semibold">Total</span>
                                <span class="text-xl font-bold text-slate-900">{{ number_format($totalMahasiswa) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mt-4">
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-blue-600"></span>
                                <span class="font-medium text-slate-700">Berjalan</span>
                            </div>
                            <span class="font-bold text-slate-900">{{ $pctBerjalan }}%</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-slate-600"></span>
                                <span class="font-medium text-slate-700">Selesai</span>
                            </div>
                            <span class="font-bold text-slate-900">{{ $pctSelesai }}%</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-slate-200"></span>
                                <span class="font-medium text-slate-700">Belum Mulai / Lainnya</span>
                            </div>
                            <span class="font-bold text-slate-900">{{ $pctLainnya }}%</span>
                        </div>
                    </div>
                </div>

                {{-- Status Kepatuhan Akademik --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 flex flex-col">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 border-b border-slate-100 pb-3">Status Kepatuhan Akademik</h3>

                    <div class="flex-1 flex flex-col justify-center space-y-6">
                        <div class="flex items-center gap-4 p-5 rounded-xl bg-green-50 border border-green-100">
                            <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center text-green-600 font-bold shadow-sm flex-shrink-0">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-green-800 uppercase tracking-wider mb-1">Sesuai Syarat</p>
                                <p class="text-2xl font-extrabold text-green-900">{{ $sesuaiSyarat }} <span class="text-sm font-medium text-green-700">Mhs</span></p>
                                <p class="text-xs text-green-600 mt-0.5">Konversi sudah disetujui</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 p-5 rounded-xl bg-yellow-50 border border-yellow-100">
                            <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center text-yellow-600 font-bold shadow-sm flex-shrink-0">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-yellow-800 uppercase tracking-wider mb-1">Perlu Perhatian</p>
                                <p class="text-2xl font-extrabold text-yellow-900">{{ $perluPerhatian }} <span class="text-sm font-medium text-yellow-700">Mhs</span></p>
                                <p class="text-xs text-yellow-600 mt-0.5">Belum ada konversi ACC</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        {{-- KANAN: Action Center & Activity --}}
        <div class="xl:col-span-1 space-y-8">

            {{-- Tindakan Diperlukan (Action Required) --}}
            <div class="bg-red-50 rounded-xl shadow-sm border border-red-100 p-6 relative overflow-hidden">
                <div class="absolute -top-4 -right-4 p-4 opacity-10">
                    <svg class="w-32 h-32 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                </div>

                <div class="flex items-center gap-2 mb-5 relative z-10">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <h3 class="text-lg font-bold text-red-900">Tindakan Diperlukan</h3>
                </div>

                <div class="space-y-3 relative z-10">
                    {{-- Aksi 1: Validasi Pengajuan Magang --}}
                    <div class="bg-white rounded-lg p-4 border border-red-100 shadow-sm flex items-center justify-between hover:border-red-300 transition-colors group">
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold text-slate-900 group-hover:text-red-700 transition-colors">Validasi Pengajuan Magang</p>
                            @if ($antrianPengajuan > 0)
                                <p class="text-xs text-red-600 font-semibold mt-1">{{ $antrianPengajuan }} pengajuan tertunda</p>
                            @else
                                <p class="text-xs text-green-600 font-semibold mt-1">Semua sudah diproses ✓</p>
                            @endif
                        </div>
                        <a href="{{ route('kaprodi.data-mahasiswa.index') }}"
                           class="ml-3 px-4 py-2 {{ $antrianPengajuan > 0 ? 'bg-red-600 hover:bg-red-700' : 'bg-slate-200 hover:bg-slate-300' }} text-white text-xs font-bold rounded-lg transition-colors shadow-sm flex-shrink-0">
                            Lihat
                        </a>
                    </div>

                    {{-- Aksi 2: Sahkan Konversi SKS --}}
                    <div class="bg-white rounded-lg p-4 border border-red-100 shadow-sm flex items-center justify-between hover:border-red-300 transition-colors group">
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold text-slate-900 group-hover:text-red-700 transition-colors">Sahkan Konversi SKS</p>
                            @if ($antrianKonversi > 0)
                                <p class="text-xs text-red-600 font-semibold mt-1">{{ $antrianKonversi }} mahasiswa menunggu</p>
                            @else
                                <p class="text-xs text-green-600 font-semibold mt-1">Semua sudah diproses ✓</p>
                            @endif
                        </div>
                        <a href="{{ route('kaprodi.konversi-sks.index') }}"
                           class="ml-3 px-4 py-2 {{ $antrianKonversi > 0 ? 'bg-red-600 hover:bg-red-700' : 'bg-slate-200 hover:bg-slate-300' }} text-white text-xs font-bold rounded-lg transition-colors shadow-sm flex-shrink-0">
                            Proses
                        </a>
                    </div>

                    {{-- Aksi 3: Validasi Nilai Akhir --}}
                    <div class="bg-white rounded-lg p-4 border border-red-100 shadow-sm flex items-center justify-between hover:border-red-300 transition-colors group">
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold text-slate-900 group-hover:text-red-700 transition-colors">Validasi Nilai Akhir</p>
                            @if ($antrianNilai > 0)
                                <p class="text-xs text-red-600 font-semibold mt-1">{{ $antrianNilai }} mahasiswa menunggu</p>
                            @else
                                <p class="text-xs text-green-600 font-semibold mt-1">Semua sudah diproses ✓</p>
                            @endif
                        </div>
                        <a href="{{ route('kaprodi.penilaian-mbkm.index') }}"
                           class="ml-3 px-4 py-2 {{ $antrianNilai > 0 ? 'bg-red-600 hover:bg-red-700' : 'bg-slate-200 hover:bg-slate-300' }} text-white text-xs font-bold rounded-lg transition-colors shadow-sm flex-shrink-0">
                            Validasi
                        </a>
                    </div>
                </div>
            </div>

            {{-- Aktivitas Terkini (Recent Activity) --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <div class="flex justify-between items-center mb-6 border-b border-slate-100 pb-3">
                    <h3 class="text-lg font-bold text-slate-900">Aktivitas Terkini</h3>
                    <a href="{{ route('kaprodi.konversi-sks.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-bold">Lihat Semua</a>
                </div>

                @if ($aktivitasTerkini->isEmpty())
                    <div class="text-center py-8">
                        <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-slate-400 text-sm font-medium">Belum ada aktivitas</p>
                    </div>
                @else
                    <div class="relative border-l-2 border-slate-100 ml-3 space-y-6">
                        @foreach ($aktivitasTerkini as $item)
                            @php
                                $dotColor = match($item['warna']) {
                                    'green'  => 'bg-green-600',
                                    'yellow' => 'bg-yellow-500',
                                    'blue'   => 'bg-blue-600',
                                    default  => 'bg-slate-500',
                                };
                                $bgColor = match($item['warna']) {
                                    'green'  => 'bg-green-50',
                                    'yellow' => 'bg-yellow-50',
                                    'blue'   => 'bg-blue-50',
                                    default  => 'bg-slate-100',
                                };
                            @endphp
                            <div class="relative pl-6">
                                <div class="absolute -left-2.5 top-0 w-5 h-5 rounded-full {{ $bgColor }} border-2 border-white flex items-center justify-center">
                                    <div class="w-2.5 h-2.5 rounded-full {{ $dotColor }}"></div>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-700 leading-snug">
                                        <span class="font-bold text-slate-900">{{ $item['nama'] }}</span>
                                        {{ $item['aksi'] }}
                                    </p>
                                    <p class="text-xs font-semibold text-slate-400 mt-1.5">
                                        {{ $item['waktu']?->diffForHumans() ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
