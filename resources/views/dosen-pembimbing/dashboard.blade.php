@extends('layouts.dosen-pembimbing')

@section('title', 'Dashboard Dosen - Manajemen MBKM')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Dashboard Dosen</h1>
        </div>
        <p class="text-slate-600 text-lg">Pantau dan kelola kegiatan MBKM mahasiswa bimbingan</p>
    </div>

    {{-- Alert Section --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Peringatan Alert (Yellow) --}}
        @if($belumIsiLogbookHariIni > 0)
        <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-6 flex items-start gap-4">
            <div class="flex-shrink-0 w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="font-semibold text-yellow-900 mb-1">Peringatan Logbook Harian</h3>
                <p class="text-yellow-800 text-sm">{{ $belumIsiLogbookHariIni }} mahasiswa aktif belum mengisi logbook hari ini.</p>
            </div>
        </div>
        @else
        <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-6 flex items-start gap-4">
            <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="font-semibold text-green-900 mb-1">Logbook Harian Lengkap</h3>
                <p class="text-green-800 text-sm">Semua mahasiswa aktif telah mengisi logbook hari ini.</p>
            </div>
        </div>
        @endif

        {{-- Tindakan Diperlukan Alert (Red) --}}
        @if($logbookBelumDireview > 0 || $penilaianBelumDiisi > 0)
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6">
            <h3 class="font-semibold text-red-900 mb-2">Tindakan Diperlukan</h3>
            <ul class="space-y-1 text-red-800 text-sm">
                @if($logbookBelumDireview > 0)
                <li class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                    {{ $logbookBelumDireview }} logbook perlu segera divalidasi
                </li>
                @endif
                @if($penilaianBelumDiisi > 0)
                <li class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                    {{ $penilaianBelumDiisi }} mahasiswa belum Anda berikan nilai
                </li>
                @endif
            </ul>
        </div>
        @else
        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6">
            <h3 class="font-semibold text-blue-900 mb-2">Informasi Status</h3>
            <p class="text-blue-800 text-sm">Tidak ada tugas mendesak. Semua logbook telah direview dan mahasiswa telah dinilai.</p>
        </div>
        @endif
    </div>

    {{-- Statistics Dashboard --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Jumlah Mahasiswa Bimbingan --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Jumlah Mahasiswa</p>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3.414a2 2 0 01-2-2V6.414a2 2 0 012-2h15.172a2 2 0 012 2v12.172a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-slate-900">{{ $totalBimbingan }}</p>
            <p class="text-xs text-slate-500 mt-2">Total mahasiswa bimbingan</p>
        </div>

        {{-- Mahasiswa Aktif --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Mahasiswa Aktif</p>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-slate-900">{{ $mahasiswaAktif }}</p>
            <p class="text-xs text-slate-500 mt-2">Status program berjalan</p>
        </div>

        {{-- Logbook Belum Direview --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Perlu Direview</p>
                <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-slate-900">{{ $logbookBelumDireview }}</p>
            <p class="text-xs text-slate-500 mt-2">Logbook menunggu validasi</p>
        </div>

        {{-- Penilaian Belum Diisi --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Belum Dinilai</p>
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-slate-900">{{ $penilaianBelumDiisi }}</p>
            <p class="text-xs text-slate-500 mt-2">Nilai belum diberikan</p>
        </div>
    </div>

    {{-- Main Content Area --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Daftar Mahasiswa (Main Section - 2 columns) --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-200">Daftar Mahasiswa Bimbingan Terbaru</h2>

                {{-- Responsive Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Nama Mahasiswa</th>
                                <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Status MBKM</th>
                                <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Progress Waktu</th>
                                <th class="text-center text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @forelse($mahasiswas as $mhs)
                            @php
                                $start = \Carbon\Carbon::parse($mhs->tgl_mulai);
                                $end = \Carbon\Carbon::parse($mhs->tgl_selesai);
                                $now = \Carbon\Carbon::now();
                                
                                if ($now->lt($start)) {
                                    $progress = 0;
                                } elseif ($now->gt($end)) {
                                    $progress = 100;
                                } else {
                                    $totalDays = $start->diffInDays($end);
                                    $passedDays = $start->diffInDays($now);
                                    $progress = $totalDays > 0 ? round(($passedDays / $totalDays) * 100) : 0;
                                }
                            @endphp
                            <tr class="hover:bg-slate-50 transition-colors duration-200">
                                <td class="py-4">
                                    <div class="text-slate-900 font-semibold">{{ $mhs->mahasiswa->user->name ?? '-' }}</div>
                                    <div class="text-xs text-slate-500 mt-0.5">{{ $mhs->mahasiswa->nim ?? '-' }}</div>
                                </td>
                                <td class="py-4">
                                    @if($mhs->status === 'menunggu')
                                    <span class="inline-block bg-amber-100 text-amber-700 text-xs font-semibold px-3 py-1 rounded-full">Menunggu</span>
                                    @elseif($mhs->status === 'berjalan')
                                    <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">Berjalan</span>
                                    @elseif($mhs->status === 'selesai')
                                    <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">Selesai</span>
                                    @endif
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center gap-2 pr-4">
                                        <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">
                                            <div class="h-full {{ $progress == 100 ? 'bg-green-600' : 'bg-blue-600' }} rounded-full" style="width: {{ $progress }}%"></div>
                                        </div>
                                        <span class="text-xs font-semibold text-slate-600">{{ $progress }}%</span>
                                    </div>
                                </td>
                                <td class="py-4 text-center">
                                    <a href="{{ route('dosen-pembimbing.mahasiswa.index') }}?search={{ $mhs->mahasiswa->nim }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm transition-colors duration-200">Lihat Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-slate-500">
                                    Belum ada mahasiswa bimbingan yang terdaftar.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($mahasiswas->hasPages())
                <div class="mt-6">
                    {{ $mahasiswas->links('pagination::tailwind') }}
                </div>
                @endif
            </div>
        </div>

        {{-- Aktivitas Terbaru (Right Sidebar) --}}
        <div>
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                <h2 class="text-xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-200">Aktivitas Terbaru</h2>

                {{-- Activity Timeline --}}
                <div class="space-y-5 text-center py-6">
                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-slate-500 text-sm">Belum ada aktivitas terbaru dari mahasiswa bimbingan Anda.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
