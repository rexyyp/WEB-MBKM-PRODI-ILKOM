@extends('layouts.mahasiswa')

@section('title', 'Penilaian - Mahasiswa')

@section('content')
    {{-- Header Section with Status --}}
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
        <div class="flex items-center gap-2 bg-green-50 px-4 py-2 rounded-full border border-green-200">
            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
            <span class="text-sm font-semibold text-green-700">Status: Selesai</span>
        </div>
    </div>

    {{-- Statistik Nilai Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Nilai Dosen Pembimbing --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider mb-3">Nilai Dosen Pembimbing</p>
            <p class="text-4xl font-bold text-slate-900">85</p>
            <div class="mt-4 h-1 w-full bg-slate-100 rounded-full">
                <div class="h-full bg-blue-600 rounded-full" style="width: 85%"></div>
            </div>
        </div>

        {{-- Nilai Dosen Penguji --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider mb-3">Nilai Dosen Penguji</p>
            <p class="text-4xl font-bold text-slate-900">88</p>
            <div class="mt-4 h-1 w-full bg-slate-100 rounded-full">
                <div class="h-full bg-blue-600 rounded-full" style="width: 88%"></div>
            </div>
        </div>

        {{-- Nilai Pembimbing Lapangan --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider mb-3">Nilai Pembimbing Lapangan</p>
            <p class="text-4xl font-bold text-slate-900">90</p>
            <div class="mt-4 h-1 w-full bg-slate-100 rounded-full">
                <div class="h-full bg-blue-600 rounded-full" style="width: 90%"></div>
            </div>
        </div>

        {{-- Nilai Akhir (Special Blue Card) --}}
        <div class="bg-blue-600 rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <p class="text-xs font-semibold text-blue-100 uppercase tracking-wider mb-3">Nilai Akhir</p>
            <p class="text-4xl font-bold text-white">87.6 <span class="text-2xl font-semibold">/100</span></p>
        </div>
    </div>

    {{-- Info Alert --}}
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-8 flex items-start gap-3">
        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
        </svg>
        <p class="text-sm text-blue-900">Nilai telah divalidasi oleh Koordinator Prodi.</p>
    </div>

    {{-- Two Column Layout --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        {{-- Detail Nilai Table --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <h3 class="text-xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-200">Detail Nilai</h3>

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
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors duration-200">
                            <td class="py-4 text-slate-900 font-semibold">Dosen Pembimbing</td>
                            <td class="py-4">
                                <span class="inline-block bg-blue-100 text-blue-700 text-sm font-semibold px-3 py-1 rounded-full">85</span>
                            </td>
                            <td class="py-4 text-slate-600 text-sm">Penilaian akademik & bimbingan</td>
                        </tr>
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors duration-200">
                            <td class="py-4 text-slate-900 font-semibold">Dosen Penguji</td>
                            <td class="py-4">
                                <span class="inline-block bg-blue-100 text-blue-700 text-sm font-semibold px-3 py-1 rounded-full">88</span>
                            </td>
                            <td class="py-4 text-slate-600 text-sm">Ujian akhir program</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition-colors duration-200">
                            <td class="py-4 text-slate-900 font-semibold">Pembimbing Lapangan</td>
                            <td class="py-4">
                                <span class="inline-block bg-blue-100 text-blue-700 text-sm font-semibold px-3 py-1 rounded-full">90</span>
                            </td>
                            <td class="py-4 text-slate-600 text-sm">Kinerja industri/lapangan</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Konversi Mata Kuliah Table --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <h3 class="text-xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-200">Konversi Mata Kuliah</h3>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-200">
                            <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Kode MK</th>
                            <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Nama Mata Kuliah</th>
                            <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">SKS</th>
                            <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider pb-4">Nilai Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors duration-200">
                            <td class="py-4 text-slate-900 font-semibold">IF1234</td>
                            <td class="py-4 text-slate-700">Magang Industri I</td>
                            <td class="py-4 text-slate-700 font-semibold">10</td>
                            <td class="py-4">
                                <span class="inline-block bg-green-100 text-green-700 text-sm font-bold px-3 py-1 rounded-full">A</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition-colors duration-200">
                            <td class="py-4 text-slate-900 font-semibold">IF1235</td>
                            <td class="py-4 text-slate-700">Magang Industri II</td>
                            <td class="py-4 text-slate-700 font-semibold">10</td>
                            <td class="py-4">
                                <span class="inline-block bg-green-100 text-green-700 text-sm font-bold px-3 py-1 rounded-full">A</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Informasi Tambahan --}}
    <div class="bg-slate-50 rounded-xl p-6 mb-8 space-y-2">
        <div class="flex items-start gap-2">
            <span class="text-slate-400 text-lg mt-0.5">•</span>
            <p class="text-sm text-slate-700">Penilaian diinput oleh dosen pembimbing dan penguji.</p>
        </div>
        <div class="flex items-start gap-2">
            <span class="text-slate-400 text-lg mt-0.5">•</span>
            <p class="text-sm text-slate-700">Dokumen nilai dapat dilihat pada halaman <a href="{{ route('mahasiswa.dokumen.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold">Dokumen</a>.</p>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex items-center justify-between">
        <button class="border-2 border-slate-300 hover:border-slate-400 text-slate-700 hover:text-slate-900 font-semibold py-2 px-6 rounded-lg transition-all duration-200">
            Bantuan
        </button>
        <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-full transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            Unduh Transkrip
        </button>
    </div>

    {{-- Footer --}}
    <div class="mt-16 pt-8 border-t border-slate-200 flex items-center justify-between text-sm text-slate-500">
        <p>© 2024 Lumni University Academic System</p>
        <div class="flex items-center gap-6">
            <a href="#" class="hover:text-slate-700 transition-colors duration-200">Kebijakan Privasi</a>
            <a href="#" class="hover:text-slate-700 transition-colors duration-200">Syarat & Ketentuan</a>
        </div>
    </div>
@endsection
