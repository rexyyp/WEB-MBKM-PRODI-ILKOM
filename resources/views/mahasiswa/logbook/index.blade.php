@extends('layouts.mahasiswa')

@section('title', 'Logbook - Mahasiswa')

@section('content')
<div x-data="{ 
        showReviewModal: false, 
        activeReview: '',
        
        showDetailModal: false,
        showEditModal: false,
        selectedLogbook: null,
        logbooksList: @js($logbooks),
        
        openDetail(id) {
            this.selectedLogbook = this.logbooksList.find(l => l.id === id);
            this.showDetailModal = true;
        },
        
        openEdit(id) {
            this.selectedLogbook = this.logbooksList.find(l => l.id === id);
            // Convert jam_mulai (H:i:s -> H:i)
            if(this.selectedLogbook.jam_mulai) {
                this.selectedLogbook.jam_mulai = this.selectedLogbook.jam_mulai.substring(0, 5);
            }
            if(this.selectedLogbook.jam_selesai) {
                this.selectedLogbook.jam_selesai = this.selectedLogbook.jam_selesai.substring(0, 5);
            }
            this.showEditModal = true;
        }
    }">

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="bg-white border-l-4 border-green-500 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-8 animate-fade-in-up">
            <div class="bg-green-50 p-2.5 rounded-xl text-green-600 flex-shrink-0 mt-0.5 border border-green-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-slate-800 font-bold text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-white border-l-4 border-red-500 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-8 animate-fade-in-up">
            <div class="bg-red-50 p-2.5 rounded-xl text-red-600 flex-shrink-0 mt-0.5 border border-red-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <p class="text-red-800 font-bold text-sm">{{ session('error') }}</p>
            </div>
        </div>
    @endif
    @if($errors->any())
        <div class="bg-white border-l-4 border-red-500 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-8 animate-fade-in-up">
            <div class="bg-red-50 p-2.5 rounded-xl text-red-600 flex-shrink-0 mt-0.5 border border-red-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <p class="text-slate-800 font-bold text-sm mb-2">Terdapat kesalahan pada input Anda:</p>
                <ul class="text-slate-600 font-medium text-xs list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- Header Section --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-6 animate-fade-in-up">
        <div class="flex items-center gap-4">
            <div class="bg-blue-50 border border-blue-100 p-3.5 rounded-2xl text-blue-600 shadow-sm shrink-0">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Logbook MBKM</h1>
                <p class="text-slate-500 mt-1 font-medium">Catatan kegiatan harian selama pelaksanaan MBKM.</p>
            </div>
        </div>
        @if ($pendaftaran)
            <a href="{{ route('mahasiswa.logbook.create') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all duration-300 flex items-center gap-2 shadow-sm hover:shadow-md shrink-0 w-fit">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Logbook
            </a>
        @endif
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Total Entri Logbook --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md hover:border-blue-200 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-slate-50 group-hover:bg-blue-50 p-3 rounded-xl transition-colors duration-300 border border-slate-100 group-hover:border-blue-100">
                    <svg class="w-6 h-6 text-slate-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Entri Logbook</p>
                <p class="text-2xl font-black text-slate-800">{{ $totalLogbook }}</p>
            </div>
        </div>

        {{-- Total Jam Kerja --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md hover:border-blue-200 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-slate-50 group-hover:bg-blue-50 p-3 rounded-xl transition-colors duration-300 border border-slate-100 group-hover:border-blue-100">
                    <svg class="w-6 h-6 text-slate-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Jam Kerja</p>
                <p class="text-2xl font-black text-slate-800">{{ $totalJamKerja }} <span class="text-base font-bold text-slate-500">Jam</span></p>
            </div>
        </div>

        {{-- Jumlah Hari Aktif --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md hover:border-blue-200 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-slate-50 group-hover:bg-blue-50 p-3 rounded-xl transition-colors duration-300 border border-slate-100 group-hover:border-blue-100">
                    <svg class="w-6 h-6 text-slate-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Jumlah Hari Aktif</p>
                <p class="text-2xl font-black text-slate-800">{{ $jumlahHariAktif }} <span class="text-base font-bold text-slate-500">Hari</span></p>
            </div>
        </div>
    </div>

    {{-- Logbook Timeline Section --}}
    <div class="space-y-4 mb-8">
        @forelse ($logbooksByWeek as $weekKey => $weekData)
            @php
                $isFirst   = $loop->first;
                $targetJam = 40; // target jam per minggu (default)
                $progress  = $weekData['total_jam'] > 0
                    ? min(100, round(($weekData['total_jam'] / $targetJam) * 100))
                    : 0;
            @endphp

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                {{-- Section Header --}}
                <div class="bg-slate-50/50 px-6 py-5 border-b border-slate-100 flex items-center justify-between cursor-pointer hover:bg-slate-50 transition-colors duration-300" onclick="toggleWeek(this)">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="p-2 rounded-lg bg-white border border-slate-200 text-slate-400">
                            <svg class="w-5 h-5 transition-transform duration-300 {{ $isFirst ? '' : '-rotate-90' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">
                                Minggu ke-{{ $weekData['week_number'] }}
                                <span class="text-sm font-medium text-slate-500 ml-2">({{ $weekData['date_start']->locale('id')->isoFormat('D MMM') }} - {{ $weekData['date_end']->locale('id')->isoFormat('D MMM YYYY') }})</span>
                            </h3>
                            <p class="text-sm font-medium text-slate-600 mt-1">
                                Total: <span class="font-bold text-slate-800">{{ $weekData['total_jam'] }} Jam</span> • {{ $weekData['logbooks']->count() }} Aktivitas
                            </p>
                        </div>
                    </div>

                    @if ($weekData['semua_direview'])
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center justify-center px-4 py-1.5 bg-green-50 text-green-700 border border-green-100 text-xs font-bold rounded-full">
                                Selesai Direview
                            </span>
                        </div>
                    @else
                        <div class="w-32 h-2 bg-slate-100 rounded-full overflow-hidden border border-slate-200">
                            <div class="h-full bg-blue-500 rounded-full" style="width: {{ $progress }}%"></div>
                        </div>
                    @endif
                </div>

                {{-- Week Content --}}
                <div class="{{ $isFirst ? '' : 'hidden' }} p-6 space-y-4 bg-white">
                    @foreach ($weekData['logbooks']->sortByDesc('tanggal') as $logbook)
                        @php
                            $date = \Carbon\Carbon::parse($logbook->tanggal);
                            $borderClass = match($logbook->status_validasi) {
                                'disetujui' => 'border-l-4 border-l-green-500',
                                'revisi'    => 'border-l-4 border-l-red-500',
                                default     => 'border-l-4 border-l-yellow-400',
                            };
                            $hariIndo = [
                                'Monday'    => 'SENIN',   'Tuesday'  => 'SELASA',
                                'Wednesday' => 'RABU',    'Thursday' => 'KAMIS',
                                'Friday'    => 'JUMAT',   'Saturday' => 'SABTU',
                                'Sunday'    => 'MINGGU',
                            ];
                            $hari       = $hariIndo[$date->englishDayOfWeek] ?? strtoupper($date->englishDayOfWeek);
                            $tanggalFmt = $date->locale('id')->isoFormat('D MMM');
                            $jamKerja   = $logbook->jam_kerja ?? 0;
                            $hasKomentar = !empty($logbook->komentar_dosen);
                        @endphp

                        <div class="bg-white border border-slate-200 rounded-xl p-5 hover:shadow-md transition-all duration-300 {{ $borderClass }}">
                            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                                <div class="flex gap-5 flex-1">
                                    {{-- Tanggal --}}
                                    <div class="text-center min-w-[4rem] bg-slate-50 rounded-xl p-2 border border-slate-100 flex flex-col justify-center items-center">
                                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">{{ $hari }}</p>
                                        <p class="text-lg font-black text-slate-800 leading-none mt-1">{{ $tanggalFmt }}</p>
                                    </div>

                                    {{-- Konten --}}
                                    <div class="flex-1">
                                        <h4 class="font-bold text-slate-800 text-lg mb-1.5">{{ $logbook->kegiatan }}</h4>

                                        @if ($logbook->deskripsi)
                                            <p class="text-sm font-medium text-slate-600 mb-4 line-clamp-2">{{ $logbook->deskripsi }}</p>
                                        @endif

                                        <div class="flex flex-wrap items-center gap-2">
                                            {{-- Jam Badge --}}
                                            @if ($jamKerja > 0)
                                                <span class="inline-flex items-center justify-center bg-slate-50 text-slate-700 text-xs font-bold px-3 py-1.5 rounded-lg border border-slate-200">
                                                    {{ $jamKerja }} Jam
                                                </span>
                                            @endif

                                            {{-- Status Badge --}}
                                            @if ($logbook->status_validasi === 'pending')
                                                <span class="inline-flex items-center justify-center bg-yellow-50 text-yellow-700 text-xs font-bold px-3 py-1.5 rounded-lg border border-yellow-200 gap-1.5">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    Pending Review
                                                </span>
                                            @elseif ($logbook->status_validasi === 'disetujui')
                                                <span class="inline-flex items-center justify-center bg-green-50 text-green-700 text-xs font-bold px-3 py-1.5 rounded-lg border border-green-200 gap-1.5">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    Telah Direview
                                                </span>
                                                @if ($hasKomentar)
                                                    <button @click="activeReview = {{ Js::from($logbook->komentar_dosen) }}; showReviewModal = true"
                                                            class="inline-flex items-center justify-center bg-white hover:bg-slate-50 text-slate-600 text-xs font-bold px-3 py-1.5 rounded-lg border border-slate-200 transition-colors gap-1.5 cursor-pointer">
                                                        <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                                        Lihat Komentar
                                                    </button>
                                                @endif
                                            @elseif ($logbook->status_validasi === 'revisi')
                                                <span class="inline-flex items-center justify-center bg-red-50 text-red-700 text-xs font-bold px-3 py-1.5 rounded-lg border border-red-200 gap-1.5">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                    Perlu Revisi
                                                </span>
                                                @if ($hasKomentar)
                                                    <button @click="activeReview = {{ Js::from($logbook->komentar_dosen) }}; showReviewModal = true"
                                                            class="inline-flex items-center justify-center bg-white hover:bg-slate-50 text-slate-600 text-xs font-bold px-3 py-1.5 rounded-lg border border-slate-200 transition-colors gap-1.5 cursor-pointer">
                                                        <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                                        Lihat Komentar
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Action Menu --}}
                                <div class="flex sm:flex-col gap-2 shrink-0">
                                    <button @click="openDetail({{ $logbook->id }})" type="button" class="inline-flex items-center justify-center w-10 h-10 rounded-xl text-slate-500 bg-white border border-slate-200 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition-all duration-300 shadow-sm" title="Detail Logbook">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                    
                                    @if($logbook->status_validasi !== 'disetujui')
                                    <button @click="openEdit({{ $logbook->id }})" type="button" class="inline-flex items-center justify-center w-10 h-10 rounded-xl text-slate-500 bg-white border border-slate-200 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition-all duration-300 shadow-sm" title="Edit Logbook">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            {{-- Empty State --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-12 text-center">
                <div class="flex flex-col items-center gap-4 text-slate-400">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center border border-slate-100">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <p class="text-xl font-bold text-slate-800">Belum ada catatan logbook</p>
                    <p class="text-sm font-medium text-slate-500">Mulai catat aktivitas harian MBKM Anda untuk melacak progres magang.</p>
                    @if ($pendaftaran)
                        <a href="{{ route('mahasiswa.logbook.create') }}"
                           class="mt-4 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all duration-300 shadow-sm hover:shadow-md flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Tambah Logbook Pertama
                        </a>
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    {{-- Modal Detail Logbook --}}
    <div x-show="showDetailModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
        <div x-show="showDetailModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="showDetailModal = false"></div>

        <div x-show="showDetailModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="bg-white rounded-2xl shadow-xl border border-slate-200 w-full max-w-2xl overflow-hidden relative z-10 transform p-8">
            <div class="flex items-center justify-between mb-8 pb-6 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="bg-slate-50 p-2 rounded-lg text-slate-600 border border-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">Detail Logbook</h3>
                </div>
                <button @click="showDetailModal = false" class="text-slate-400 hover:text-slate-600 bg-slate-50 hover:bg-slate-100 p-2 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="space-y-6">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Judul Kegiatan</p>
                    <p class="text-slate-800 font-bold text-lg" x-text="selectedLogbook?.kegiatan"></p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Tanggal</p>
                        <p class="text-slate-800 font-medium bg-slate-50 px-4 py-2 rounded-xl border border-slate-100 inline-block" x-text="selectedLogbook?.tanggal"></p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Waktu</p>
                        <p class="text-slate-800 font-medium bg-slate-50 px-4 py-2 rounded-xl border border-slate-100 inline-block" x-text="(selectedLogbook?.jam_mulai ? selectedLogbook.jam_mulai.substring(0,5) : '') + ' - ' + (selectedLogbook?.jam_selesai ? selectedLogbook.jam_selesai.substring(0,5) : '')"></p>
                    </div>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Deskripsi Lengkap</p>
                    <div class="bg-slate-50 p-5 rounded-xl border border-slate-100">
                        <p class="text-slate-700 text-sm leading-relaxed whitespace-pre-line font-medium" x-text="selectedLogbook?.deskripsi"></p>
                    </div>
                </div>
                <div x-show="selectedLogbook?.file_bukti">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">File Bukti</p>
                    <a :href="'/storage/' + selectedLogbook?.file_bukti" target="_blank" class="inline-flex items-center justify-center bg-blue-50 text-blue-600 text-sm font-bold px-4 py-2.5 rounded-xl border border-blue-100 gap-2 hover:bg-blue-100 transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                        Lihat Bukti Lampiran
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Logbook --}}
    <div x-show="showEditModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
        <div x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="showEditModal = false"></div>

        <div x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="bg-white rounded-2xl shadow-xl border border-slate-200 w-full max-w-2xl overflow-hidden relative z-10 transform">
            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="bg-slate-50 p-2 rounded-lg text-slate-600 border border-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">Edit Logbook</h3>
                </div>
                <button @click="showEditModal = false" class="text-slate-400 hover:text-slate-600 bg-slate-50 hover:bg-slate-100 p-2 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form :action="`/mahasiswa/logbook/${selectedLogbook?.id}`" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tanggal <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal" :value="selectedLogbook?.tanggal" required class="w-full bg-slate-50 border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium px-4 py-3.5 text-slate-800 transition-all border">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Kegiatan <span class="text-red-500">*</span></label>
                            <input type="text" name="kegiatan" :value="selectedLogbook?.kegiatan" required class="w-full bg-slate-50 border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium px-4 py-3.5 text-slate-800 transition-all border">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Jam Mulai <span class="text-red-500">*</span></label>
                            <input type="time" name="jam_mulai" :value="selectedLogbook?.jam_mulai" required class="w-full bg-slate-50 border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium px-4 py-3.5 text-slate-800 transition-all border">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Jam Selesai <span class="text-red-500">*</span></label>
                            <input type="time" name="jam_selesai" :value="selectedLogbook?.jam_selesai" required class="w-full bg-slate-50 border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium px-4 py-3.5 text-slate-800 transition-all border">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi Kegiatan <span class="text-red-500">*</span></label>
                        <textarea name="deskripsi" :value="selectedLogbook?.deskripsi" rows="4" required minlength="10" class="w-full bg-slate-50 border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium px-4 py-4 text-slate-800 transition-all border resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Ubah File Bukti (Opsional)</label>
                        <input type="file" name="file_bukti" accept=".pdf,.jpg,.jpeg,.png" class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-slate-200 rounded-xl transition-all">
                        <p class="text-xs font-medium text-slate-500 mt-2">Biarkan kosong jika tidak ingin mengubah file bukti. Maksimal ukuran file 5MB (PDF/JPG/PNG).</p>
                    </div>
                </div>
                <div class="px-8 py-5 border-t border-slate-100 bg-slate-50 flex justify-end gap-3 rounded-b-2xl">
                    <button type="button" @click="showEditModal = false" class="px-6 py-3 rounded-xl bg-white border border-slate-300 text-slate-700 font-bold hover:bg-slate-50 transition-colors">Batal</button>
                    <button type="submit" class="px-6 py-3 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition-colors shadow-sm flex items-center gap-2">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- Alpine Modal Detail Review Dosen --}}
    <div x-show="showReviewModal"
         style="display: none;"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">

        {{-- Backdrop --}}
        <div x-show="showReviewModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm"
             @click="showReviewModal = false"></div>

        {{-- Modal Box --}}
        <div x-show="showReviewModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="bg-white rounded-2xl shadow-xl border border-slate-200 w-full max-w-md overflow-hidden relative z-10 transform p-8 text-center">

            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-50 mb-6 text-blue-600 border border-blue-100 shadow-sm">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
            </div>

            <h3 class="text-xl font-bold text-slate-800 mb-4">Komentar Dosen</h3>

            <div class="bg-slate-50 border border-slate-100 rounded-xl p-5 text-slate-700 text-sm font-medium leading-relaxed mb-8">
                <p x-text="activeReview"></p>
            </div>

            <button type="button" @click="showReviewModal = false"
                    class="w-full inline-flex justify-center items-center rounded-xl bg-blue-600 px-5 py-3 font-bold text-white hover:bg-blue-700 transition-colors focus:outline-none shadow-sm">
                Tutup Komentar
            </button>
        </div>
    </div>

</div>

<script>
    function toggleWeek(element) {
        const section = element.closest('.rounded-2xl');
        const content = section.querySelector('[class*="hidden"]') || section.querySelector('div:last-child');
        const arrow = section.querySelector('svg:first-child');

        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            arrow.classList.remove('-rotate-90');
        } else {
            content.classList.add('hidden');
            arrow.classList.add('-rotate-90');
        }
    }
</script>
@endsection
