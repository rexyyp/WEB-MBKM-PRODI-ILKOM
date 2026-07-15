@extends('layouts.dosen-pembimbing')

@section('title', 'Penilaian Mahasiswa - Dosen Pembimbing')

@section('content')
    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="mb-6 flex items-center gap-3 rounded-xl bg-green-50 border border-green-200 px-5 py-4 text-green-800 text-sm font-medium">
            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-6 flex items-center gap-3 rounded-xl bg-red-50 border border-red-200 px-5 py-4 text-red-800 text-sm font-medium">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Penilaian Mahasiswa</h1>
        </div>
        <p class="text-slate-600 text-lg">Input nilai pembimbingan untuk mahasiswa MBKM bimbingan Anda.</p>
    </div>

    @if ($pendaftarans->isEmpty())
        {{-- Empty State --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-16 text-center">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <p class="text-slate-500 font-semibold text-lg">Belum ada mahasiswa bimbingan</p>
            <p class="text-slate-400 text-sm mt-2">Mahasiswa yang ditugaskan kepada Anda akan muncul di sini.</p>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left Column: Pilih Mahasiswa --}}
            <div class="space-y-4">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 bg-slate-50">
                        <h2 class="text-sm font-bold text-slate-600 uppercase tracking-wider">Mahasiswa Bimbingan</h2>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $pendaftarans->count() }} mahasiswa</p>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @foreach ($pendaftarans as $p)
                            @php
                                $isSelected = $selectedPendaftaran?->id === $p->id;
                                $sudahDinilai = $p->penilaians->contains('jenis_penilai', 'pembimbing');
                            @endphp
                            <a href="{{ route('dosen-pembimbing.penilaian.index', ['pendaftaran_id' => $p->id]) }}"
                               class="flex items-center gap-3 px-5 py-4 transition-colors {{ $isSelected ? 'bg-blue-50 border-l-4 border-blue-500' : 'hover:bg-slate-50 border-l-4 border-transparent' }}">
                                <div class="w-10 h-10 rounded-full {{ $isSelected ? 'bg-blue-600' : 'bg-slate-200' }} flex items-center justify-center font-bold text-sm {{ $isSelected ? 'text-white' : 'text-slate-600' }} flex-shrink-0">
                                    {{ strtoupper(substr($p->mahasiswa->user->name ?? 'MH', 0, 2)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold {{ $isSelected ? 'text-blue-700' : 'text-slate-800' }} truncate">
                                        {{ $p->mahasiswa->user->name ?? '-' }}
                                    </p>
                                    <p class="text-xs text-slate-500">{{ $p->mahasiswa->nim ?? '-' }}</p>
                                </div>
                                @if ($sudahDinilai)
                                    <span class="flex-shrink-0 w-5 h-5 bg-green-100 rounded-full flex items-center justify-center" title="Sudah dinilai">
                                        <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </span>
                                @else
                                    <span class="flex-shrink-0 w-2 h-2 bg-amber-400 rounded-full" title="Belum dinilai"></span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Legend --}}
                <div class="flex items-center gap-4 px-1 text-xs text-slate-500">
                    <span class="flex items-center gap-1.5">
                        <span class="w-2 h-2 bg-amber-400 rounded-full"></span> Belum dinilai
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span> Sudah dinilai
                    </span>
                </div>
            </div>

            {{-- Right Column: Form Penilaian --}}
            <div class="lg:col-span-2">
                @if (!$selectedPendaftaran)
                    {{-- Placeholder --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-16 text-center h-full flex flex-col items-center justify-center">
                        <svg class="w-14 h-14 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5"></path></svg>
                        <p class="text-slate-500 font-semibold">Pilih mahasiswa</p>
                        <p class="text-slate-400 text-sm mt-1">Klik nama mahasiswa di sebelah kiri untuk mulai menginput nilai</p>
                    </div>
                @else
                    {{-- Profile Card --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-5 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                {{ strtoupper(substr($selectedPendaftaran->mahasiswa->user->name ?? 'MH', 0, 2)) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 text-lg leading-tight">{{ $selectedPendaftaran->mahasiswa->user->name ?? '-' }}</p>
                                <p class="text-sm text-slate-500">{{ $selectedPendaftaran->mahasiswa->nim ?? '-' }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $selectedPendaftaran->mitraMbkm->nama_mitra ?? '-' }}</p>
                            </div>
                        </div>
                        <div>
                            @if ($existingNilai)
                                <div class="text-right">
                                    <span class="block text-xs font-bold text-green-600 uppercase tracking-wider">Nilai Saat Ini</span>
                                    <span class="block text-3xl font-extrabold text-slate-900">{{ $existingNilai->nilai_total }}</span>
                                    <span class="block text-xs text-slate-400 mt-0.5">/100</span>
                                </div>
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    Belum Dinilai
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Form Penilaian --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                        <h2 class="text-xl font-bold text-slate-900 mb-1">
                            {{ $existingNilai ? 'Perbarui Nilai Pembimbing' : 'Input Nilai Pembimbing' }}
                        </h2>
                        <p class="text-slate-500 text-sm mb-6">
                            Masukkan nilai akademik dari sudut pandang pembimbingan Anda (0–100).
                        </p>

                        @if ($errors->any())
                            <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('dosen-pembimbing.penilaian.simpan') }}">
                            @csrf
                            <input type="hidden" name="pendaftaran_id" value="{{ $selectedPendaftaran->id }}">

                            {{-- Nilai --}}
                            <div class="mb-6">
                                <label for="nilai_total" class="block text-sm font-bold text-slate-700 mb-2">
                                    Nilai Pembimbing <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="number" id="nilai_total" name="nilai_total"
                                           value="{{ old('nilai_total', $existingNilai?->nilai_total) }}"
                                           min="0" max="100" step="0.1"
                                           placeholder="Contoh: 85"
                                           class="w-full px-5 py-3.5 border border-slate-300 rounded-xl text-2xl font-bold text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('nilai_total') border-red-400 @enderror">
                                    <span class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 font-semibold text-lg">/100</span>
                                </div>
                                {{-- Progress bar live --}}
                                <div class="mt-3 h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                                    <div id="nilaiBar" class="h-full bg-blue-500 rounded-full transition-all duration-300"
                                         style="width: {{ old('nilai_total', $existingNilai?->nilai_total ?? 0) }}%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-slate-400 mt-1">
                                    <span>0</span><span>25</span><span>50</span><span>75</span><span>100</span>
                                </div>
                            </div>

                            {{-- Catatan --}}
                            <div class="mb-6">
                                <label for="catatan" class="block text-sm font-bold text-slate-700 mb-2">
                                    Catatan <span class="text-slate-400 font-normal">(opsional)</span>
                                </label>
                                <textarea id="catatan" name="catatan" rows="3"
                                          placeholder="Tuliskan catatan atau komentar untuk mahasiswa ini..."
                                          class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none @error('catatan') border-red-400 @enderror">{{ old('catatan', $existingNilai?->catatan) }}</textarea>
                            </div>

                            {{-- Panduan Nilai --}}
                            <div class="mb-6 p-4 bg-slate-50 rounded-xl border border-slate-200">
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Panduan Nilai</p>
                                <div class="grid grid-cols-3 sm:grid-cols-5 gap-2 text-xs text-center">
                                    @foreach (['A ≥ 85', 'A- ≥ 80', 'B+ ≥ 75', 'B ≥ 70', 'B- ≥ 65'] as $guide)
                                        <span class="px-2 py-1 bg-white border border-slate-200 rounded-lg text-slate-600 font-medium">{{ $guide }}</span>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex gap-3 pt-4 border-t border-slate-200">
                                <a href="{{ route('dosen-pembimbing.penilaian.index') }}"
                                   class="px-6 py-3 border border-slate-300 text-slate-700 font-semibold rounded-xl hover:bg-slate-50 transition-colors">
                                    Batal
                                </a>
                                <button type="submit"
                                        class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V5"></path></svg>
                                    {{ $existingNilai ? 'Perbarui Nilai' : 'Simpan Nilai' }}
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    @endif

    {{-- Live progress bar script --}}
    <script>
        const nilaiInput = document.getElementById('nilai_total');
        const nilaiBar   = document.getElementById('nilaiBar');
        if (nilaiInput && nilaiBar) {
            nilaiInput.addEventListener('input', function () {
                const val = Math.min(100, Math.max(0, parseFloat(this.value) || 0));
                nilaiBar.style.width = val + '%';
                nilaiBar.className = 'h-full rounded-full transition-all duration-300 ' +
                    (val >= 85 ? 'bg-green-500' : val >= 70 ? 'bg-blue-500' : val >= 55 ? 'bg-amber-500' : 'bg-red-500');
            });
        }
    </script>
@endsection
