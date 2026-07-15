@extends('layouts.mahasiswa')

@section('title', 'Penilaian MBKM - Mahasiswa')

@section('content')

    {{-- Header Section --}}
    <div class="mb-8 flex items-start justify-between">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                </div>
                <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Penilaian MBKM</h1>
            </div>
            <p class="text-slate-600 text-lg">Informasi nilai kegiatan MBKM Anda</p>
        </div>

        {{-- Status Badge --}}
        @if ($sudahDisahkan)
            <div class="flex items-center gap-2 bg-green-50 px-4 py-2 rounded-full border border-green-200">
                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                <span class="text-sm font-semibold text-green-700">Nilai Disahkan</span>
            </div>
        @elseif ($nilaiAkhir !== null)
            <div class="flex items-center gap-2 bg-amber-50 px-4 py-2 rounded-full border border-amber-200">
                <span class="w-2 h-2 bg-amber-400 rounded-full animate-pulse"></span>
                <span class="text-sm font-semibold text-amber-700">Menunggu Pengesahan</span>
            </div>
        @else
            <div class="flex items-center gap-2 bg-slate-100 px-4 py-2 rounded-full border border-slate-200">
                <span class="w-2 h-2 bg-slate-400 rounded-full"></span>
                <span class="text-sm font-semibold text-slate-600">Belum Ada Nilai</span>
            </div>
        @endif
    </div>

    @if (!$pendaftaran)
        {{-- Belum daftar MBKM --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-16 text-center">
            <svg class="w-14 h-14 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            <p class="text-slate-500 font-semibold text-lg">Data MBKM belum tersedia</p>
            <p class="text-slate-400 text-sm mt-2">Lengkapi data MBKM Anda terlebih dahulu untuk melihat penilaian.</p>
            <a href="{{ route('mahasiswa.data-mbkm.index') }}" class="mt-4 inline-block px-5 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl hover:bg-blue-700 transition-colors">
                Lengkapi Data MBKM
            </a>
        </div>
    @else
        {{-- Statistik Nilai Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            {{-- Nilai Dosen Pembimbing --}}
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
                <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider mb-3">Nilai Dosen Pembimbing</p>
                @if ($nilaiPembimbing !== null)
                    <p class="text-4xl font-bold text-slate-900">{{ $nilaiPembimbing }}</p>
                    <div class="mt-4 h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full rounded-full {{ $nilaiPembimbing >= 85 ? 'bg-green-500' : ($nilaiPembimbing >= 70 ? 'bg-blue-600' : 'bg-amber-500') }}" style="width: {{ $nilaiPembimbing }}%"></div>
                    </div>
                @else
                    <p class="text-4xl font-bold text-slate-300">-</p>
                    <div class="mt-4 h-1.5 w-full bg-slate-100 rounded-full"></div>
                    <p class="text-xs text-slate-400 mt-2">Belum dinilai</p>
                @endif
            </div>

            {{-- Nilai Dosen Penguji --}}
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
                <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider mb-3">Nilai Dosen Penguji</p>
                @if ($nilaiPenguji !== null)
                    <p class="text-4xl font-bold text-slate-900">{{ $nilaiPenguji }}</p>
                    <div class="mt-4 h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full rounded-full {{ $nilaiPenguji >= 85 ? 'bg-green-500' : ($nilaiPenguji >= 70 ? 'bg-blue-600' : 'bg-amber-500') }}" style="width: {{ $nilaiPenguji }}%"></div>
                    </div>
                @else
                    <p class="text-4xl font-bold text-slate-300">-</p>
                    <div class="mt-4 h-1.5 w-full bg-slate-100 rounded-full"></div>
                    <p class="text-xs text-slate-400 mt-2">Belum dinilai</p>
                @endif
            </div>

            {{-- Nilai Pembimbing Lapangan (Mitra) --}}
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
                <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider mb-3">Nilai Pembimbing Lapangan</p>
                @if ($nilaiMitra !== null)
                    <p class="text-4xl font-bold text-slate-900">{{ $nilaiMitra }}</p>
                    <div class="mt-4 h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full rounded-full {{ $nilaiMitra >= 85 ? 'bg-green-500' : ($nilaiMitra >= 70 ? 'bg-blue-600' : 'bg-amber-500') }}" style="width: {{ $nilaiMitra }}%"></div>
                    </div>
                @else
                    <p class="text-4xl font-bold text-slate-300">-</p>
                    <div class="mt-4 h-1.5 w-full bg-slate-100 rounded-full"></div>
                    <p class="text-xs text-slate-400 mt-2">Belum dinilai</p>
                @endif
            </div>

            {{-- Nilai Akhir --}}
            <div class="bg-blue-600 rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
                <p class="text-xs font-semibold text-blue-100 uppercase tracking-wider mb-3">Nilai Akhir</p>
                @if ($nilaiAkhir !== null)
                    <p class="text-4xl font-bold text-white">{{ $nilaiAkhir }} <span class="text-xl font-semibold text-blue-200">/ {{ $nilaiHurufFinal }}</span></p>
                    <p class="text-xs text-blue-200 mt-3">Rata-rata dari {{ $penilaians->count() }} penilai</p>
                @else
                    <p class="text-4xl font-bold text-blue-200">-</p>
                    <p class="text-xs text-blue-300 mt-3">Menunggu penilaian</p>
                @endif
            </div>
        </div>

        {{-- Alert jika sudah disahkan --}}
        @if ($sudahDisahkan)
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-8 flex items-start gap-3">
                <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="text-sm text-green-800 font-medium">Nilai Anda telah divalidasi dan disahkan oleh Koordinator Program Studi.</p>
            </div>
        @elseif ($nilaiAkhir !== null)
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-8 flex items-start gap-3">
                <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="text-sm text-amber-800 font-medium">Nilai sedang menunggu pengesahan dari Koordinator Program Studi.</p>
            </div>
        @endif

        {{-- Two Column Layout --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            {{-- Detail Nilai Table --}}
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
                <h3 class="text-xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-200">Detail Nilai per Penilai</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Sumber Penilaian</th>
                                <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Nilai</th>
                                <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Keterangan</th>
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
                                <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors duration-200">
                                    <td class="py-4 text-slate-900 font-semibold text-sm">{{ $penilai['label'] }}</td>
                                    <td class="py-4">
                                        @if ($penilai['nilai'] !== null)
                                            <span class="inline-block bg-blue-100 text-blue-700 text-sm font-bold px-3 py-1 rounded-full">{{ $penilai['nilai'] }}</span>
                                        @else
                                            <span class="inline-block bg-slate-100 text-slate-400 text-xs font-semibold px-3 py-1 rounded-full">Belum ada</span>
                                        @endif
                                    </td>
                                    <td class="py-4 text-slate-600 text-sm">{{ $penilai['ket'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Konversi Mata Kuliah Table --}}
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
                <h3 class="text-xl font-bold text-slate-900 mb-1 pb-0">Konversi Mata Kuliah</h3>
                <p class="text-xs text-slate-400 mb-5 pb-4 border-b border-slate-200">
                    @if ($details->isNotEmpty())
                        {{ $details->count() }} MK • Total {{ $details->sum(fn($d) => $d->mataKuliah?->sks ?? 0) }} SKS
                    @else
                        Belum ada konversi yang disetujui
                    @endif
                </p>

                @if ($details->isEmpty())
                    <div class="text-center py-8">
                        <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        <p class="text-slate-400 text-sm font-medium">
                            @if (!$konversiSks)
                                Belum ada pengajuan konversi MK
                            @elseif ($konversiSks->status === 'diproses')
                                Pengajuan konversi sedang menunggu ACC Kaprodi
                            @else
                                Konversi MK belum disetujui
                            @endif
                        </p>
                        @if (!$konversiSks || $konversiSks->status === 'pending')
                            <a href="{{ route('mahasiswa.konversi-mk.index') }}" class="mt-3 inline-block text-xs font-semibold text-blue-600 hover:underline">
                                Ajukan Konversi MK →
                            </a>
                        @endif
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-slate-200">
                                    <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-3">Kode MK</th>
                                    <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-3">Nama Mata Kuliah</th>
                                    <th class="text-center text-xs font-semibold text-slate-600 uppercase tracking-wider pb-3">SKS</th>
                                    <th class="text-center text-xs font-semibold text-slate-600 uppercase tracking-wider pb-3">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors duration-200">
                                        <td class="py-3 text-slate-700 font-bold text-sm">{{ $detail->mataKuliah?->kode_mk ?? '-' }}</td>
                                        <td class="py-3 text-slate-700 text-sm">{{ $detail->mataKuliah?->nama_mk ?? '-' }}</td>
                                        <td class="py-3 text-center">
                                            <span class="text-sm font-semibold text-slate-600 bg-slate-100 px-2 py-0.5 rounded">{{ $detail->mataKuliah?->sks ?? 0 }}</span>
                                        </td>
                                        <td class="py-3 text-center">
                                            @if ($detail->nilai_huruf)
                                                <span class="inline-block text-sm font-bold px-3 py-1 rounded-full
                                                    {{ in_array($detail->nilai_huruf, ['A','A-']) ? 'bg-green-100 text-green-700' :
                                                       (in_array($detail->nilai_huruf, ['B+','B','B-']) ? 'bg-blue-100 text-blue-700' :
                                                       'bg-amber-100 text-amber-700') }}">
                                                    {{ $detail->nilai_huruf }}
                                                </span>
                                            @else
                                                <span class="inline-block bg-slate-100 text-slate-400 text-xs font-semibold px-3 py-1 rounded-full">
                                                    Menunggu
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
        <div class="bg-slate-50 rounded-xl p-6 mb-8 space-y-2">
            <div class="flex items-start gap-2">
                <span class="text-slate-400 text-lg mt-0.5">•</span>
                <p class="text-sm text-slate-700">Nilai diberikan oleh dosen pembimbing, dosen penguji, dan pembimbing lapangan (mitra).</p>
            </div>
            <div class="flex items-start gap-2">
                <span class="text-slate-400 text-lg mt-0.5">•</span>
                <p class="text-sm text-slate-700">Nilai akhir merupakan rata-rata dari ketiga sumber penilaian.</p>
            </div>
            <div class="flex items-start gap-2">
                <span class="text-slate-400 text-lg mt-0.5">•</span>
                <p class="text-sm text-slate-700">
                    Konversi mata kuliah menggunakan data yang Anda ajukan di halaman
                    <a href="{{ route('mahasiswa.konversi-mk.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold">Konversi MK</a>
                    dan sudah disetujui oleh Kaprodi.
                </p>
            </div>
        </div>
    @endif
@endsection
