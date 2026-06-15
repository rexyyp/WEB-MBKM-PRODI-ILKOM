@extends('layouts.mahasiswa')

@section('title', 'Konversi Mata Kuliah - Mahasiswa')

@section('content')
    {{-- Header Section with Status --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </div>
                <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Konversi Mata Kuliah</h1>
            </div>
            <p class="text-slate-600 text-lg">Informasi hasil konversi mata kuliah dari kegiatan MBKM.</p>
        </div>
        <div class="flex items-center gap-2 bg-green-50 px-4 py-2 rounded-full border border-green-200 shrink-0 w-fit">
            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
            <span class="text-sm font-semibold text-green-700">Status Konversi: Disetujui</span>
        </div>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Total Mata Kuliah --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider mb-3">Total Mata Kuliah</p>
            <p class="text-4xl font-bold text-slate-900">3 <span class="text-lg font-semibold">MK</span></p>
        </div>

        {{-- Total SKS --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider mb-3">Total SKS</p>
            <p class="text-4xl font-bold text-slate-900">10 <span class="text-lg font-semibold">SKS</span></p>
        </div>

        {{-- Semester --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider mb-3">Semester</p>
            <p class="text-4xl font-bold text-slate-900">6</p>
            <p class="text-sm text-slate-600 mt-2">Semester Genap</p>
        </div>

        {{-- Status Konversi (Special Blue Card) --}}
        <div class="bg-blue-600 rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <p class="text-xs font-semibold text-blue-100 uppercase tracking-wider mb-3">Status Konversi</p>
            <p class="text-3xl font-bold text-white mb-1">Disetujui</p>
            <p class="text-lg font-semibold text-blue-100">10 SKS</p>
        </div>
    </div>

    {{-- Alert Card --}}
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-8 flex items-start gap-4">
        <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <div>
            <p class="text-sm font-semibold text-blue-900">Konversi mata kuliah telah disetujui oleh Koordinator Program Studi.</p>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="mb-8">
        {{-- Daftar Konversi --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h2 class="text-2xl font-bold text-slate-900">Daftar Konversi Mata Kuliah</h2>
                <a href="{{ route('mahasiswa.konversi-mk.create') }}" class="w-fit px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Mata Kuliah
                </a>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50">
                            <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider py-4 px-6">Kode MK</th>
                            <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider py-4 px-6">Nama Mata Kuliah</th>
                            <th class="text-center text-xs font-semibold text-slate-600 uppercase tracking-wider py-4 px-6">SKS</th>
                            <th class="text-center text-xs font-semibold text-slate-600 uppercase tracking-wider py-4 px-6">Status</th>
                            <th class="text-center text-xs font-semibold text-slate-600 uppercase tracking-wider py-4 px-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        {{-- Row 1 --}}
                        <tr class="hover:bg-slate-50 transition-colors duration-200">
                            <td class="py-4 px-6 font-semibold text-slate-900">IF1234</td>
                            <td class="py-4 px-6 text-slate-700">Magang Industri I</td>
                            <td class="py-4 px-6 text-center font-semibold text-slate-900">4</td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">Terkonversi</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="text-slate-400 hover:text-blue-600 bg-white hover:bg-blue-50 border border-slate-200 hover:border-blue-200 p-2 rounded-lg transition-colors duration-200 shadow-sm" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button class="text-slate-400 hover:text-red-600 bg-white hover:bg-red-50 border border-slate-200 hover:border-red-200 p-2 rounded-lg transition-colors duration-200 shadow-sm" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Row 2 --}}
                        <tr class="hover:bg-slate-50 transition-colors duration-200">
                            <td class="py-4 px-6 font-semibold text-slate-900">IF1235</td>
                            <td class="py-4 px-6 text-slate-700">Magang Industri II</td>
                            <td class="py-4 px-6 text-center font-semibold text-slate-900">4</td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">Terkonversi</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="text-slate-400 hover:text-blue-600 bg-white hover:bg-blue-50 border border-slate-200 hover:border-blue-200 p-2 rounded-lg transition-colors duration-200 shadow-sm" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button class="text-slate-400 hover:text-red-600 bg-white hover:bg-red-50 border border-slate-200 hover:border-red-200 p-2 rounded-lg transition-colors duration-200 shadow-sm" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Row 3 --}}
                        <tr class="hover:bg-slate-50 transition-colors duration-200">
                            <td class="py-4 px-6 font-semibold text-slate-900">IF1236</td>
                            <td class="py-4 px-6 text-slate-700">Praktik Profesional</td>
                            <td class="py-4 px-6 text-center font-semibold text-slate-900">2</td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">Terkonversi</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="text-slate-400 hover:text-blue-600 bg-white hover:bg-blue-50 border border-slate-200 hover:border-blue-200 p-2 rounded-lg transition-colors duration-200 shadow-sm" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button class="text-slate-400 hover:text-red-600 bg-white hover:bg-red-50 border border-slate-200 hover:border-red-200 p-2 rounded-lg transition-colors duration-200 shadow-sm" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex justify-end">
        <button class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-full transition-all duration-200 shadow-md hover:shadow-lg">
            Ajukan Konversi
        </button>
    </div>
@endsection
