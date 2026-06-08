@extends('layouts.mahasiswa')

@section('title', 'Uji Kompetensi: Proposal')

@section('content')
<div x-data="{ status: 'draft', tipeUjian: 'offline' }" class="space-y-6 w-full">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-2">Uji Kompetensi: Proposal</h1>
        <p class="text-slate-500 text-lg">Unggah dokumen proposal Anda dan ajukan untuk direview oleh Dosen Penguji.</p>
    </div>

    {{-- Main Status & Action Card (Full Width) --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden w-full">
        {{-- Top Bar: Status Banner --}}
        <div class="p-6 sm:px-8 border-b border-slate-100 bg-slate-50/80 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-bold text-slate-900">Status Pengajuan</h3>
                <p class="text-sm text-slate-500 mt-1">Lacak progres dari dokumen yang Anda ajukan.</p>
            </div>
            <div>
                {{-- Status Badges --}}
                <span x-show="status === 'draft'" class="inline-flex items-center gap-2 bg-slate-200 text-slate-700 text-sm font-bold px-5 py-2.5 rounded-full">
                    <span class="w-2 h-2 rounded-full bg-slate-500"></span> Draft (Belum Diajukan)
                </span>
                <span x-show="status === 'direview'" class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 text-sm font-bold px-5 py-2.5 rounded-full" style="display: none;">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span> Sedang Direview
                </span>
                <span x-show="status === 'perlu_revisi'" class="inline-flex items-center gap-2 bg-amber-100 text-amber-700 text-sm font-bold px-5 py-2.5 rounded-full" style="display: none;">
                    <span class="w-2 h-2 rounded-full bg-amber-600"></span> Perlu Revisi
                </span>
                <span x-show="status === 'disetujui'" class="inline-flex items-center gap-2 bg-green-100 text-green-700 text-sm font-bold px-5 py-2.5 rounded-full" style="display: none;">
                    <span class="w-2 h-2 rounded-full bg-green-600"></span> Disetujui
                </span>
            </div>
        </div>

        {{-- Body: Action Area --}}
        <div class="p-8 sm:p-12">
            <div class="flex flex-col items-center text-center max-w-3xl mx-auto">
                <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h4 class="text-2xl font-extrabold text-slate-900 mb-3">Siap untuk Diajukan?</h4>
                <p class="text-slate-500 text-lg mb-10 leading-relaxed">
                    Pastikan format dokumen Anda sudah sesuai panduan akademik. Dokumen yang telah diajukan akan segera direview dan dinilai oleh dosen penguji terkait.
                </p>

                {{-- Tipe Pelaksanaan --}}
                <div class="w-full max-w-xl mx-auto mb-10 text-left" x-show="status === 'draft'">
                    <p class="block text-sm font-bold text-slate-500 uppercase tracking-widest mb-4 text-center">Pilih Metode Pelaksanaan Ujian <span class="text-red-500">*</span></p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Card Offline --}}
                        <label class="relative group cursor-pointer block w-full">
                            <input type="radio" name="tipe_proposal" value="offline" x-model="tipeUjian" class="peer sr-only">
                            <div class="absolute inset-0 rounded-2xl bg-blue-600 opacity-0 peer-checked:opacity-100 transition-all duration-300 shadow-lg peer-checked:shadow-blue-500/30"></div>
                            <div class="relative flex flex-col items-center justify-center gap-4 p-6 rounded-2xl border-2 border-slate-200 bg-white peer-checked:border-transparent peer-checked:bg-transparent transition-all duration-300 group-hover:border-blue-300">
                                <div class="p-4 rounded-full transition-colors duration-300" :class="tipeUjian === 'offline' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-blue-50 group-hover:text-blue-600'">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <div class="text-center">
                                    <span class="block font-bold text-lg transition-colors duration-300" :class="tipeUjian === 'offline' ? 'text-white' : 'text-slate-900'">Tatap Muka</span>
                                    <span class="block text-sm mt-1 transition-colors duration-300" :class="tipeUjian === 'offline' ? 'text-blue-100' : 'text-slate-500'">Di Ruang Sidang Kampus</span>
                                </div>
                                
                                {{-- Check Icon --}}
                                <div class="absolute top-4 right-4 opacity-0 scale-50 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-300 text-white">
                                    <svg class="w-6 h-6 drop-shadow-md" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </label>

                        {{-- Card Online --}}
                        <label class="relative group cursor-pointer block w-full">
                            <input type="radio" name="tipe_proposal" value="online" x-model="tipeUjian" class="peer sr-only">
                            <div class="absolute inset-0 rounded-2xl bg-emerald-600 opacity-0 peer-checked:opacity-100 transition-all duration-300 shadow-lg peer-checked:shadow-emerald-500/30"></div>
                            <div class="relative flex flex-col items-center justify-center gap-4 p-6 rounded-2xl border-2 border-slate-200 bg-white peer-checked:border-transparent peer-checked:bg-transparent transition-all duration-300 group-hover:border-emerald-300">
                                <div class="p-4 rounded-full transition-colors duration-300" :class="tipeUjian === 'online' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-emerald-50 group-hover:text-emerald-600'">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                </div>
                                <div class="text-center">
                                    <span class="block font-bold text-lg transition-colors duration-300" :class="tipeUjian === 'online' ? 'text-white' : 'text-slate-900'">Daring (Online)</span>
                                    <span class="block text-sm mt-1 transition-colors duration-300" :class="tipeUjian === 'online' ? 'text-emerald-100' : 'text-slate-500'">Via Zoom / Google Meet</span>
                                </div>

                                {{-- Check Icon --}}
                                <div class="absolute top-4 right-4 opacity-0 scale-50 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-300 text-white">
                                    <svg class="w-6 h-6 drop-shadow-md" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <button 
                    @click="status = 'direview'"
                    :disabled="status === 'direview' || status === 'disetujui'"
                    :class="{
                        'bg-blue-600 hover:bg-blue-700 text-white shadow-[0_8px_30px_rgb(37,99,235,0.2)] hover:shadow-[0_8px_30px_rgb(37,99,235,0.4)] hover:-translate-y-1': status !== 'direview' && status !== 'disetujui',
                        'bg-slate-200 text-slate-500 cursor-not-allowed': status === 'direview' || status === 'disetujui'
                    }"
                    class="px-10 py-4 rounded-full font-bold text-lg transition-all duration-300 flex items-center justify-center gap-3 w-full sm:w-auto">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    <span x-text="status === 'direview' ? 'Pengajuan Sedang Diproses' : (status === 'disetujui' ? 'Proposal Telah Disetujui' : 'Ajukan Proposal Sekarang')"></span>
                </button>
            </div>
        </div>
    </div>

    {{-- Revisi Note (Full Width) --}}
    <div x-show="status === 'perlu_revisi'" x-transition class="bg-amber-50 border-l-4 border-amber-500 rounded-r-2xl p-6 sm:p-8 shadow-sm w-full" style="display: none;">
        <div class="flex items-start gap-5">
            <div class="bg-amber-100 p-3 rounded-full mt-1 flex-shrink-0">
                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-xl font-bold text-amber-900 mb-1">Catatan Revisi Dosen Penguji</h4>
                <p class="text-sm font-semibold text-amber-700 mb-3 tracking-wide">Bpk. Hendra Saputra &bull; 26 Maret 2026</p>
                <div class="bg-white/60 rounded-xl p-4 border border-amber-200">
                    <p class="text-amber-900 leading-relaxed text-base">
                        Bagian latar belakang perlu diperjelas kaitannya dengan proyek MBKM di tempat magang. Tolong sertakan data pendukung yang lebih valid sebelum diajukan kembali.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Helper Card --}}
    <div class="bg-blue-50/60 rounded-2xl p-6 sm:p-8 border border-blue-100 w-full mt-4">
        <div class="flex items-start gap-5">
            <div class="bg-blue-100 p-3 rounded-full mt-1 flex-shrink-0">
                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-lg font-bold text-blue-900 mb-2">Informasi Penting</h4>
                <p class="text-blue-800 text-base leading-relaxed">
                    Pastikan format dokumen telah disesuaikan dengan template terbaru dari program studi. Apabila dokumen sudah disetujui, Anda tidak dapat melakukan perubahan lagi kecuali statusnya diubah menjadi "Perlu Revisi" oleh penguji.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
