@extends('layouts.dosen-penguji')

@section('title', 'Manajemen Uji Kompetensi')

@section('content')
<div x-data="{ 
        activeTab: 'proposal',
        showModal: false,
        selectedStudent: '',
        selectedTopic: '',
        reviewStatus: '',
        openModal(name, topic) {
            this.selectedStudent = name;
            this.selectedTopic = topic;
            this.reviewStatus = '';
            this.showModal = true;
        }
    }" class="space-y-8 font-['Inter',sans-serif]">
    
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Uji Kompetensi Mahasiswa</h1>
        </div>
        <p class="text-slate-500">Validasi dokumen dan atur jadwal ujian mahasiswa.</p>
    </div>

    {{-- Tabs --}}
    <div class="border-b border-slate-200 mb-6">
        <nav class="-mb-px flex space-x-8">
            <button @click="activeTab = 'proposal'" 
                :class="activeTab === 'proposal' ? 'border-blue-500 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'"
                class="whitespace-nowrap pb-4 px-1 border-b-2 font-bold text-sm transition-colors">
                Review Proposal
            </button>
            <button @click="activeTab = 'laporan'" 
                :class="activeTab === 'laporan' ? 'border-blue-500 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'"
                class="whitespace-nowrap pb-4 px-1 border-b-2 font-bold text-sm transition-colors">
                Review Laporan Akhir
            </button>
        </nav>
    </div>

    {{-- Tab Content: Proposal --}}
    <div x-show="activeTab === 'proposal'">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-xl font-bold text-slate-900">Menunggu Review Proposal</h2>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
            {{-- Card Request --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                <div>
                    <div class="flex items-start justify-between mb-4">
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
                        
                        <a href="#" target="_blank" class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:text-blue-700 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Lihat Dokumen Proposal (PDF)
                        </a>
                    </div>
                </div>

                <button @click="openModal('Budi Santoso', 'Sistem Informasi Manajemen MBKM')" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition-colors shadow-sm text-sm flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Validasi & Atur Jadwal
                </button>
            </div>
        </div>
    </div>

    {{-- Tab Content: Laporan Akhir --}}
    <div x-show="activeTab === 'laporan'" style="display: none;">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-xl font-bold text-slate-900">Menunggu Review Laporan Akhir</h2>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
            {{-- Card Request --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                <div>
                    <div class="flex items-start justify-between mb-4">
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
                        
                        <a href="#" target="_blank" class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:text-blue-700 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Lihat Dokumen Laporan (PDF)
                        </a>
                    </div>
                </div>

                <button @click="openModal('Siti Aisyah', 'Implementasi UI/UX Modern')" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition-colors shadow-sm text-sm flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Validasi & Atur Jadwal
                </button>
            </div>
        </div>
    </div>

    {{-- Tabel Monitoring Mahasiswa Ujian --}}
    <div>
        <h2 class="text-xl font-bold text-slate-900 mb-5">Monitoring Mahasiswa Ujian</h2>
        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Mahasiswa</th>
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Tahapan</th>
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Jadwal Ujian</th>
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        
                        {{-- Data 1: Terjadwal --}}
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900">Ahmad Faisal</div>
                                <div class="text-xs text-slate-500 font-medium">201011400333</div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                    Proposal
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
                                <button class="inline-flex items-center justify-center gap-1.5 py-2 px-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-lg transition-colors text-xs shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Selesaikan Ujian
                                </button>
                            </td>
                        </tr>

                        {{-- Data 2: Menunggu Review --}}
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900">Budi Santoso</div>
                                <div class="text-xs text-slate-500 font-medium">201011400123</div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                    Proposal
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="text-slate-400 font-medium text-xs italic">Belum Ditetapkan</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-amber-100 text-amber-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span> Menunggu Review
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <span class="text-slate-300 font-bold text-sm">-</span>
                            </td>
                        </tr>

                        {{-- Data 3: Lulus --}}
                        <tr class="hover:bg-slate-50 transition-colors opacity-80">
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900">Diana Putri</div>
                                <div class="text-xs text-slate-500 font-medium">201011400555</div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-fuchsia-50 text-fuchsia-700 border border-fuchsia-100">
                                    Laporan Akhir
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-semibold text-slate-800">01 Jun 2026</div>
                                <div class="text-xs text-slate-500">10:00 WIB</div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Lulus
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <span class="text-slate-300 font-bold text-sm">-</span>
                            </td>
                        </tr>

                        {{-- Data 4: Revisi --}}
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900">Rizky Pratama</div>
                                <div class="text-xs text-slate-500 font-medium">201011400666</div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                    Proposal
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="text-slate-400 font-medium text-xs italic">Menunggu Perbaikan</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-rose-100 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-600"></span> Perlu Revisi
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
                <span class="text-sm text-slate-500 font-medium">Menampilkan 1 hingga 4 dari 24 entri</span>
                <div class="flex gap-2">
                    <button class="px-4 py-2 border border-slate-300 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors disabled:opacity-50" disabled>Sebelumnya</button>
                    <button class="px-4 py-2 bg-white border border-slate-300 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-colors shadow-sm">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Validasi & Penjadwalan --}}
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
                    <h3 class="text-xl font-bold text-slate-900" id="modal-title">Validasi & Atur Jadwal Ujian</h3>
                    <button @click="showModal = false" type="button" class="text-slate-400 hover:text-slate-500 bg-slate-50 hover:bg-slate-100 rounded-full p-2 transition-colors">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                {{-- Modal Body --}}
                <div class="px-6 py-5">
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mb-6">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Mahasiswa</p>
                        <p class="text-sm font-semibold text-slate-900 mb-3" x-text="selectedStudent"></p>
                        
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Topik/Judul</p>
                        <p class="text-sm font-semibold text-slate-900" x-text="selectedTopic"></p>
                    </div>

                    <form>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Status Validasi <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-2 gap-3 mb-6">
                            <label class="relative flex items-center justify-center gap-2 p-3 border-2 rounded-xl cursor-pointer transition-all"
                                :class="reviewStatus === 'setuju' ? 'border-blue-500 bg-blue-50 text-blue-700' : 'border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-600'">
                                <input type="radio" name="status" value="setuju" x-model="reviewStatus" class="sr-only">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="font-bold text-sm">Setuju & Lanjut</span>
                            </label>
                            
                            <label class="relative flex items-center justify-center gap-2 p-3 border-2 rounded-xl cursor-pointer transition-all"
                                :class="reviewStatus === 'revisi' ? 'border-rose-500 bg-rose-50 text-rose-700' : 'border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-600'">
                                <input type="radio" name="status" value="revisi" x-model="reviewStatus" class="sr-only">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="font-bold text-sm">Perlu Revisi</span>
                            </label>
                        </div>

                        {{-- Form Jika Revisi --}}
                        <div x-show="reviewStatus === 'revisi'" x-collapse style="display: none;">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Catatan Revisi <span class="text-red-500">*</span></label>
                            <textarea rows="4" placeholder="Jelaskan bagian mana yang perlu diperbaiki..." class="w-full border-slate-300 rounded-xl shadow-sm focus:border-rose-500 focus:ring-rose-500 p-3 text-slate-900 border text-sm"></textarea>
                        </div>

                        {{-- Form Jika Setuju --}}
                        <div x-show="reviewStatus === 'setuju'" x-collapse style="display: none;">
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Ujian <span class="text-red-500">*</span></label>
                                    <input type="date" min="{{ date('Y-m-d') }}" class="w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 font-medium px-4 py-2.5 text-slate-900 border">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Waktu / Jam <span class="text-red-500">*</span></label>
                                    <input type="time" class="w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 font-medium px-4 py-2.5 text-slate-900 border">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Ruangan / Link Meeting <span class="text-red-500">*</span></label>
                                <input type="text" placeholder="Contoh: Ruang Rapat Lt.2 / Link Zoom" class="w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 text-slate-900 border text-sm">
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Modal Footer --}}
                <div class="bg-slate-50 px-6 py-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button @click="showModal = false" type="button" class="px-5 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-700 font-bold text-sm hover:bg-slate-50 transition-colors">Batal</button>
                    <button @click="showModal = false" type="button" 
                        :class="reviewStatus ? 'bg-blue-600 hover:bg-blue-700 shadow-sm' : 'bg-blue-300 cursor-not-allowed'"
                        :disabled="!reviewStatus"
                        class="px-5 py-2.5 text-white rounded-xl font-bold text-sm transition-colors">
                        Simpan Keputusan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
