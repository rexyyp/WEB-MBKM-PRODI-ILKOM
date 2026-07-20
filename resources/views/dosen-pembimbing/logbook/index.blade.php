@extends('layouts.dosen-pembimbing')

@section('title', 'Review Logbook - Dosen')

@section('content')
@php
    // Persiapkan data logbook untuk AlpineJS
    $logbookList = $logbooks->map(function($lb) {
        $start = $lb->jam_mulai ? \Carbon\Carbon::parse($lb->jam_mulai) : null;
        $end = $lb->jam_selesai ? \Carbon\Carbon::parse($lb->jam_selesai) : null;
        $durasi = ($start && $end) ? $start->diffInHours($end) : 0;
        return [
            'id' => $lb->id,
            'tanggal_format' => \Carbon\Carbon::parse($lb->tanggal)->translatedFormat('l, d F Y'),
            'kegiatan' => $lb->kegiatan,
            'deskripsi' => $lb->deskripsi,
            'jam_mulai' => $start ? $start->format('H:i') . ' WIB' : '-',
            'jam_selesai' => $end ? $end->format('H:i') . ' WIB' : '-',
            'durasi' => $durasi . ' Jam',
            'status_validasi' => $lb->status_validasi,
            'komentar_dosen' => $lb->komentar_dosen,
        ];
    });
@endphp

