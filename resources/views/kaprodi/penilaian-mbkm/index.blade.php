@extends('layouts.kaprodi')

@section('title', 'Penilaian MBKM - Kaprodi Panel')

@section('content')
    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="mb-6 flex items-center gap-3 rounded-xl bg-green-50 border border-green-200 px-5 py-4 text-green-800 text-sm font-medium">
            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-6 flex items-center gap-3 rounded-xl bg-red-50 border border-red-200 px-5 py-4 text-red-800 text-sm font-medium">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Penilaian MBKM</h1>
        </div>
        <p class="text-slate-600 text-lg">Kelola dan input nilai konversi kegiatan MBKM mahasiswa</p>
    </div>

    {{-- Top Cards (4 Cards) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Total Mahasiswa --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col justify-between hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="flex items-start justify-between mb-4">
                <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest">TOTAL MAHASISWA</h3>
                <div class="p-2.5 bg-blue-50 text-blue-600 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-4xl font-extrabold text-slate-900 tracking-tight">{{ $stats['totalMahasiswa'] }}</span>
            </div>
        </div>

        {{-- Menunggu Nilai --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col justify-between hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="flex items-start justify-between mb-4">
                <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest">MENUNGGU NILAI</h3>
                <div class="p-2.5 bg-red-50 text-red-600 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-4xl font-extrabold text-red-600 tracking-tight">{{ $stats['menungguNilai'] }}</span>
            </div>
        </div>

        {{-- Siap Disahkan --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col justify-between hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="flex items-start justify-between mb-4">
                <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest">SIAP DISAHKAN</h3>
                <div class="p-2.5 bg-amber-50 text-amber-600 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-4xl font-extrabold text-slate-900 tracking-tight">{{ $stats['siapAcc'] }}</span>
            </div>
        </div>

        {{-- Selesai Disahkan --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col justify-between hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="flex items-start justify-between mb-4">
                <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest">SELESAI DISAHKAN</h3>
                <div class="p-2.5 bg-green-50 text-green-600 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-4xl font-extrabold text-slate-900 tracking-tight">{{ $stats['selesaiAcc'] }}</span>
            </div>
        </div>
    </div>

    {{-- Main Content Container --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden relative">
        {{-- Action Bar --}}
        <form method="GET" action="{{ route('kaprodi.penilaian-mbkm.index') }}">
        <div class="p-6 border-b border-slate-100 bg-white">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                {{-- Search --}}
                <div class="relative w-full sm:w-96">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="block w-full pl-10 pr-3 py-2.5 border-none rounded-lg leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-sm font-medium"
                           placeholder="Cari nama atau NIM mahasiswa...">
                </div>

                {{-- Status Filters --}}
                <div class="flex items-center gap-3 w-full sm:w-auto overflow-x-auto pb-2 sm:pb-0">
                    <div class="relative w-48 flex-shrink-0">
                        <select name="status" onchange="this.form.submit()"
                                class="block w-full pl-4 pr-10 py-2.5 border-none rounded-lg leading-5 bg-slate-50 text-slate-700 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-sm appearance-none">
                            <option value="">Semua Status</option>
                            <option value="belum_lengkap" {{ request('status') === 'belum_lengkap' ? 'selected' : '' }}>Belum Lengkap</option>
                            <option value="siap_acc"      {{ request('status') === 'siap_acc'      ? 'selected' : '' }}>Siap ACC</option>
                            <option value="selesai_acc"   {{ request('status') === 'selesai_acc'   ? 'selected' : '' }}>Selesai ACC</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <button type="submit" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-lg transition-colors flex-shrink-0">
                        Cari
                    </button>
                </div>
            </div>
        </div>
        </form>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">NAMA MAHASISWA</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">MITRA MBKM</th>
                        <th scope="col" class="px-4 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">NILAI<br>PEMBIMBING</th>
                        <th scope="col" class="px-4 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">NILAI<br>PENGUJI</th>
                        <th scope="col" class="px-4 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">NILAI<br>LAPANGAN</th>
                        <th scope="col" class="px-4 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">NILAI<br>FINAL</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">STATUS</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">AKSI</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    @forelse ($pendaftarans as $p)
                        @php
                            $nilaiPembimbing = $p->penilaians->firstWhere('jenis_penilai', 'pembimbing')?->nilai_total;
                            $nilaiPenguji    = $p->penilaians->firstWhere('jenis_penilai', 'penguji')?->nilai_total;
                            $nilaiMitra      = $p->penilaians->firstWhere('jenis_penilai', 'mitra')?->nilai_total;

                            $scores    = array_filter([$nilaiPembimbing, $nilaiPenguji, $nilaiMitra], fn($v) => $v !== null);
                            $nilaiAkhir = count($scores) > 0 ? round(array_sum($scores) / count($scores), 1) : null;

                            $konversi = $p->konversiSks;
                            $konversiDisetujui = $konversi && $konversi->status === 'disetujui';
                            $sudahSelesai      = $konversi && $konversi->status_penilaian === 'selesai';
                            $adaNilai          = count($scores) > 0;

                            if ($sudahSelesai) {
                                $statusLabel = 'Selesai ACC';
                                $statusClass = 'bg-green-100 text-green-700';
                            } elseif ($konversiDisetujui && $adaNilai) {
                                $statusLabel = 'Siap ACC';
                                $statusClass = 'bg-blue-50 text-blue-700';
                            } else {
                                $statusLabel = 'Belum Lengkap';
                                $statusClass = 'bg-yellow-50 text-yellow-700';
                            }
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-5">
                                <div class="text-sm font-bold text-blue-700 leading-tight">{{ $p->mahasiswa->user->name ?? '-' }}</div>
                                <div class="text-[13px] font-medium text-slate-500 mt-1">{{ $p->mahasiswa->nim ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-sm font-medium text-slate-700">{{ $p->mitraMbkm->nama_mitra ?? '-' }}</div>
                            </td>
                            <td class="px-4 py-5 text-center">
                                @if($nilaiPembimbing !== null)
                                    <span class="text-sm font-bold text-slate-900">{{ $nilaiPembimbing }}</span>
                                @else
                                    <span class="text-sm font-bold text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-5 text-center">
                                @if($nilaiPenguji !== null)
                                    <span class="text-sm font-bold text-slate-900">{{ $nilaiPenguji }}</span>
                                @else
                                    <span class="text-sm font-bold text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-5 text-center">
                                @if($nilaiMitra !== null)
                                    <span class="text-sm font-bold text-slate-900">{{ $nilaiMitra }}</span>
                                @else
                                    <span class="text-sm font-bold text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-5 text-center">
                                @if($nilaiAkhir !== null)
                                    <span class="text-sm font-bold text-blue-600">{{ $nilaiAkhir }}</span>
                                @else
                                    <span class="text-sm font-bold text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-center whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-right">
                                @if($sudahSelesai)
                                    <span class="inline-flex items-center justify-end text-sm font-bold text-green-600 gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Telah Di-ACC
                                    </span>
                                @elseif($konversiDisetujui && $adaNilai)
                                    <a href="{{ route('kaprodi.penilaian-mbkm.form', $p->id) }}"
                                       class="inline-flex items-center px-4 py-2 rounded-lg text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white transition-colors shadow-sm gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        ACC & Nilai Konversi
                                    </a>
                                @else
                                    <a href="{{ route('kaprodi.penilaian-mbkm.form', $p->id) }}"
                                       class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors gap-1">
                                        Lihat Detail
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                    <p class="text-slate-500 font-medium">Belum ada data penilaian</p>
                                    <p class="text-slate-400 text-sm">Mahasiswa yang sudah berjalan/selesai MBKM akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between bg-white">
            <p class="text-xs text-slate-500 font-medium">
                Menampilkan {{ $pendaftarans->firstItem() ?? 0 }}–{{ $pendaftarans->lastItem() ?? 0 }} dari {{ $pendaftarans->total() }} data
            </p>
            @if ($pendaftarans->hasPages())
                <div class="flex items-center gap-1">
                    {{ $pendaftarans->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
