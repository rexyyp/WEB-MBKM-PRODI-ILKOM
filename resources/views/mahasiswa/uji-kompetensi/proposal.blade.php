@extends('layouts.mahasiswa')

@section('title', 'Uji Kompetensi: Proposal')

@section('content')
@php
    $status = $pengajuan?->status ?? 'draft';
    $tipeUjian = $pengajuan?->tipe_ujian ?? 'offline';
    $linkDaring = $pengajuan?->link_daring ?? '';
    $catatanRevisi = $pengajuan?->catatan_revisi ?? '';
    $penguji = $pengajuan?->dosenPenguji?->user?->name ?? '-';
    $tglRevisi = $pengajuan?->updated_at ? $pengajuan->updated_at->translatedFormat('d F Y') : '-';
@endphp
<div x-data="{ 
    status: '{{ $status }}',
    tipeUjian: '{{ $tipeUjian }}',
    showModal: false,
    modalTitle: '',
    modalCatatan: '',
    openCatatan(title, catatan) {
        this.modalTitle = title;
        this.modalCatatan = catatan;
        this.showModal = true;
    }
}" class="w-full">
    {{-- Header --}}
    <div class="mb-8 animate-fade-in-up">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="bg-blue-50 border border-blue-100 p-3.5 rounded-2xl text-blue-600 shadow-sm shrink-0">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Uji Kompetensi: Proposal</h1>
                    <p class="text-slate-500 mt-1 font-medium mb-3">Unggah dokumen proposal Anda dan ajukan untuk direview oleh Dosen Penguji.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash Messages (jika ada error saat submit) --}}
    @if(session('error'))
        <div class="bg-white border-l-4 border-red-500 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-8 animate-fade-in-up">
            <div class="bg-red-50 p-2.5 rounded-xl text-red-600 flex-shrink-0 mt-0.5 border border-red-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <p class="text-red-800 font-bold text-sm">{{ session('error') }}</p>
            </div>
        </div>
    @endif
    @if(session('success'))
        <div class="bg-white border-l-4 border-green-500 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-8 animate-fade-in-up">
            <div class="bg-green-50 p-2.5 rounded-xl text-green-600 flex-shrink-0 mt-0.5 border border-green-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-slate-800 font-bold text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    {{-- ═══ CARD PRASYARAT ═══ --}}
    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden w-full mb-8
        {{ $bolehAjukan ? 'border-green-200' : 'border-amber-200' }}">
        <div class="px-8 py-5 border-b flex items-center justify-between
            {{ $bolehAjukan ? 'bg-green-50/50 border-green-100' : 'bg-amber-50/50 border-amber-100' }}">
            <div class="flex items-center gap-3">
                @if($bolehAjukan)
                    <div class="bg-green-100 p-2 rounded-xl text-green-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="font-bold text-green-800 text-sm">Semua prasyarat terpenuhi — Anda bisa mengajukan</span>
                @else
                    <div class="bg-amber-100 p-2 rounded-xl text-amber-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="font-bold text-amber-800 text-sm">Lengkapi prasyarat berikut sebelum mengajukan</span>
                @endif
            </div>
        </div>
        <div class="p-6 space-y-4">
            {{-- Prasyarat 1: Dokumen Proposal MBKM --}}
            <div class="flex items-center justify-between p-5 rounded-2xl border
                {{ $sudahUploadProposal ? 'bg-white border-green-200 hover:border-green-300' : 'bg-white border-red-200 hover:border-red-300' }} transition-colors">
                <div class="flex items-center gap-4">
                    @if($sudahUploadProposal)
                        <div class="w-12 h-12 rounded-xl bg-green-50 border border-green-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-base text-slate-800 mb-0.5">Dokumen Proposal MBKM</p>
                            <p class="text-sm font-medium text-slate-500">Diupload: <span class="text-green-600 font-bold">{{ $dokumenProposal->uploaded_at ? \Carbon\Carbon::parse($dokumenProposal->uploaded_at)->translatedFormat('d M Y') : '-' }}</span></p>
                        </div>
                    @else
                        <div class="w-12 h-12 rounded-xl bg-red-50 border border-red-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-base text-slate-800 mb-0.5">Dokumen Proposal MBKM</p>
                            <p class="text-sm font-medium text-red-500">Belum diupload — wajib ada sebelum mengajukan</p>
                        </div>
                    @endif
                </div>
                @if(!$sudahUploadProposal)
                    <a href="{{ route('mahasiswa.dokumen.index') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold bg-red-50 text-red-700 border border-red-200 hover:bg-red-100 transition-colors flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        Upload Sekarang
                    </a>
                @endif
            </div>

            {{-- Prasyarat 2: Dosen Penguji Sudah Di-assign --}}
            <div class="flex items-center justify-between p-5 rounded-2xl border
                {{ $sudahAssignPenguji ? 'bg-white border-green-200 hover:border-green-300' : 'bg-white border-slate-200 hover:border-slate-300' }} transition-colors">
                <div class="flex items-center gap-4">
                    @if($sudahAssignPenguji)
                        <div class="w-12 h-12 rounded-xl bg-green-50 border border-green-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-base text-slate-800 mb-0.5">Dosen Penguji</p>
                            <p class="text-sm font-bold text-slate-600">{{ $pendaftaran->dosenPenguji?->user?->name ?? '-' }}</p>
                        </div>
                    @else
                        <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-base text-slate-800 mb-0.5">Dosen Penguji</p>
                            <p class="text-sm font-medium text-slate-500">Menunggu penugasan dari Koordinator Prodi</p>
                        </div>
                    @endif
                </div>
                @if(!$sudahAssignPenguji)
                    <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-bold bg-slate-50 text-slate-500 border border-slate-200 flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Menunggu Kaprodi
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- Main Status & Action Card (Full Width) --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden w-full mb-8">
        {{-- Top Bar: Status Banner --}}
        <div class="p-8 border-b border-slate-100 bg-white flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100 text-slate-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-800">Status Pengajuan</h3>
                    <p class="text-sm font-medium text-slate-500 mt-0.5">Lacak progres dari dokumen yang Anda ajukan.</p>
                </div>
            </div>
            <div>
                <span x-show="status === 'draft'" class="inline-flex items-center gap-2 bg-slate-50 text-slate-600 border border-slate-200 text-sm font-bold px-5 py-2.5 rounded-xl">
                    <span class="w-2 h-2 rounded-full bg-slate-400"></span> Draft (Belum Diajukan)
                </span>
                <span x-show="status === 'direview'" class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 border border-blue-100 text-sm font-bold px-5 py-2.5 rounded-xl" style="display: none;">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span> Sedang Direview
                </span>
                <span x-show="status === 'revisi'" class="inline-flex items-center gap-2 bg-amber-50 text-amber-700 border border-amber-100 text-sm font-bold px-5 py-2.5 rounded-xl" style="display: none;">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span> Perlu Revisi
                </span>
                <span x-show="status === 'disetujui'" class="inline-flex items-center gap-2 bg-green-50 text-green-700 border border-green-100 text-sm font-bold px-5 py-2.5 rounded-xl" style="display: none;">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span> Disetujui / Terjadwal
                </span>
                <span x-show="status === 'selesai'" class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 border border-emerald-100 text-sm font-bold px-5 py-2.5 rounded-xl" style="display: none;">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Telah Selesai
                </span>
            </div>
        </div>

        {{-- Body: Action Area --}}
        <div class="p-8 bg-slate-50/50">
            @if(!$bolehAjukan && $status === 'draft')
                {{-- Blokir form jika prasyarat belum terpenuhi --}}
                <div class="flex flex-col items-center text-center py-8 max-w-md mx-auto">
                    <div class="w-20 h-20 bg-slate-100 border border-slate-200 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800 mb-2">Pengajuan Belum Bisa Dilakukan</h4>
                    <p class="text-sm font-medium text-slate-500 leading-relaxed">Lengkapi semua prasyarat di atas terlebih dahulu sebelum Anda dapat mengajukan uji kompetensi proposal.</p>
                </div>
            @else
                <form action="{{ route('mahasiswa.uji-kompetensi.proposal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col items-center text-center max-w-2xl mx-auto">
                    <div class="flex items-center justify-center gap-3 mb-2">
                        <div class="w-12 h-12 bg-blue-50 border border-blue-100 text-blue-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold text-slate-800">Siap untuk Diajukan?</h4>
                    </div>
                    <p class="text-slate-500 font-medium text-sm mb-8 leading-relaxed max-w-md mx-auto">
                        Pastikan format dokumen sesuai panduan akademik. Dokumen akan direview oleh dosen penguji.
                    </p>

                    <div class="w-full max-w-md mx-auto mb-8 text-left" x-show="status === 'draft' || status === 'revisi'">
                        <p class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-3 text-center">Pilih Metode Ujian <span class="text-red-500">*</span></p>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative group cursor-pointer block w-full">
                                <input type="radio" name="tipe_ujian" value="offline" x-model="tipeUjian" class="peer sr-only">
                                <div class="absolute inset-0 rounded-2xl bg-blue-600 opacity-0 peer-checked:opacity-100 transition-all duration-300 shadow-sm peer-checked:shadow-blue-500/30"></div>
                                <div class="relative flex flex-col items-center justify-center gap-3 p-4 rounded-2xl border-2 border-slate-200 bg-white peer-checked:border-transparent peer-checked:bg-transparent transition-all duration-300 group-hover:border-blue-300">
                                    <div class="p-3 rounded-xl transition-colors duration-300" :class="tipeUjian === 'offline' ? 'bg-white/20 text-white' : 'bg-slate-50 text-slate-400 group-hover:bg-blue-50 group-hover:text-blue-600'">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </div>
                                    <div class="text-center">
                                        <span class="block font-bold text-sm transition-colors duration-300" :class="tipeUjian === 'offline' ? 'text-white' : 'text-slate-800'">Tatap Muka</span>
                                    </div>
                                    <div class="absolute top-3 right-3 opacity-0 scale-50 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-300 text-white">
                                        <svg class="w-5 h-5 drop-shadow-md" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    </div>
                                </div>
                            </label>

                            <label class="relative group cursor-pointer block w-full">
                                <input type="radio" name="tipe_ujian" value="online" x-model="tipeUjian" class="peer sr-only">
                                <div class="absolute inset-0 rounded-2xl bg-blue-600 opacity-0 peer-checked:opacity-100 transition-all duration-300 shadow-sm peer-checked:shadow-blue-500/30"></div>
                                <div class="relative flex flex-col items-center justify-center gap-3 p-4 rounded-2xl border-2 border-slate-200 bg-white peer-checked:border-transparent peer-checked:bg-transparent transition-all duration-300 group-hover:border-blue-300">
                                    <div class="p-3 rounded-xl transition-colors duration-300" :class="tipeUjian === 'online' ? 'bg-white/20 text-white' : 'bg-slate-50 text-slate-400 group-hover:bg-blue-50 group-hover:text-blue-600'">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div class="text-center">
                                        <span class="block font-bold text-sm transition-colors duration-300" :class="tipeUjian === 'online' ? 'text-white' : 'text-slate-800'">Daring (Online)</span>
                                    </div>
                                    <div class="absolute top-3 right-3 opacity-0 scale-50 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-300 text-white">
                                        <svg class="w-5 h-5 drop-shadow-md" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <div x-show="tipeUjian === 'online'" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="mt-6 text-left" style="display: none;">
                            <label for="link_daring" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Link Pelaksanaan Ujian (Zoom/GMeet/dll) <span class="text-red-500">*</span></label>
                            <input type="url" id="link_daring" name="link_daring" value="{{ $linkDaring }}" class="w-full px-4 py-3.5 bg-white rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium text-slate-800 transition-colors" placeholder="https://meet.google.com/xxx-xxxx-xxx">
                        </div>
                    </div>

                    <button type="submit" x-show="status === 'draft' || status === 'revisi'"
                        class="px-8 py-3.5 rounded-xl font-bold transition-all duration-300 flex items-center justify-center gap-2 w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Ajukan Proposal Sekarang
                    </button>
                </div>
            </form>
            @endif
        </div>
    </div>

    {{-- Helper Card --}}
    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-8 w-full mb-10 flex items-start gap-4">
        <div class="bg-blue-100 p-2.5 rounded-xl flex-shrink-0">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div>
            <h4 class="text-lg font-bold text-slate-800 mb-1">Informasi Penting</h4>
            <p class="text-slate-600 font-medium text-sm leading-relaxed">
                Pastikan format dokumen telah disesuaikan dengan template terbaru dari program studi. Apabila dokumen sudah disetujui, Anda tidak dapat melakukan perubahan lagi kecuali statusnya diubah menjadi revisi oleh penguji.
            </p>
        </div>
    </div>

    {{-- Riwayat Pengajuan Proposal --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-slate-50 p-2 rounded-xl border border-slate-200 text-slate-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h2 class="text-xl font-bold text-slate-800">Riwayat Pengajuan Proposal</h2>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 w-full">
        <div class="overflow-x-auto rounded-xl border border-slate-100">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 text-xs uppercase tracking-wider font-bold">
                        <th class="py-4 px-6 rounded-tl-xl">Tanggal</th>
                        <th class="py-4 px-6">Metode</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-right rounded-tr-xl">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($riwayat as $item)
                    <tr class="hover:bg-slate-50/50 transition-colors duration-200">
                        <td class="py-4 px-6 text-slate-800 font-bold">
                            {{ $item->diajukan_at ? $item->diajukan_at->translatedFormat('d M Y') : $item->created_at->translatedFormat('d M Y') }}
                        </td>
                        <td class="py-4 px-6">
                            @if($item->tipe_ujian === 'online')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                Daring
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-slate-50 text-slate-600 border border-slate-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Tatap Muka
                            </span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center">
                            @if($item->status === 'draft')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-slate-50 text-slate-600 border border-slate-200">
                                <span class="w-2 h-2 rounded-full bg-slate-400"></span> Draft
                            </span>
                            @elseif($item->status === 'direview' || $item->status === 'menunggu')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span> Direview
                            </span>
                            @elseif($item->status === 'revisi')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span> Revisi
                            </span>
                            @elseif($item->status === 'disetujui')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-100">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span> Terjadwal
                            </span>
                            @elseif($item->status === 'selesai')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                Selesai
                            </span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-right">
                            @if($item->status === 'revisi' && $item->catatan_revisi)
                            <button @click='openCatatan(@json($item->diajukan_at ? $item->diajukan_at->translatedFormat("d M Y") : $item->created_at->translatedFormat("d M Y")), @json($item->catatan_revisi))' class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-700 font-bold text-xs bg-blue-50 border border-blue-100 hover:bg-blue-100 px-3 py-2 rounded-xl transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                Detail
                            </button>
                            @else
                            <span class="text-slate-300 font-medium text-lg">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-12 px-6 text-center">
                            <div class="flex flex-col items-center justify-center gap-3 text-slate-400">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center border border-slate-100 mb-2">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <p class="font-bold text-slate-500">Belum ada riwayat pengajuan</p>
                                <p class="text-sm font-medium">Anda belum pernah mengajukan uji kompetensi proposal.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Detail Catatan --}}
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
        <div x-show="showModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" 
             @click="showModal = false"></div>

        <div x-show="showModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="bg-white rounded-2xl shadow-xl border border-slate-200 w-full max-w-lg overflow-hidden relative z-10 transform">
            
            <div class="bg-white px-8 py-6 border-b border-slate-100 flex items-center justify-between sticky top-0">
                <div class="flex items-center gap-3">
                    <div class="bg-slate-50 p-2 rounded-xl border border-slate-100 text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">Catatan Revisi</h3>
                </div>
                <button @click="showModal = false" type="button" class="text-slate-400 hover:text-slate-600 bg-slate-50 hover:bg-slate-100 rounded-xl p-2.5 transition-colors">
                    <span class="sr-only">Close</span>
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <div class="px-8 py-6">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Tanggal Pengajuan: <span x-text="modalTitle" class="text-slate-800"></span></p>
                <div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
                    <p class="text-slate-700 font-medium text-sm leading-relaxed whitespace-pre-line" x-text="modalCatatan"></p>
                </div>
            </div>

            <div class="bg-slate-50 px-8 py-5 flex items-center justify-end border-t border-slate-100 rounded-b-2xl">
                <button @click="showModal = false" type="button" class="px-6 py-3 bg-white border border-slate-300 text-slate-700 rounded-xl font-bold hover:bg-slate-50 transition-colors">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection
