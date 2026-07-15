@extends('layouts.dosen-penguji')

@section('title', 'Dashboard Dosen Penguji')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Dashboard Penguji</h1>
        </div>
        <p class="text-slate-600 text-lg">Pantau aktivitas pengujian dan review uji kompetensi mahasiswa</p>
    </div>

    {{-- Alert Section --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Peringatan Alert (Yellow) --}}
        <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-6 flex items-start gap-4">
            <div class="flex-shrink-0 w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="font-semibold text-yellow-900 mb-1">Peringatan</h3>
                <p class="text-yellow-800 text-sm">Ada {{ $jadwalHariIni }} jadwal ujian yang akan berlangsung hari ini.</p>
            </div>
        </div>

        {{-- Tindakan Diperlukan Alert (Red) --}}
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6">
            <h3 class="font-semibold text-red-900 mb-2">Tindakan Diperlukan</h3>
            <ul class="space-y-1 text-red-800 text-sm">
                <li class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                    {{ $menungguProposal }} mahasiswa menunggu review proposal.
                </li>
                <li class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                    {{ $perluPerbaikanLaporan }} mahasiswa memerlukan perbaikan laporan.
                </li>
            </ul>
        </div>
    </div>

    {{-- Statistics Dashboard --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Total Mahasiswa Diuji --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Mahasiswa Diuji</p>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-slate-900">{{ $totalMahasiswa }}</p>
            <p class="text-xs text-slate-500 mt-2">Total alokasi mahasiswa</p>
        </div>

        {{-- Menunggu Review --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Menunggu Review</p>
                <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-slate-900">{{ $menungguReview }}</p>
            <p class="text-xs text-slate-500 mt-2">Proposal & Laporan</p>
        </div>

        {{-- Sesi Terjadwal --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Sesi Terjadwal</p>
                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-slate-900">{{ $sesiTerjadwal }}</p>
            <p class="text-xs text-slate-500 mt-2">Ujian terdekat</p>
        </div>

        {{-- Telah Lulus Ujian --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Telah Lulus</p>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-slate-900">{{ $telahLulus }}</p>
            <p class="text-xs text-slate-500 mt-2">Mahasiswa disetujui</p>
        </div>
    </div>

    {{-- Main Content Area --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Jadwal Ujian Mendatang (Main Section - 2 columns) --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-200">Jadwal Ujian Mendatang</h2>

                {{-- Responsive Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Mahasiswa</th>
                                <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Tahapan</th>
                                <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Waktu Ujian</th>
                                <th class="text-center text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @forelse ($jadwalMendatang as $jadwal)
                            <tr class="hover:bg-slate-50 transition-colors duration-200">
                                <td class="py-4 text-slate-900 font-semibold">
                                    {{ $jadwal->pendaftaranMbkm->mahasiswa->user->name ?? '-' }}
                                    <div class="text-xs text-slate-500 font-normal">{{ $jadwal->pendaftaranMbkm->mahasiswa->nim ?? '-' }}</div>
                                </td>
                                <td class="py-4">
                                    @if($jadwal->jenis_ujian == 'proposal')
                                        <span class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full">Proposal</span>
                                    @else
                                        <span class="inline-block bg-fuchsia-100 text-fuchsia-700 text-xs font-semibold px-3 py-1 rounded-full">Laporan Akhir</span>
                                    @endif
                                </td>
                                <td class="py-4">
                                    <div class="font-semibold text-slate-800 text-sm">
                                        {{ \Carbon\Carbon::parse($jadwal->tgl_ujian)->translatedFormat('l, d M Y') }}
                                    </div>
                                    <div class="text-xs text-slate-500">Menunggu Waktu Ujian</div>
                                </td>
                                <td class="py-4 text-center">
                                    <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold text-sm transition-colors duration-200">Mulai Ujian</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-6 text-center text-slate-400 font-medium text-sm">
                                    Tidak ada jadwal ujian mendatang.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('dosen-penguji.uji-kompetensi.proposal') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors">Lihat Semua Jadwal &rarr;</a>
                </div>
            </div>
        </div>

        {{-- Aktivitas Terbaru (Right Sidebar) --}}
        <div>
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                <h2 class="text-xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-200">Aktivitas Terbaru</h2>

                {{-- Activity Timeline --}}
                <div class="space-y-5">
                    @forelse($aktivitasTerbaru as $aktivitas)
                    <div class="pb-5 border-b border-slate-200 last:border-b-0">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 {{ $aktivitas->status == 'diajukan' ? 'bg-amber-500' : 'bg-blue-600' }} rounded-full mt-2 flex-shrink-0"></div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-slate-900 text-sm truncate">{{ $aktivitas->pendaftaranMbkm->mahasiswa->user->name ?? 'Mahasiswa' }}</p>
                                <p class="text-xs text-slate-600 mb-2">
                                    Status Uji {{ ucfirst(str_replace('_', ' ', $aktivitas->jenis_ujian)) }}: {{ ucfirst($aktivitas->status) }}
                                </p>
                                <p class="text-xs text-slate-500 mb-3">{{ $aktivitas->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-slate-400 py-4 text-sm">
                        Belum ada aktivitas terbaru
                    </div>
                    @endforelse
                </div>

                {{-- View All Button --}}
                <button class="w-full mt-6 py-2 border border-slate-300 text-slate-700 hover:bg-slate-50 font-semibold rounded-lg transition-colors duration-200 text-sm">
                    Lihat Semua Aktivitas
                </button>
            </div>
        </div>
    </div>
@endsection
