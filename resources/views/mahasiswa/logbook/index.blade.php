@extends('layouts.mahasiswa')

@section('title', 'Logbook - Mahasiswa')

@section('content')
<div x-data="{ showReviewModal: false, activeReview: '' }">

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4 flex items-start gap-3">
            <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <p class="text-sm font-semibold text-green-900">{{ session('success') }}</p>
        </div>
    @endif
    @if (session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 flex items-start gap-3">
            <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <p class="text-sm font-semibold text-red-900">{{ session('error') }}</p>
        </div>
    @endif

    {{-- Header Section --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Logbook MBKM</h1>
            </div>
            <p class="text-slate-600 text-lg">Catatan kegiatan harian selama pelaksanaan MBKM</p>
        </div>
        @if ($pendaftaran)
            <a href="{{ route('mahasiswa.logbook.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-full transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg shrink-0 w-fit">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 5v14m7-7H5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Tambah Logbook
            </a>
        @endif
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Total Entri Logbook --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-600 uppercase mb-2">Total Entri Logbook</p>
                    <p class="text-4xl font-bold text-slate-900">{{ $totalLogbook }}</p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Jam Kerja --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-600 uppercase mb-2">Total Jam Kerja</p>
                    <p class="text-4xl font-bold text-slate-900">{{ $totalJamKerja }} <span class="text-xl font-semibold">Jam</span></p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Jumlah Hari Aktif --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-600 uppercase mb-2">Jumlah Hari Aktif</p>
                    <p class="text-4xl font-bold text-slate-900">{{ $jumlahHariAktif }} <span class="text-xl font-semibold">Hari</span></p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Logbook Timeline Section --}}
    <div class="space-y-4">

        @forelse ($logbooksByWeek as $weekKey => $weekData)
            @php
                $isFirst   = $loop->first;
                $targetJam = 40; // target jam per minggu (default)
                $progress  = $weekData['total_jam'] > 0
                    ? min(100, round(($weekData['total_jam'] / $targetJam) * 100))
                    : 0;
            @endphp

            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200">

                {{-- Section Header --}}
                <div class="bg-slate-50 px-6 py-4 border-b border-slate-200 flex items-center justify-between cursor-pointer hover:bg-slate-100 transition-colors duration-200" onclick="toggleWeek(this)">
                    <div class="flex items-center gap-4 flex-1">
                        <svg class="w-6 h-6 text-slate-600 transition-transform duration-200 {{ $isFirst ? '' : 'rotate-180' }}" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">
                                Minggu ke-{{ $weekData['week_number'] }}
                                ({{ $weekData['date_start']->locale('id')->isoFormat('D MMM') }} - {{ $weekData['date_end']->locale('id')->isoFormat('D MMM YYYY') }})
                            </h3>
                            <p class="text-sm text-slate-600 mt-1">
                                Total: {{ $weekData['total_jam'] }} Jam | {{ $weekData['logbooks']->count() }} Aktivitas
                            </p>
                        </div>
                    </div>

                    @if ($weekData['semua_direview'])
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center justify-center px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">
                                Selesai Direview
                            </span>
                        </div>
                    @else
                        <div class="w-16 h-1 bg-slate-200 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-600 rounded-full" style="width: {{ $progress }}%"></div>
                        </div>
                    @endif
                </div>

                {{-- Week Content --}}
                <div class="{{ $isFirst ? '' : 'hidden' }} p-6 space-y-4">

                    @foreach ($weekData['logbooks']->sortBy('tanggal') as $logbook)
                        @php
                            $date = \Carbon\Carbon::parse($logbook->tanggal);
                            $borderClass = match($logbook->status_validasi) {
                                'disetujui' => 'border-l-4 border-l-emerald-500',
                                'revisi'    => 'border-l-4 border-l-red-500',
                                default     => '',
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

                        <div class="bg-white border border-slate-200 rounded-xl p-5 hover:shadow-md transition-all duration-200 group {{ $borderClass }}">
                            <div class="flex items-start justify-between">
                                <div class="flex gap-4 flex-1">

                                    {{-- Tanggal --}}
                                    <div class="text-center min-w-fit">
                                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">{{ $hari }}</p>
                                        <p class="text-xl font-bold text-slate-900 mt-1">{{ $tanggalFmt }}</p>
                                    </div>

                                    {{-- Konten --}}
                                    <div class="flex-1 pt-1">
                                        <h4 class="font-semibold text-slate-900 mb-2">{{ $logbook->kegiatan }}</h4>

                                        @if ($logbook->deskripsi)
                                            <p class="text-sm text-slate-600 mb-4">{{ $logbook->deskripsi }}</p>
                                        @endif

                                        <div class="flex flex-wrap items-center gap-2">

                                            {{-- Jam Badge --}}
                                            @if ($jamKerja > 0)
                                                <span class="inline-flex items-center justify-center bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full border border-blue-100">
                                                    {{ $jamKerja }} Jam
                                                </span>
                                            @endif

                                            {{-- Status Badge --}}
                                            @if ($logbook->status_validasi === 'pending')
                                                <span class="inline-flex items-center justify-center bg-amber-50 text-amber-600 text-xs font-bold px-3 py-1.5 rounded-full border border-amber-200 gap-1.5 shadow-sm">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    Pending Review
                                                </span>
                                            @elseif ($logbook->status_validasi === 'disetujui')
                                                <span class="inline-flex items-center justify-center bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full border border-emerald-200 gap-1.5 shadow-sm">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    Sudah Direview
                                                </span>
                                                @if ($hasKomentar)
                                                    <button @click="activeReview = {{ Js::from($logbook->komentar_dosen) }}; showReviewModal = true"
                                                            class="inline-flex items-center justify-center bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold px-3 py-1.5 rounded-full border border-slate-300 transition-colors gap-1.5 cursor-pointer shadow-sm ml-1">
                                                        <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                                        Lihat Komentar
                                                    </button>
                                                @endif
                                            @elseif ($logbook->status_validasi === 'revisi')
                                                <span class="inline-flex items-center justify-center bg-red-50 text-red-600 text-xs font-bold px-3 py-1.5 rounded-full border border-red-200 gap-1.5 shadow-sm">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                    Perlu Revisi
                                                </span>
                                                @if ($hasKomentar)
                                                    <button @click="activeReview = {{ Js::from($logbook->komentar_dosen) }}; showReviewModal = true"
                                                            class="inline-flex items-center justify-center bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold px-3 py-1.5 rounded-full border border-slate-300 transition-colors gap-1.5 cursor-pointer shadow-sm ml-1">
                                                        <svg class="w-3.5 h-3.5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                                        Lihat Komentar
                                                    </button>
                                                @endif
                                            @endif

                                            {{-- File Bukti Badge --}}
                                            @if ($logbook->file_bukti)
                                                <a href="{{ Storage::url($logbook->file_bukti) }}" target="_blank"
                                                   class="inline-flex items-center justify-center bg-slate-50 text-slate-600 text-xs font-bold px-3 py-1.5 rounded-full border border-slate-200 gap-1.5 hover:bg-slate-100 transition-colors shadow-sm">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                                    Lihat Bukti
                                                </a>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                {{-- Action Menu --}}
                                <div class="flex flex-col gap-2 ml-3 shrink-0">
                                    <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-400 bg-slate-50 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200" title="Edit Logbook">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-400 bg-slate-50 hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200" title="Detail Logbook">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        @empty
            {{-- Empty State --}}
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <div class="flex flex-col items-center gap-4 text-slate-400">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    <p class="text-xl font-bold text-slate-500">Belum ada catatan logbook</p>
                    <p class="text-sm">Mulai catat aktivitas harian MBKM Anda untuk melacak progres magang.</p>
                    @if ($pendaftaran)
                        <a href="{{ route('mahasiswa.logbook.create') }}"
                           class="mt-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-full transition-all duration-200 shadow-md hover:shadow-lg flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Tambah Logbook Pertama
                        </a>
                    @endif
                </div>
            </div>
        @endforelse

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
             class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden relative z-10 transform p-6 text-center">

            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-50 mb-4 text-blue-600 shadow-sm">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
            </div>

            <h3 class="text-xl font-extrabold text-slate-900 mb-4">Komentar Dosen</h3>

            <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 text-slate-700 text-sm leading-relaxed mb-6">
                <p x-text="activeReview"></p>
            </div>

            <button type="button" @click="showReviewModal = false"
                    class="w-full inline-flex justify-center items-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white hover:bg-blue-700 transition-colors focus:outline-none shadow-sm">
                Tutup Komentar
            </button>
        </div>
    </div>

    {{-- Footer --}}
    <div class="mt-16 pt-8 border-t border-slate-200 flex items-center justify-between text-sm text-slate-500">
        <p>© 2026 Lumni University Academic System</p>
        <div class="flex items-center gap-6">
            <a href="#" class="hover:text-slate-700 transition-colors duration-200">Kebijakan Privasi</a>
            <a href="#" class="hover:text-slate-700 transition-colors duration-200">Syarat & Ketentuan</a>
        </div>
    </div>

</div>

<script>
    function toggleWeek(element) {
        const section = element.closest('.rounded-xl');
        const content = section.querySelector('[class*="hidden"]') || section.querySelector('div:last-child');
        const arrow = section.querySelector('svg:first-child');

        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            arrow.classList.remove('rotate-180');
        } else {
            content.classList.add('hidden');
            arrow.classList.add('rotate-180');
        }
    }
</script>
@endsection
