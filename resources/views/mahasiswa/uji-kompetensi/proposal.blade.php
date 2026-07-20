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
}" class="space-y-6 w-full">
    {{-- Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Uji Kompetensi: Proposal</h1>
        </div>
        <p class="text-slate-500 text-lg">Unggah dokumen proposal Anda dan ajukan untuk direview oleh Dosen Penguji.</p>
    </div>

    {{-- ═══ CARD PRASYARAT ═══ --}}
    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden w-full
        {{ $bolehAjukan ? 'border-green-200' : 'border-amber-200' }}">
        <div class="px-6 py-4 border-b flex items-center justify-between
            {{ $bolehAjukan ? 'bg-green-50 border-green-100' : 'bg-amber-50 border-amber-100' }}">
            <div class="flex items-center gap-2">
                @if($bolehAjukan)
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold text-green-800 text-sm">Semua prasyarat terpenuhi — Anda bisa mengajukan</span>
                @else
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold text-amber-800 text-sm">Lengkapi prasyarat berikut sebelum mengajukan</span>
                @endif
            </div>
        </div>
        <div class="p-5 space-y-3">
            {{-- Prasyarat 1: Dokumen Proposal MBKM --}}
            <div class="flex items-center justify-between p-4 rounded-xl border
                {{ $sudahUploadProposal ? 'bg-green-50 border-green-100' : 'bg-red-50 border-red-100' }}">
                <div class="flex items-center gap-3">
                    @if($sudahUploadProposal)
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-sm text-green-800">Dokumen Proposal MBKM</p>
                            <p class="text-xs text-green-600 mt-0.5">Diupload: {{ $dokumenProposal->uploaded_at ? \Carbon\Carbon::parse($dokumenProposal->uploaded_at)->translatedFormat('d M Y') : '-' }}</p>
                        </div>
                    @else
                        <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L10 11.414l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-sm text-red-700">Dokumen Proposal MBKM</p>
                            <p class="text-xs text-red-500 mt-0.5">Belum diupload — wajib ada sebelum mengajukan</p>
                        </div>
                    @endif
                </div>
                @if(!$sudahUploadProposal)
                    <a href="{{ route('mahasiswa.dokumen.index') }}"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-red-600 hover:bg-red-700 text-white transition-colors flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        Upload Sekarang
                    </a>
                @endif
            </div>

            {{-- Prasyarat 2: Dosen Penguji Sudah Di-assign --}}
            <div class="flex items-center justify-between p-4 rounded-xl border
                {{ $sudahAssignPenguji ? 'bg-green-50 border-green-100' : 'bg-slate-50 border-slate-200' }}">
                <div class="flex items-center gap-3">
                    @if($sudahAssignPenguji)
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-sm text-green-800">Dosen Penguji</p>
                            <p class="text-xs text-green-600 mt-0.5">{{ $pendaftaran->dosenPenguji?->user?->name ?? '-' }}</p>
                        </div>
                    @else
                        <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-sm text-slate-600">Dosen Penguji</p>
                            <p class="text-xs text-slate-400 mt-0.5">Menunggu penugasan dari Koordinator Prodi</p>
                        </div>
                    @endif
                </div>
                @if(!$sudahAssignPenguji)
                    <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold bg-slate-200 text-slate-500 flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Menunggu Kaprodi
                    </span>
                @endif
            </div>
        </div>
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
                <span x-show="status === 'draft'" class="inline-flex items-center gap-2 bg-slate-200 text-slate-700 text-sm font-bold px-5 py-2.5 rounded-full">
                    <span class="w-2 h-2 rounded-full bg-slate-500"></span> Draft (Belum Diajukan)
                </span>
                <span x-show="status === 'direview'" class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 text-sm font-bold px-5 py-2.5 rounded-full" style="display: none;">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span> Sedang Direview
                </span>
                <span x-show="status === 'revisi'" class="inline-flex items-center gap-2 bg-amber-100 text-amber-700 text-sm font-bold px-5 py-2.5 rounded-full" style="display: none;">
                    <span class="w-2 h-2 rounded-full bg-amber-600"></span> Perlu Revisi
                </span>
                <span x-show="status === 'disetujui'" class="inline-flex items-center gap-2 bg-green-100 text-green-700 text-sm font-bold px-5 py-2.5 rounded-full" style="display: none;">
                    <span class="w-2 h-2 rounded-full bg-green-600"></span> Disetujui / Terjadwal
                </span>
                <span x-show="status === 'selesai'" class="inline-flex items-center gap-2 bg-emerald-100 text-emerald-700 text-sm font-bold px-5 py-2.5 rounded-full" style="display: none;">
                    <span class="w-2 h-2 rounded-full bg-emerald-600"></span> Telah Selesai
                </span>
            </div>
        </div>

        {{-- Body: Action Area --}}
        <div class="p-5">
            @if(!$bolehAjukan && $status === 'draft')
                {{-- Blokir form jika prasyarat belum terpenuhi --}}
                <div class="flex flex-col items-center text-center py-8 max-w-md mx-auto">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-slate-700 mb-2">Pengajuan Belum Bisa Dilakukan</h4>
                    <p class="text-sm text-slate-500 leading-relaxed">Lengkapi semua prasyarat di atas terlebih dahulu sebelum Anda dapat mengajukan uji kompetensi proposal.</p>
                </div>
            @else
                <form action="{{ route('mahasiswa.uji-kompetensi.proposal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col items-center text-center max-w-2xl mx-auto">
                    <div class="flex items-center justify-center gap-3 mb-2">
                        <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-extrabold text-slate-900">Siap untuk Diajukan?</h4>
                    </div>
                    <p class="text-slate-500 text-sm mb-4 leading-relaxed max-w-md mx-auto">
                        Pastikan format dokumen sesuai panduan akademik. Dokumen akan direview oleh dosen penguji.
                    </p>

                    <div class="w-full max-w-md mx-auto mb-5 text-left" x-show="status === 'draft' || status === 'revisi'">
                        <p class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2 text-center">Pilih Metode Ujian <span class="text-red-500">*</span></p>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative group cursor-pointer block w-full">
                                <input type="radio" name="tipe_ujian" value="offline" x-model="tipeUjian" class="peer sr-only">
                                <div class="absolute inset-0 rounded-xl bg-blue-600 opacity-0 peer-checked:opacity-100 transition-all duration-300 shadow-sm peer-checked:shadow-blue-500/30"></div>
                                <div class="relative flex flex-col items-center justify-center gap-2 p-3 rounded-xl border-2 border-slate-200 bg-white peer-checked:border-transparent peer-checked:bg-transparent transition-all duration-300 group-hover:border-blue-300">
                                    <div class="p-2 rounded-full transition-colors duration-300" :class="tipeUjian === 'offline' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-blue-50 group-hover:text-blue-600'">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </div>
                                    <div class="text-center">
                                        <span class="block font-bold text-sm transition-colors duration-300" :class="tipeUjian === 'offline' ? 'text-white' : 'text-slate-900'">Tatap Muka</span>
                                    </div>
                                    <div class="absolute top-2 right-2 opacity-0 scale-50 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-300 text-white">
                                        <svg class="w-4 h-4 drop-shadow-md" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    </div>
                                </div>
                            </label>

                            <label class="relative group cursor-pointer block w-full">
                                <input type="radio" name="tipe_ujian" value="online" x-model="tipeUjian" class="peer sr-only">
                                <div class="absolute inset-0 rounded-xl bg-emerald-600 opacity-0 peer-checked:opacity-100 transition-all duration-300 shadow-sm peer-checked:shadow-emerald-500/30"></div>
                                <div class="relative flex flex-col items-center justify-center gap-2 p-3 rounded-xl border-2 border-slate-200 bg-white peer-checked:border-transparent peer-checked:bg-transparent transition-all duration-300 group-hover:border-emerald-300">
                                    <div class="p-2 rounded-full transition-colors duration-300" :class="tipeUjian === 'online' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-emerald-50 group-hover:text-emerald-600'">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div class="text-center">
                                        <span class="block font-bold text-sm transition-colors duration-300" :class="tipeUjian === 'online' ? 'text-white' : 'text-slate-900'">Daring (Online)</span>
                                    </div>
                                    <div class="absolute top-2 right-2 opacity-0 scale-50 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-300 text-white">
                                        <svg class="w-4 h-4 drop-shadow-md" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <div x-show="tipeUjian === 'online'" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="mt-4 text-left" style="display: none;">
                            <label for="link_daring" class="block text-sm font-semibold text-slate-700 mb-1.5">Link Pelaksanaan Ujian (Zoom/GMeet/dll) <span class="text-red-500">*</span></label>
                            <input type="url" id="link_daring" name="link_daring" value="{{ $linkDaring }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors" placeholder="https://meet.google.com/xxx-xxxx-xxx">
                        </div>
                    </div>

                    <button type="submit" x-show="status === 'draft' || status === 'revisi'"
                        class="px-5 py-2.5 rounded-full font-bold text-sm transition-all duration-300 flex items-center justify-center gap-2 w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white shadow-sm hover:shadow hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Ajukan Proposal Sekarang
                    </button>
                </div>
            </form>
            @endif
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
                    Pastikan format dokumen telah disesuaikan dengan template terbaru dari program studi. Apabila dokumen sudah disetujui, Anda tidak dapat melakukan perubahan lagi kecuali statusnya diubah menjadi revisi oleh penguji.
                </p>
            </div>
        </div>
    </div>

    {{-- Riwayat Pengajuan Proposal --}}
    <h2 class="text-lg font-bold mt-10 mb-4 text-slate-900">Riwayat Pengajuan Proposal</h2>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden w-full">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Metode</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($riwayat as $item)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-6 text-slate-600 font-medium">
                            {{ $item->diajukan_at ? $item->diajukan_at->translatedFormat('d M Y') : $item->created_at->translatedFormat('d M Y') }}
                        </td>
                        <td class="py-4 px-6">
                            @if($item->tipe_ujian === 'online')
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                Daring
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-slate-600">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Tatap Muka
                            </span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            @if($item->status === 'draft')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-slate-100 text-slate-600">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span> Draft
                            </span>
                            @elseif($item->status === 'direview' || $item->status === 'menunggu')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-blue-100 text-blue-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span> Direview
                            </span>
                            @elseif($item->status === 'revisi')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-amber-100 text-amber-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span> Revisi
                            </span>
                            @elseif($item->status === 'disetujui')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-blue-100 text-blue-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span> Terjadwal
                            </span>
                            @elseif($item->status === 'selesai')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-green-100 text-green-700">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                Selesai
                            </span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-right">
                            @if($item->status === 'revisi' && $item->catatan_revisi)
                            <button @click='openCatatan(@json($item->diajukan_at ? $item->diajukan_at->translatedFormat("d M Y") : $item->created_at->translatedFormat("d M Y")), @json($item->catatan_revisi))' class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-800 font-bold text-xs transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                Detail
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center text-slate-500">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <p class="font-medium">Belum ada riwayat pengajuan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Detail Catatan --}}
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
                
                <div class="bg-white px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-slate-900" id="modal-title">Detail Catatan Revisi - <span x-text="modalTitle"></span></h3>
                    <button @click="showModal = false" type="button" class="text-slate-400 hover:text-slate-500 bg-slate-50 hover:bg-slate-100 rounded-full p-2 transition-colors">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div class="px-6 py-5">
                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                        <p class="text-slate-700 leading-relaxed" x-text="modalCatatan"></p>
                    </div>
                </div>

                <div class="bg-slate-50 px-6 py-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button @click="showModal = false" type="button" class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg font-bold text-sm hover:bg-gray-300 transition-colors">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