<div x-data="{ 
        logbooks: @js($logbookList),
        selectedLogbook: null,
        selectLogbook(logbookId) {
            this.selectedLogbook = this.logbooks.find(l => l.id === logbookId);
        }
    }" 
    x-init="
        if (logbooks.length > 0) {
            selectLogbook(logbooks[0].id);
        }
    "
    class="font-['Inter',sans-serif]">

    {{-- Flash Message --}}
    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 rounded-xl px-5 py-4 flex items-center gap-3">
        <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <p class="text-green-800 font-semibold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Review Logbook</h1>
        </div>
        <p class="text-slate-600 text-lg">Tinjau dan validasi logbook mahasiswa bimbingan Anda.</p>
    </div>

    @if($pendaftarans->isEmpty())
        <div class="bg-white rounded-2xl p-12 text-center shadow-sm border border-slate-200">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <h3 class="text-lg font-bold text-slate-800 mb-2">Belum Ada Mahasiswa</h3>
            <p class="text-slate-500">Anda belum memiliki mahasiswa bimbingan yang aktif saat ini.</p>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Left & Center Column: Logbook Activities --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Student Selector Card --}}
                <div class="bg-white rounded-xl shadow-md p-6 border border-slate-100">
                    <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">Pilih Mahasiswa</h3>
                    
                    <form id="studentSelectForm" action="{{ route('dosen-pembimbing.logbook.index') }}" method="GET">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-bold text-lg flex-shrink-0">
                                {{ strtoupper(substr($selectedPendaftaran->mahasiswa->user->name ?? 'M', 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <p class="font-bold text-slate-900 text-lg">{{ $selectedPendaftaran->mahasiswa->user->name ?? '-' }}</p>
                                <p class="text-sm text-slate-500 font-medium">NIM: {{ $selectedPendaftaran->mahasiswa->nim ?? '-' }} • {{ $selectedPendaftaran->programMbkm->nama ?? '-' }}</p>
                            </div>
                            <div class="relative min-w-[200px]">
                                <select name="pendaftaran_id" onchange="document.getElementById('studentSelectForm').submit()" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none cursor-pointer bg-white hover:border-slate-400 transition-colors duration-200 pr-10 font-medium text-slate-700 shadow-sm">
                                    @foreach($pendaftarans as $pendaftaran)
                                        <option value="{{ $pendaftaran->id }}" {{ $selectedPendaftaran->id == $pendaftaran->id ? 'selected' : '' }}>
                                            {{ $pendaftaran->mahasiswa->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-slate-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Summary Card --}}
                <div class="bg-white rounded-xl shadow-md p-6 border border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-1">Statistik Keseluruhan</h3>
                        <p class="text-slate-500 text-sm font-medium">Berdasarkan total aktivitas magang berjalan</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 text-center min-w-[120px]">
                            <div class="flex items-center justify-center gap-1.5 mb-2 text-slate-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                <span class="text-xs font-bold uppercase tracking-wider">Aktivitas</span>
                            </div>
                            <span class="text-2xl font-black text-slate-900">{{ $totalAktivitas }}</span>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 text-center min-w-[120px]">
                            <div class="flex items-center justify-center gap-1.5 mb-2 text-slate-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="text-xs font-bold uppercase tracking-wider">Total Jam</span>
                            </div>
                            <span class="text-2xl font-black text-slate-900">{{ $totalJam }}</span>
                        </div>
                    </div>
                </div>

                {{-- Activities List --}}
                <div class="space-y-3">
                    @forelse($logbookList as $lb)
                    <div @click="selectLogbook({{ $lb['id'] }})"
                         :class="selectedLogbook && selectedLogbook.id === {{ $lb['id'] }} ? 'bg-blue-50 border-blue-300 ring-2 ring-blue-100' : 'bg-white border-slate-200 hover:border-blue-200 hover:bg-slate-50'"
                         class="border rounded-xl p-4 cursor-pointer transition-all duration-200 shadow-sm flex flex-col md:flex-row md:items-start gap-4">
                        
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm"
                             :class="selectedLogbook && selectedLogbook.id === {{ $lb['id'] }} ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-500'">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-2 mb-1">
                                <div>
                                    <p class="text-xs text-slate-500 font-semibold mb-1">{{ $lb['tanggal_format'] }}</p>
                                    <p class="font-bold text-slate-900 text-base line-clamp-1" title="{{ $lb['kegiatan'] }}">{{ $lb['kegiatan'] }}</p>
                                </div>
                                <div class="flex items-center gap-2 flex-shrink-0">
                                    <span class="inline-flex items-center bg-slate-100 text-slate-600 border border-slate-200 text-xs font-bold px-2 py-1 rounded">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $lb['durasi'] }}
                                    </span>
                                    
                                    @if($lb['status_validasi'] == 'pending')
                                        <span class="inline-block bg-blue-100 border border-blue-200 text-blue-700 text-xs font-bold px-2.5 py-1 rounded">Pending Review</span>
                                    @elseif($lb['status_validasi'] == 'disetujui')
                                        <span class="inline-block bg-emerald-100 border border-emerald-200 text-emerald-700 text-xs font-bold px-2.5 py-1 rounded">Disetujui</span>
                                    @else
                                        <span class="inline-block bg-amber-100 border border-amber-200 text-amber-700 text-xs font-bold px-2.5 py-1 rounded">Revisi</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white border border-slate-200 rounded-xl py-12 flex flex-col items-center justify-center text-slate-400">
                        <svg class="w-12 h-12 mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <p class="font-medium text-slate-500">Mahasiswa ini belum mengirimkan catatan logbook.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Right Column: Detail & Review Form --}}
            <div class="space-y-6">
                
                {{-- Wrapper Tampil Saat Ada Logbook Terpilih --}}
                <div x-show="selectedLogbook" style="display: none;"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-x-4"
                     x-transition:enter-end="opacity-100 transform translate-x-0">
                    
                    {{-- Detail Aktivitas Card --}}
                    <div class="bg-white rounded-xl shadow-md p-6 mb-6 border border-slate-100">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2 bg-slate-100 rounded-lg text-slate-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900">Detail Aktivitas</h3>
                        </div>
                        
                        {{-- Activity Date --}}
                        <div class="mb-5">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Tanggal</p>
                            <p class="text-slate-800 font-medium" x-text="selectedLogbook?.tanggal_format"></p>
                        </div>

                        {{-- Kegiatan --}}
                        <div class="mb-5">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Judul Kegiatan</p>
                            <p class="text-slate-900 font-bold" x-text="selectedLogbook?.kegiatan"></p>
                        </div>

                        {{-- Deskripsi Lengkap --}}
                        <div class="mb-6">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Deskripsi Lengkap</p>
                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                                <p class="text-slate-700 text-sm leading-relaxed whitespace-pre-line" x-text="selectedLogbook?.deskripsi"></p>
                            </div>
                        </div>

                        {{-- Ringkasan Waktu --}}
                        <div class="bg-slate-800 text-white rounded-xl p-4 shadow-sm">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-3">Ringkasan Waktu Kerja</p>
                            <div class="grid grid-cols-3 gap-3 text-center divide-x divide-slate-600">
                                <div>
                                    <p class="text-[10px] text-slate-400 mb-1">Mulai</p>
                                    <p class="font-bold text-sm" x-text="selectedLogbook?.jam_mulai"></p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-400 mb-1">Selesai</p>
                                    <p class="font-bold text-sm" x-text="selectedLogbook?.jam_selesai"></p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-400 mb-1">Durasi</p>
                                    <p class="font-bold text-emerald-400 text-sm" x-text="selectedLogbook?.durasi"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Review Form Card --}}
                    <div class="bg-white rounded-xl shadow-md p-6 border border-slate-100">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2 bg-blue-100 rounded-lg text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900">Form Review</h3>
                        </div>

                        <form :action="`/dosen-pembimbing/logbook/${selectedLogbook?.id}/review`" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Komentar Dosen --}}
                            {{-- Komentar Dosen --}}
                            <div class="mb-6">
                                <label for="komentar" class="block text-sm font-bold text-slate-700 mb-2">Komentar & Catatan Tambahan</label>
                                <textarea name="komentar_dosen" :value="selectedLogbook?.komentar_dosen" :disabled="selectedLogbook?.status_validasi !== 'pending'" placeholder="Berikan masukan atau catatan untuk aktivitas ini..." rows="4" class="w-full px-4 py-3 border border-slate-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none transition-all duration-200 text-sm disabled:bg-slate-50 disabled:text-slate-500"></textarea>
                            </div>

                            {{-- Status Validasi --}}
                            <div class="mb-6">
                                <label class="block text-sm font-bold text-slate-700 mb-3">Status Validasi <span class="text-red-500" x-show="selectedLogbook?.status_validasi === 'pending'">*</span></label>
                                <div class="space-y-3">
                                    <label :class="selectedLogbook?.status_validasi === 'disetujui' ? 'border-emerald-500 bg-emerald-50' : 'border-slate-200 hover:bg-slate-50'" 
                                           class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer transition-all duration-200">
                                        <input type="radio" name="status_validasi" value="disetujui" :checked="selectedLogbook?.status_validasi === 'disetujui'" :disabled="selectedLogbook?.status_validasi !== 'pending'" required class="w-4 h-4 text-emerald-600 focus:ring-emerald-500 cursor-pointer disabled:opacity-50">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="text-slate-900 font-bold text-sm">Disetujui</span>
                                        </div>
                                    </label>
                                    
                                    <label :class="selectedLogbook?.status_validasi === 'revisi' ? 'border-amber-500 bg-amber-50' : 'border-slate-200 hover:bg-slate-50'" 
                                           class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer transition-all duration-200">
                                        <input type="radio" name="status_validasi" value="revisi" :checked="selectedLogbook?.status_validasi === 'revisi'" :disabled="selectedLogbook?.status_validasi !== 'pending'" required class="w-4 h-4 text-amber-600 focus:ring-amber-500 cursor-pointer disabled:opacity-50">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="text-slate-900 font-bold text-sm">Perlu Revisi</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            {{-- Submit Button (hanya tampil jika pending) --}}
                            <button x-show="selectedLogbook?.status_validasi === 'pending'" type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-xl transition-all duration-200 shadow-md flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Review Logbook
                            </button>

                            {{-- Indikator Sudah Direview --}}
                            <div x-show="selectedLogbook?.status_validasi !== 'pending'" style="display: none;" class="w-full bg-slate-50 text-slate-500 font-bold py-3.5 px-4 rounded-xl border border-slate-200 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Aktivitas ini telah direview
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Tampil Jika Belum Ada Logbook --}}
                <div x-show="!selectedLogbook" class="bg-white rounded-xl shadow-md p-12 text-center border border-slate-100 flex flex-col items-center justify-center h-full min-h-[400px]">
                    <svg class="w-16 h-16 text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    <p class="text-slate-500 font-medium text-sm max-w-[250px]">Pilih salah satu logbook di sebelah kiri untuk melihat detail dan memberikan review.</p>
                </div>

            </div>
        </div>
    @endif
</div>
@endsection
