@extends('layouts.dosen-penguji')

@section('title', 'Review Proposal')

@section('content')
<div x-data="{ 
        showModal: false,
        selectedId: null,
        selectedStudent: '',
        selectedTipe: '',
        selectedFile: '',
        reviewStatus: '',
        openModal(id, name, tipe, file) {
            this.selectedId = id;
            this.selectedStudent = name;
            this.selectedTipe = tipe;
            this.selectedFile = file;
            this.reviewStatus = '';
            this.showModal = true;
        }
    }" class="space-y-8 font-['Inter',sans-serif]">
    
    {{-- Flash Message --}}
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 rounded-xl px-5 py-4 flex items-center gap-3">
        <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <p class="text-green-800 font-semibold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    <div class="mb-8">
        <div class="flex items-center gap-2 text-sm text-slate-500 font-medium mb-4">
            <a href="#" class="hover:text-blue-600 transition-colors">Uji Kompetensi</a>
            <span>/</span>
            <span class="text-slate-800 font-bold">Proposal</span>
        </div>
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Review Proposal Mahasiswa</h1>
        </div>
        <p class="text-slate-500">Validasi dokumen proposal dan atur jadwal ujian.</p>
    </div>

    {{-- Section: Menunggu Review --}}
    <div>
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                Menunggu Review
                <span class="bg-amber-100 text-amber-700 text-xs py-0.5 px-2 rounded-full font-bold">{{ $menungguReview->count() }}</span>
            </h2>
        </div>
        
        @if($menungguReview->isEmpty())
        <div class="bg-white rounded-2xl p-10 shadow-sm border border-slate-200 text-center">
            <div class="flex flex-col items-center gap-3">
                <div class="w-14 h-14 bg-green-50 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="font-bold text-slate-700">Tidak ada proposal yang perlu direview</p>
                <p class="text-sm text-slate-400">Semua proposal mahasiswa telah diproses.</p>
            </div>
        </div>
        @else
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
            @foreach($menungguReview as $ujian)
            @php
                $mahasiswa = $ujian->pendaftaranMbkm?->mahasiswa;
                $namaUser  = $mahasiswa?->user?->name ?? 'Unknown';
                $nim       = $mahasiswa?->nim ?? '-';
                $dokumen   = $ujian->pendaftaranMbkm?->dokumenMbkms->first();
                $fileUrl   = $dokumen && $dokumen->file_path ? Storage::url($dokumen->file_path) : null;
                $encodedName = urlencode($namaUser);
            @endphp
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                <div>
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-slate-200 overflow-hidden flex-shrink-0">
                                <img src="https://ui-avatars.com/api/?name={{ $encodedName }}&background=f1f5f9&color=64748b" alt="Avatar" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">{{ $namaUser }}</h3>
                                <p class="text-sm text-slate-500 font-medium">NIM: {{ $nim }}</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-amber-100 text-amber-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span> Menunggu
                        </span>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-5 mb-6 border border-slate-100 flex items-center justify-between gap-4">
                        @if($fileUrl)
                        <a href="{{ $fileUrl }}" target="_blank" class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:text-blue-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            File Proposal
                        </a>
                        @else
                        <span class="inline-flex items-center gap-2 text-sm font-medium text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Tanpa File
                        </span>
                        @endif
                        <div class="text-right">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Pelaksanaan</p>
                            @if($ujian->tipe_ujian === 'online')
                            <div class="inline-flex items-center gap-1 px-2 py-1.5 rounded-md text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                Online
                            </div>
                            @else
                            <div class="inline-flex items-center gap-1 px-2 py-1.5 rounded-md text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Offline
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <button @click="openModal({{ $ujian->id }}, @js($namaUser), @js($ujian->tipe_ujian), @js($fileUrl ?? ''))"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition-colors shadow-sm text-sm flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Validasi & Atur Jadwal
                </button>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Tabel Monitoring --}}
    <div>
        <h2 class="text-xl font-bold text-slate-900 mb-5">Monitoring Jadwal Ujian Proposal</h2>
        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Mahasiswa</th>
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Tipe Pelaksanaan</th>
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Jadwal Ujian</th>
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($monitoring as $ujian)
                        @php
                            $mahasiswa = $ujian->pendaftaranMbkm?->mahasiswa;
                            $namaUser  = $mahasiswa?->user?->name ?? 'Unknown';
                            $nim       = $mahasiswa?->nim ?? '-';
                            $dokumen   = $ujian->pendaftaranMbkm?->dokumenMbkms->first();
                            $fileUrl   = $dokumen && $dokumen->file_path ? Storage::url($dokumen->file_path) : null;
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900">{{ $namaUser }}</div>
                                <div class="text-xs text-slate-500 font-medium">{{ $nim }}</div>
                            </td>
                            <td class="py-4 px-6">
                                @if($ujian->tipe_ujian === 'online')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-md text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    Online
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-md text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Offline
                                </span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                @if($ujian->tgl_ujian)
                                <div class="font-semibold text-slate-800">{{ \Carbon\Carbon::parse($ujian->tgl_ujian)->translatedFormat('d M Y') }}</div>
                                @else
                                <span class="text-slate-400 text-xs">Belum dijadwalkan</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                @if($ujian->status === 'disetujui')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-blue-100 text-blue-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span> Terjadwal
                                </span>
                                @elseif($ujian->status === 'selesai')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-emerald-100 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Selesai
                                </span>
                                @elseif($ujian->status === 'revisi')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-amber-100 text-amber-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span> Perlu Revisi
                                </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex flex-col sm:flex-row items-center justify-end gap-2 w-full">
                                    @if($ujian->tipe_ujian === 'online' && $ujian->link_daring)
                                    <a href="{{ $ujian->link_daring }}" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 py-2 px-3 bg-white border border-slate-300 hover:bg-slate-50 hover:text-blue-600 text-slate-700 rounded-lg text-xs font-bold transition-colors shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        Buka Link
                                    </a>
                                    @endif
                                    @if($ujian->status === 'disetujui')
                                    <form action="{{ route('dosen-penguji.uji-kompetensi.proposal.selesaikan', $ujian->id) }}" method="POST" class="w-full sm:w-auto"
                                          onsubmit="return confirm('Tandai ujian {{ $namaUser }} sebagai selesai?')">
                                        @csrf
                                        <button type="submit" class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-lg transition-colors text-xs shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Selesaikan Ujian
                                        </button>
                                    </form>
                                    @else
                                    <span class="text-slate-300 font-bold text-sm">-</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                    <p class="font-medium">Belum ada data monitoring.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-slate-200 flex items-center justify-between bg-slate-50">
                <span class="text-sm text-slate-500 font-medium">Total: {{ $monitoring->count() }} entri</span>
            </div>
        </div>
    </div>

    {{-- Modal Validasi & Penjadwalan --}}
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
                    <div>
                        <h3 class="text-xl font-bold text-slate-900" id="modal-title">Validasi & Atur Jadwal Ujian</h3>
                        <p class="text-sm text-slate-500 mt-0.5" x-text="selectedStudent"></p>
                    </div>
                    <button @click="showModal = false" type="button" class="text-slate-400 hover:text-slate-500 bg-slate-50 hover:bg-slate-100 rounded-full p-2 transition-colors">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                {{-- Modal Body --}}
                <div class="px-6 py-5">
                    {{-- Link file jika ada --}}
                    <template x-if="selectedFile">
                        <div class="mb-5 p-3 bg-blue-50 border border-blue-100 rounded-xl flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                            <a :href="selectedFile" target="_blank" class="text-sm font-bold text-blue-600 hover:underline">Lihat File Proposal</a>
                        </div>
                    </template>

                    {{-- Form dengan action dinamis --}}
                    <form :action="`/dosen-penguji/uji-kompetensi/proposal/${selectedId}/validasi`" method="POST" id="form-validasi">
                        @csrf
                        <label class="block text-sm font-bold text-slate-700 mb-3">Status Validasi <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-2 gap-3 mb-6">
                            <label class="relative flex items-center justify-center gap-2 p-3 border-2 rounded-xl cursor-pointer transition-all"
                                :class="reviewStatus === 'setuju' ? 'border-blue-500 bg-blue-50 text-blue-700' : 'border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-600'">
                                <input type="radio" name="keputusan" value="setuju" x-model="reviewStatus" class="sr-only">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="font-bold text-sm">Setuju & Lanjut</span>
                            </label>
                            
                            <label class="relative flex items-center justify-center gap-2 p-3 border-2 rounded-xl cursor-pointer transition-all"
                                :class="reviewStatus === 'revisi' ? 'border-rose-500 bg-rose-50 text-rose-700' : 'border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-600'">
                                <input type="radio" name="keputusan" value="revisi" x-model="reviewStatus" class="sr-only">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="font-bold text-sm">Perlu Revisi</span>
                            </label>
                        </div>

                        {{-- Form Jika Revisi --}}
                        <div x-show="reviewStatus === 'revisi'" x-collapse style="display: none;">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Catatan Revisi <span class="text-red-500">*</span></label>
                            <textarea name="catatan_revisi" rows="4" placeholder="Jelaskan bagian mana yang perlu diperbaiki..." class="w-full border-slate-300 rounded-xl shadow-sm focus:border-rose-500 focus:ring-rose-500 p-3 text-slate-900 border text-sm"></textarea>
                        </div>

                        {{-- Form Jika Setuju --}}
                        <div x-show="reviewStatus === 'setuju'" x-collapse style="display: none;">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Ujian <span class="text-red-500">*</span></label>
                                    <input type="date" name="tgl_ujian" min="{{ date('Y-m-d') }}" class="w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 font-medium px-4 py-2.5 text-slate-900 border">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Waktu / Jam <span class="text-red-500">*</span></label>
                                    <input type="time" name="jam_ujian" class="w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 font-medium px-4 py-2.5 text-slate-900 border">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Modal Footer --}}
                <div class="bg-slate-50 px-6 py-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button @click="showModal = false" type="button" class="px-5 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-700 font-bold text-sm hover:bg-slate-50 transition-colors">Batal</button>
                    <button type="submit" form="form-validasi"
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
