@extends('layouts.mahasiswa')

@section('title', 'Penilaian MBKM - Mahasiswa')

@section('content')

    {{-- Header Section --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6 animate-fade-in-up">
        <div class="flex items-center gap-4">
            <div class="bg-blue-50 border border-blue-100 p-3.5 rounded-2xl text-blue-600 shadow-sm shrink-0">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Penilaian MBKM</h1>
                <p class="text-slate-500 mt-1 font-medium mb-1">Informasi nilai akhir dari seluruh kegiatan MBKM Anda</p>
            </div>
        </div>

        {{-- Status Badge --}}
        @if ($sudahDisahkan)
            <div class="flex items-center gap-2 bg-green-50 px-5 py-2.5 rounded-xl border border-green-200 shadow-sm shrink-0">
                <span class="w-2.5 h-2.5 bg-green-500 rounded-full shadow-sm"></span>
                <span class="text-sm font-bold text-green-700">Nilai Disahkan</span>
            </div>
        @elseif ($nilaiAkhir !== null)
            <div class="flex items-center gap-2 bg-amber-50 px-5 py-2.5 rounded-xl border border-amber-200 shadow-sm shrink-0">
                <span class="w-2.5 h-2.5 bg-amber-500 rounded-full animate-pulse shadow-sm"></span>
                <span class="text-sm font-bold text-amber-700">Menunggu Pengesahan</span>
            </div>
        @else
            <div class="flex items-center gap-2 bg-slate-50 px-5 py-2.5 rounded-xl border border-slate-200 shadow-sm shrink-0">
                <span class="w-2.5 h-2.5 bg-slate-400 rounded-full shadow-sm"></span>
                <span class="text-sm font-bold text-slate-600">Belum Ada Nilai</span>
            </div>
        @endif
    </div>

    @if (!$pendaftaran)
        {{-- Belum daftar MBKM --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-16 text-center animate-fade-in-up">
            <div class="w-20 h-20 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            </div>
            <p class="text-slate-800 font-bold text-xl mb-2">Data MBKM belum tersedia</p>
            <p class="text-slate-500 text-sm font-medium mb-6 max-w-md mx-auto">Lengkapi data pendaftaran MBKM Anda terlebih dahulu untuk melihat informasi penilaian.</p>
            <a href="{{ route('mahasiswa.data-mbkm.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-all shadow-sm hover:shadow-md">
                Lengkapi Data MBKM
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    @else
        {{-- Statistik Nilai Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 animate-fade-in-up">
            {{-- Nilai Dosen Pembimbing --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md hover:border-blue-200 transition-all duration-300">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Nilai Dosen Pembimbing</p>
                @if ($nilaiPembimbing !== null)
                    <p class="text-4xl font-black text-slate-800">{{ $nilaiPembimbing }}</p>
                    <div class="mt-5 h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-1000 {{ $nilaiPembimbing >= 85 ? 'bg-green-500' : ($nilaiPembimbing >= 70 ? 'bg-blue-500' : 'bg-amber-500') }}" style="width: {{ $nilaiPembimbing }}%"></div>
                    </div>
                @else
                    <p class="text-4xl font-black text-slate-300">-</p>
                    <div class="mt-5 h-2 w-full bg-slate-50 rounded-full border border-slate-100"></div>
                    <p class="text-xs font-bold text-slate-400 mt-3">Belum dinilai</p>
                @endif
            </div>

            {{-- Nilai Dosen Penguji --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md hover:border-blue-200 transition-all duration-300">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Nilai Dosen Penguji</p>
                @if ($nilaiPenguji !== null)
                    <p class="text-4xl font-black text-slate-800">{{ $nilaiPenguji }}</p>
                    <div class="mt-5 h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-1000 {{ $nilaiPenguji >= 85 ? 'bg-green-500' : ($nilaiPenguji >= 70 ? 'bg-blue-500' : 'bg-amber-500') }}" style="width: {{ $nilaiPenguji }}%"></div>
                    </div>
                @else
                    <p class="text-4xl font-black text-slate-300">-</p>
                    <div class="mt-5 h-2 w-full bg-slate-50 rounded-full border border-slate-100"></div>
                    <p class="text-xs font-bold text-slate-400 mt-3">Belum dinilai</p>
                @endif
            </div>

            {{-- Nilai Pembimbing Lapangan (Mitra) --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md hover:border-blue-200 transition-all duration-300">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Nilai Pembimbing Lapangan</p>
                @if ($nilaiMitra !== null)
                    <p class="text-4xl font-black text-slate-800">{{ $nilaiMitra }}</p>
                    <div class="mt-5 h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-1000 {{ $nilaiMitra >= 85 ? 'bg-green-500' : ($nilaiMitra >= 70 ? 'bg-blue-500' : 'bg-amber-500') }}" style="width: {{ $nilaiMitra }}%"></div>
                    </div>
                @else
                    <p class="text-4xl font-black text-slate-300">-</p>
                    <div class="mt-5 h-2 w-full bg-slate-50 rounded-full border border-slate-100"></div>
                    <p class="text-xs font-bold text-slate-400 mt-3">Belum dinilai</p>
                @endif
            </div>

            {{-- Nilai Akhir --}}
            <div class="bg-blue-600 rounded-2xl shadow-sm border border-blue-700 p-6 hover:shadow-md transition-all duration-300 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white rounded-bl-full opacity-10 -z-0"></div>
                <div class="relative z-10">
                    <p class="text-xs font-bold text-blue-200 uppercase tracking-wider mb-4">Nilai Akhir MBKM</p>
                    @if ($nilaiAkhir !== null)
                        <div class="flex items-baseline gap-2">
                            <p class="text-5xl font-black text-white">{{ $nilaiAkhir }}</p>
                            <span class="text-2xl font-bold text-blue-200">/ {{ $nilaiHurufFinal }}</span>
                        </div>
                        <p class="text-xs font-medium text-blue-100 mt-4 bg-blue-700/50 inline-block px-3 py-1.5 rounded-lg border border-blue-500/50">
                            Rata-rata dari {{ $penilaians->count() }} penilai
                        </p>
                    @else
                        <p class="text-4xl font-black text-blue-300">-</p>
                        <p class="text-xs font-bold text-blue-200 mt-5">Menunggu penilaian lengkap</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Alert jika sudah disahkan --}}
        @if ($sudahDisahkan)
            <div class="bg-white border-l-4 border-green-500 rounded-2xl p-6 mb-8 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 animate-fade-in-up">
                <div class="bg-green-50 p-2.5 rounded-xl text-green-600 flex-shrink-0 mt-0.5 border border-green-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="text-slate-800 font-bold text-sm mb-1">Nilai Sudah Disahkan</h4>
                    <p class="text-sm font-medium text-slate-500">Nilai Anda telah divalidasi dan disahkan secara resmi oleh Koordinator Program Studi.</p>
                </div>
            </div>
        @elseif ($nilaiAkhir !== null)
            <div class="bg-white border-l-4 border-amber-500 rounded-2xl p-6 mb-8 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 animate-fade-in-up">
                <div class="bg-amber-50 p-2.5 rounded-xl text-amber-600 flex-shrink-0 mt-0.5 border border-amber-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="text-slate-800 font-bold text-sm mb-1">Menunggu Pengesahan</h4>
                    <p class="text-sm font-medium text-slate-500">Nilai Anda sudah lengkap dan sedang menunggu pengesahan dari Koordinator Program Studi.</p>
                </div>
            </div>
        @endif

        {{-- Two Column Layout --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8 animate-fade-in-up">
            {{-- Detail Nilai Table --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                    <div class="bg-slate-50 p-2 rounded-xl border border-slate-100 text-slate-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">Detail Nilai per Penilai</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-100">
                                <th class="text-left text-xs font-bold text-slate-400 uppercase tracking-wider pb-4">Sumber Penilaian</th>
                                <th class="text-left text-xs font-bold text-slate-400 uppercase tracking-wider pb-4">Nilai</th>
                                <th class="text-left text-xs font-bold text-slate-400 uppercase tracking-wider pb-4">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $penilaiList = [
                                    ['label' => 'Dosen Pembimbing', 'nilai' => $nilaiPembimbing, 'ket' => 'Penilaian akademik & bimbingan'],
                                    ['label' => 'Dosen Penguji',    'nilai' => $nilaiPenguji,    'ket' => 'Ujian akhir program'],
                                    ['label' => 'Pembimbing Lapangan','nilai' => $nilaiMitra,    'ket' => 'Kinerja industri/lapangan'],
                                ];
                            @endphp
                            @foreach ($penilaiList as $penilai)
                                <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors duration-200">
                                    <td class="py-4 text-slate-800 font-bold text-sm">{{ $penilai['label'] }}</td>
                                    <td class="py-4">
                                        @if ($penilai['nilai'] !== null)
                                            <span class="inline-flex items-center justify-center bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-lg border border-blue-100 min-w-[3rem]">{{ $penilai['nilai'] }}</span>
                                        @else
                                            <span class="inline-flex items-center justify-center bg-slate-50 text-slate-400 text-xs font-bold px-3 py-1.5 rounded-lg border border-slate-100">Belum ada</span>
                                        @endif
                                    </td>
                                    <td class="py-4 text-slate-500 font-medium text-sm">{{ $penilai['ket'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Konversi Mata Kuliah Table --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 flex flex-col h-full">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="bg-slate-50 p-2 rounded-xl border border-slate-100 text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800">Konversi Mata Kuliah</h3>
                    </div>
                    <span class="inline-flex items-center justify-center bg-slate-50 text-slate-600 border border-slate-200 text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm">
                        @if ($details->isNotEmpty())
                            {{ $details->count() }} MK • {{ $details->sum(fn($d) => $d->mataKuliah?->sks ?? 0) }} SKS
                        @else
                            0 MK
                        @endif
                    </span>
                </div>

                @if ($details->isEmpty())
                    <div class="text-center py-10 flex-1 flex flex-col justify-center items-center">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center border border-slate-100 mb-4">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        </div>
                        <p class="text-slate-500 text-sm font-bold mb-1">
                            @if (!$konversiSks)
                                Belum ada pengajuan konversi MK
                            @elseif ($konversiSks->status === 'diproses')
                                Konversi MK menunggu persetujuan Kaprodi
                            @else
                                Konversi MK belum disetujui
                            @endif
                        </p>
                        @if (!$konversiSks || $konversiSks->status === 'pending')
                            <a href="{{ route('mahasiswa.konversi-mk.index') }}" class="mt-4 inline-flex items-center gap-2 px-5 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 font-bold text-sm rounded-xl transition-colors border border-blue-100">
                                Ajukan Konversi MK
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        @endif
                    </div>
                @else
                    <div class="overflow-x-auto rounded-xl border border-slate-100 flex-1">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 text-[11px] uppercase tracking-wider font-bold">
                                    <th class="py-3 px-4 rounded-tl-xl">Kode</th>
                                    <th class="py-3 px-4">Nama MK</th>
                                    <th class="py-3 px-4 text-center">SKS</th>
                                    <th class="py-3 px-4 text-center rounded-tr-xl">Nilai</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($details as $detail)
                                    <tr class="hover:bg-slate-50/50 transition-colors duration-200">
                                        <td class="py-3 px-4 text-slate-800 font-bold text-sm whitespace-nowrap">{{ $detail->mataKuliah?->kode_mk ?? '-' }}</td>
                                        <td class="py-3 px-4 text-slate-600 font-medium text-sm">{{ $detail->mataKuliah?->nama_mk ?? '-' }}</td>
                                        <td class="py-3 px-4 text-center">
                                            <span class="inline-flex items-center justify-center text-xs font-bold text-slate-600 bg-white border border-slate-200 w-6 h-6 rounded-md shadow-sm">{{ $detail->mataKuliah?->sks ?? 0 }}</span>
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            @if ($detail->nilai_huruf)
                                                <span class="inline-flex items-center justify-center text-xs font-bold min-w-[2.5rem] py-1 rounded-lg border
                                                    {{ in_array($detail->nilai_huruf, ['A','A-']) ? 'bg-green-50 text-green-700 border-green-200' :
                                                       (in_array($detail->nilai_huruf, ['B+','B','B-']) ? 'bg-blue-50 text-blue-700 border-blue-200' :
                                                       'bg-amber-50 text-amber-700 border-amber-200') }}">
                                                    {{ $detail->nilai_huruf }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center justify-center text-[10px] uppercase font-bold text-slate-400 bg-slate-50 border border-slate-100 px-2 py-1 rounded-md">
                                                    Proses
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- Informasi Tambahan --}}
        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-8 mb-8 flex items-start gap-4 animate-fade-in-up">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600 flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="space-y-2 mt-0.5">
                <h4 class="font-bold text-blue-900 mb-2">Informasi Sistem Penilaian</h4>
                <div class="flex items-start gap-2">
                    <span class="text-blue-400 text-lg leading-none">•</span>
                    <p class="text-sm font-medium text-blue-800">Nilai diberikan oleh dosen pembimbing, dosen penguji, dan pembimbing lapangan (mitra).</p>
                </div>
                <div class="flex items-start gap-2">
                    <span class="text-blue-400 text-lg leading-none">•</span>
                    <p class="text-sm font-medium text-blue-800">Nilai akhir merupakan rata-rata dari ketiga sumber penilaian setelah seluruhnya masuk.</p>
                </div>
                <div class="flex items-start gap-2">
                    <span class="text-blue-400 text-lg leading-none">•</span>
                    <p class="text-sm font-medium text-blue-800">
                        Konversi mata kuliah menggunakan data pengajuan dari halaman
                        <a href="{{ route('mahasiswa.konversi-mk.index') }}" class="text-blue-700 hover:text-blue-900 font-bold underline decoration-blue-300 underline-offset-2">Konversi MK</a>
                        yang disetujui Kaprodi.
                    </p>
                </div>
            </div>
        </div>
    @endif
@endsection
