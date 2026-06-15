@extends('layouts.dosen-pembimbing')

@section('title', 'Manajemen Bimbingan Mahasiswa')

@section('content')
<div x-data="{ 
        showModal: false, 
        selectedStudent: '', 
        selectedTopic: '', 
        selectedType: 'offline',
        openModal(name, topic, type) {
            this.selectedStudent = name;
            this.selectedTopic = topic;
            this.selectedType = type;
            this.showModal = true;
        }
    }" class="space-y-8 font-['Inter',sans-serif]">
    
    {{-- Header & Quick Stats --}}
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Bimbingan</h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Card 1: Perlu Dijadwalkan --}}
            <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider w-2/3">PERLU DIJADWALKAN</h3>
                    <div class="p-2 bg-amber-50 rounded-lg text-amber-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-1">3</h2>
                    <p class="text-xs text-slate-400">Menunggu penetapan</p>
                </div>
            </div>

            {{-- Card 2: Sesi Mendatang --}}
            <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider w-2/3">SESI MENDATANG</h3>
                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-1">5</h2>
                    <p class="text-xs text-slate-400">Terjadwal</p>
                </div>
            </div>

            {{-- Card 3: Total Selesai --}}
            <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider w-2/3">TOTAL SELESAI</h3>
                    <div class="p-2 bg-emerald-50 rounded-lg text-emerald-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-1">24</h2>
                    <p class="text-xs text-slate-400">Telah selesai</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Section 1: Pengajuan Masuk --}}
    <div>
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-xl font-bold text-slate-900">Permintaan Bimbingan Menunggu Jadwal</h2>
            <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-700 hover:underline">Lihat Semua</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Card Request 1 --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                <div>
                    <div class="flex items-start justify-between mb-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-slate-200 overflow-hidden flex-shrink-0">
                                <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=f1f5f9&color=64748b" alt="Avatar" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Budi Santoso</h3>
                                <p class="text-sm text-slate-500 font-medium">NIM: 201011400123</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-amber-100 text-amber-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span> Menunggu
                        </span>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-5 mb-6 border border-slate-100">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Topik Bimbingan</p>
                                <p class="text-sm font-bold text-slate-800">Pembahasan Bab 1 & 2</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Pelaksanaan</p>
                                <div class="inline-flex items-center gap-1 px-2 py-1.5 rounded-md text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    Online
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button @click="openModal('Budi Santoso', 'Pembahasan Bab 1 & 2', 'online')" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition-colors shadow-sm text-sm flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Tetapkan Jadwal
                </button>
            </div>

            {{-- Card Request 2 --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                <div>
                    <div class="flex items-start justify-between mb-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-slate-200 overflow-hidden flex-shrink-0">
                                <img src="https://ui-avatars.com/api/?name=Siti+Aisyah&background=f1f5f9&color=64748b" alt="Avatar" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Siti Aisyah</h3>
                                <p class="text-sm text-slate-500 font-medium">NIM: 201011400234</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-amber-100 text-amber-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span> Menunggu
                        </span>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-5 mb-6 border border-slate-100">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Topik Bimbingan</p>
                                <p class="text-sm font-bold text-slate-800">Review Laporan Akhir</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Pelaksanaan</p>
                                <div class="inline-flex items-center gap-1 px-2 py-1.5 rounded-md text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Offline
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button @click="openModal('Siti Aisyah', 'Review Laporan Akhir', 'offline')" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition-colors shadow-sm text-sm flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Tetapkan Jadwal
                </button>
            </div>
        </div>
    </div>

    {{-- Section 2: Semua Aktivitas Bimbingan --}}
    <div>
        <h2 class="text-xl font-bold text-slate-900 mb-5">Semua Aktivitas Bimbingan</h2>
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Mahasiswa</th>
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Topik Bimbingan</th>
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Tipe Pelaksanaan</th>
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Jadwal Ditetapkan</th>
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        
                        {{-- Data 1: Terjadwal Online --}}
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900">Ahmad Faisal</div>
                                <div class="text-xs text-slate-500 font-medium">201011400333</div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-semibold text-slate-800">Revisi Metodologi</div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-md text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    Online
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-semibold text-slate-800">10 Jun 2026</div>
                                <div class="text-xs text-slate-500">09:00 WIB</div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-blue-100 text-blue-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span> Terjadwal
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex flex-col sm:flex-row items-center justify-end gap-2 w-full">
                                    <a href="#" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 py-2 px-3 bg-white border border-slate-300 hover:bg-slate-50 hover:text-blue-600 text-slate-700 rounded-lg text-xs font-bold transition-colors shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        Buka Link
                                    </a>
                                    <button class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 py-2 px-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-lg transition-colors text-xs shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Selesaikan Sesi
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Data 2: Selesai Offline --}}
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900">Budi Santoso</div>
                                <div class="text-xs text-slate-500 font-medium">201011400123</div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-semibold text-slate-800">Pendahuluan</div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-md text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Offline
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-semibold text-slate-800">01 Jun 2026</div>
                                <div class="text-xs text-slate-500">10:00 WIB</div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Selesai
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <span class="text-slate-300 font-bold text-sm">-</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            <div class="px-6 py-4 border-t border-slate-200 flex items-center justify-between bg-slate-50">
                <span class="text-sm text-slate-500 font-medium">Menampilkan 1 hingga 2 dari 24 entri</span>
                <div class="flex gap-2">
                    <button class="px-4 py-2 border border-slate-300 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors disabled:opacity-50" disabled>Sebelumnya</button>
                    <button class="px-4 py-2 bg-white border border-slate-300 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-colors shadow-sm">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Penetapan Jadwal --}}
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        {{-- Backdrop --}}
        <div x-show="showModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" 
             @click="showModal = false"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div x-show="showModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-100">
                
                {{-- Modal Header --}}
                <div class="bg-white px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-slate-900" id="modal-title">Tetapkan Jadwal Bimbingan</h3>
                    <button @click="showModal = false" type="button" class="text-slate-400 hover:text-slate-500 bg-slate-50 hover:bg-slate-100 rounded-full p-2 transition-colors">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                {{-- Modal Body --}}
                <div class="px-6 py-5">
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mb-5">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Mahasiswa</p>
                        <p class="text-sm font-semibold text-slate-900 mb-3" x-text="selectedStudent"></p>
                        
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Topik Bimbingan</p>
                        <p class="text-sm font-semibold text-slate-900" x-text="selectedTopic"></p>
                    </div>

                    <form>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Pelaksanaan <span class="text-red-500">*</span></label>
                                <input type="date" min="{{ date('Y-m-d') }}" class="w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 font-medium px-4 py-2.5 text-slate-900 border" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Waktu / Jam <span class="text-red-500">*</span></label>
                                <input type="time" class="w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 font-medium px-4 py-2.5 text-slate-900 border" required>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Modal Footer --}}
                <div class="bg-slate-50 px-6 py-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button @click="showModal = false" type="button" class="px-5 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-700 font-bold text-sm hover:bg-slate-50 transition-colors">Batal</button>
                    <button @click="showModal = false" type="button" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl font-bold text-sm shadow-sm hover:bg-blue-700 transition-colors flex items-center gap-2">
                        Simpan & Konfirmasi Jadwal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
