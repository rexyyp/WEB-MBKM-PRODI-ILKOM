@extends('layouts.dosen-penguji')

@section('title', 'Penilaian Mahasiswa')

@section('content')
<div x-data="{ 
        showModal: false,
        selectedId: null,
        selectedStudent: '',
        selectedNim: '',
        nilai: '',
        openModal(id, name, nim, existingNilai) {
            this.selectedId = id;
            this.selectedStudent = name;
            this.selectedNim = nim;
            this.nilai = existingNilai;
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

    {{-- Header --}}
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-sm text-slate-500 font-medium mb-4">
                    <a href="#" class="hover:text-blue-600 transition-colors">MBKM</a>
                    <span>/</span>
                    <span class="text-slate-800 font-bold">Penilaian</span>
                </div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                    </div>
                    <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Penilaian Mahasiswa</h1>
                </div>
                <p class="text-slate-500">Beri nilai akademik untuk mahasiswa yang menjadi tanggung jawab Anda.</p>
            </div>
            
            {{-- Search Box --}}
            <form action="{{ route('dosen-penguji.penilaian.index') }}" method="GET" class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau NIM..." 
                       class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all shadow-sm">
                <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </form>
        </div>
    </div>

    {{-- Tabel Mahasiswa --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Mahasiswa</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Program MBKM</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Status Nilai</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($pendaftarans as $pendaftaran)
                    @php
                        $mahasiswa = $pendaftaran->mahasiswa;
                        $namaUser  = $mahasiswa?->user?->name ?? 'Unknown';
                        $nim       = $mahasiswa?->nim ?? '-';
                        $program   = $pendaftaran->programMbkm?->nama ?? '-';
                        $mitra     = $pendaftaran->mitraMbkm?->nama ?? '-';
                        
                        $nilaiObj = $pendaftaran->penilaians->first();
                        $sudahDinilai = $nilaiObj !== null;
                        $nilaiAngka = $sudahDinilai ? $nilaiObj->nilai_total : '';
                    @endphp
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900">{{ $namaUser }}</div>
                            <div class="text-xs text-slate-500 font-medium mt-0.5">{{ $nim }}</div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="font-medium text-slate-800">{{ $program }}</div>
                            <div class="text-xs text-slate-500 mt-0.5">{{ $mitra }}</div>
                        </td>
                        <td class="py-4 px-6">
                            @if($sudahDinilai)
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-green-50 border border-green-100 text-green-700">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Nilai: {{ $nilaiAngka }}
                            </div>
                            @else
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-amber-50 border border-amber-100 text-amber-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Belum Dinilai
                            </div>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-right">
                            <button @click="openModal({{ $pendaftaran->id }}, @js($namaUser), @js($nim), @js($nilaiAngka))"
                                class="inline-flex items-center gap-1.5 py-2 px-4 {{ $sudahDinilai ? 'bg-white border-slate-300 text-slate-700 hover:bg-slate-50' : 'bg-blue-600 text-white border-transparent hover:bg-blue-700' }} border font-bold rounded-lg transition-colors text-xs shadow-sm">
                                @if($sudahDinilai)
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    Ubah Nilai
                                @else
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                    Beri Nilai
                                @endif
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center text-slate-400">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                <p class="font-medium">Belum ada mahasiswa yang ditugaskan kepada Anda.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($pendaftarans->hasPages())
        <div class="px-6 py-4 border-t border-slate-200">
            {{ $pendaftarans->links() }}
        </div>
        @endif
    </div>

    {{-- Modal Input Nilai --}}
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
                <div class="bg-slate-50 px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">Beri Nilai Akademik</h3>
                        <p class="text-sm text-slate-500 mt-0.5" x-text="`${selectedStudent} (${selectedNim})`"></p>
                    </div>
                    <button @click="showModal = false" type="button" class="text-slate-400 hover:text-slate-500 bg-white shadow-sm border border-slate-200 hover:bg-slate-100 rounded-full p-2 transition-colors">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                {{-- Form Content --}}
                <form :action="`/dosen-penguji/penilaian/${selectedId}`" method="POST">
                    @csrf
                    <div class="px-6 py-6">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nilai Penguji (0 - 100) <span class="text-rose-500">*</span></label>
                        <p class="text-xs text-slate-500 mb-4 leading-relaxed">Nilai ini akan diakumulasikan dengan nilai dari Pembimbing dan Mitra oleh Koordinator Program Studi untuk menjadi Nilai Akhir mahasiswa.</p>
                        
                        <div class="relative max-w-xs">
                            <input type="number" name="nilai_penguji" x-model="nilai" min="0" max="100" step="0.01" required
                                class="w-full border-slate-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 p-4 text-slate-900 border font-bold text-lg"
                                placeholder="Contoh: 85.5">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <span class="text-slate-400 font-bold">/ 100</span>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Footer --}}
                    <div class="bg-slate-50 px-6 py-4 flex flex-col-reverse sm:flex-row items-center justify-end gap-3 border-t border-slate-100">
                        <button type="button" @click="showModal = false" class="w-full sm:w-auto inline-flex justify-center items-center gap-1.5 px-4 py-2.5 bg-white border border-slate-300 text-slate-700 font-bold text-sm rounded-lg hover:bg-slate-50 transition-colors shadow-sm">
                            Batal
                        </button>
                        <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center gap-1.5 px-4 py-2.5 bg-blue-600 border border-transparent text-white font-bold text-sm rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Simpan Nilai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
