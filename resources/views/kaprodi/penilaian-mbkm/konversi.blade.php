@extends('layouts.kaprodi')

@section('title', 'Konversi Matakuliah - Kaprodi Panel')

@section('content')
<div class="min-h-screen pb-12" x-data="{ showConfirmModal: false, studentToAcc: '' }">
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Konversi Matakuliah</h1>
        </div>
        <p class="text-slate-600 text-lg">Kelola pemetaan dan konversi SKS kegiatan MBKM mahasiswa</p>
    </div>

    {{-- Main Content Container --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden relative">
        {{-- Action Bar --}}
        <div class="p-6 border-b border-slate-100 bg-white">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                {{-- Search --}}
                <div class="relative w-full sm:w-96">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" class="block w-full pl-10 pr-3 py-2.5 border-none rounded-lg leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-sm font-medium" placeholder="Cari nama atau NIM mahasiswa...">
                </div>

                {{-- Status Filters --}}
                <div class="flex items-center gap-3 w-full sm:w-auto overflow-x-auto pb-2 sm:pb-0">
                    <div class="relative w-44 flex-shrink-0">
                        <select class="block w-full pl-4 pr-10 py-2.5 border-none rounded-lg leading-5 bg-slate-50 text-slate-700 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-sm appearance-none">
                            <option>Semua Status</option>
                            <option>Menunggu ACC</option>
                            <option>Telah Di-ACC</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            NIM & NAMA MAHASISWA
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            USULAN MATA KULIAH
                        </th>
                        <th scope="col" class="px-8 py-5 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">
                            STATUS
                        </th>
                        <th scope="col" class="px-8 py-5 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">
                            AKSI
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    
                    {{-- Row 1: Menunggu ACC --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="text-[13px] font-medium text-slate-500 mb-1">190123459</div>
                            <div class="text-sm font-bold text-blue-700 leading-tight">Dimas Pratama</div>
                        </td>
                        <td class="px-8 py-6">
                            <ul class="text-sm font-medium text-slate-700 list-disc list-inside space-y-1">
                                <li>Praktik Kerja Lapangan (3 SKS)</li>
                                <li>Pengembangan Perangkat Lunak (3 SKS)</li>
                                <li>Kapita Selekta (2 SKS)</li>
                            </ul>
                        </td>
                        <td class="px-8 py-6 text-center whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-600">
                                Menunggu ACC
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-right">
                            <button @click="studentToAcc = 'Dimas Pratama'; showConfirmModal = true" class="inline-flex items-center px-5 py-2 rounded-lg text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white transition-colors shadow-sm gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                ACC Mata Kuliah
                            </button>
                        </td>
                    </tr>

                    {{-- Row 2: Menunggu ACC --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="text-[13px] font-medium text-slate-500 mb-1">190123458</div>
                            <div class="text-sm font-bold text-blue-700 leading-tight">Citra Dewi</div>
                        </td>
                        <td class="px-8 py-6">
                            <ul class="text-sm font-medium text-slate-700 list-disc list-inside space-y-1">
                                <li>Kerja Praktik (4 SKS)</li>
                                <li>Proyek Mandiri (4 SKS)</li>
                            </ul>
                        </td>
                        <td class="px-8 py-6 text-center whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-600">
                                Menunggu ACC
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-right">
                            <button @click="studentToAcc = 'Citra Dewi'; showConfirmModal = true" class="inline-flex items-center px-5 py-2 rounded-lg text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white transition-colors shadow-sm gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                ACC Mata Kuliah
                            </button>
                        </td>
                    </tr>

                    {{-- Row 3: Telah Di-ACC --}}
                    <tr class="hover:bg-slate-50 transition-colors bg-slate-50/30">
                        <td class="px-8 py-6">
                            <div class="text-[13px] font-medium text-slate-500 mb-1">190123456</div>
                            <div class="text-sm font-bold text-slate-600 leading-tight">Anisa Rahmawati</div>
                        </td>
                        <td class="px-8 py-6">
                            <ul class="text-sm font-medium text-slate-500 list-disc list-inside space-y-1">
                                <li>Praktik Kerja Lapangan (3 SKS)</li>
                                <li>Proyek Mandiri (3 SKS)</li>
                            </ul>
                        </td>
                        <td class="px-8 py-6 text-center whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700">
                                Telah Di-ACC
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-right">
                            <span class="inline-flex items-center justify-end text-sm font-bold text-green-600 gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Disetujui
                            </span>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        
        {{-- Pagination Placeholder --}}
        <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-center bg-white">
            <p class="text-xs text-slate-500 font-medium">Menampilkan 3 dari 124 usulan (scroll untuk melihat lebih banyak)</p>
        </div>

        {{-- Alpine Modal Konfirmasi ACC --}}
        <div x-show="showConfirmModal" 
             style="display: none;" 
             class="fixed inset-0 z-50 flex items-center justify-center">
             
            {{-- Backdrop --}}
            <div x-show="showConfirmModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm"
                 @click="showConfirmModal = false"></div>

            {{-- Modal Box --}}
            <div x-show="showConfirmModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative z-10 transform overflow-hidden text-center">
                
                {{-- Success Icon --}}
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-50 mb-5">
                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                
                <h3 class="text-xl font-extrabold text-slate-900 mb-2">Konfirmasi Pengesahan</h3>
                <p class="text-sm text-slate-500 mb-6 leading-relaxed">
                    Apakah Anda yakin ingin menyetujui (ACC) usulan mata kuliah konversi untuk mahasiswa <strong class="text-slate-700" x-text="studentToAcc"></strong>?
                </p>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="button" @click="showConfirmModal = false" class="w-full inline-flex justify-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 hover:bg-slate-50 transition-colors focus:outline-none">
                        Batal
                    </button>
                    <button type="button" @click="showConfirmModal = false" class="w-full inline-flex justify-center rounded-xl border border-transparent bg-blue-600 px-4 py-2.5 text-sm font-bold text-white hover:bg-blue-700 transition-colors focus:outline-none shadow-sm">
                        Ya, ACC Matakuliah
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
