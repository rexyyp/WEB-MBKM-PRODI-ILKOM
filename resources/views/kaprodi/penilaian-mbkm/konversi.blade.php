@extends('layouts.kaprodi')

@section('title', 'Konversi Matakuliah - Kaprodi Panel')

@section('content')
<div class="min-h-screen pb-12" x-data="{ showConfirmModal: false, studentToAcc: '', accId: null }">

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
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Konversi Matakuliah</h1>
        </div>
        <p class="text-slate-600 text-lg">Kelola pemetaan dan konversi SKS kegiatan MBKM mahasiswa</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 flex items-center gap-4">
            <div class="p-3 bg-amber-100 rounded-xl text-amber-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <span class="block text-xs font-bold text-amber-600 uppercase tracking-widest">Menunggu ACC</span>
                <span class="block text-3xl font-extrabold text-amber-700">{{ $totalMenunggu }}</span>
            </div>
        </div>
        <div class="bg-green-50 border border-green-200 rounded-2xl p-5 flex items-center gap-4">
            <div class="p-3 bg-green-100 rounded-xl text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <span class="block text-xs font-bold text-green-600 uppercase tracking-widest">Telah Di-ACC</span>
                <span class="block text-3xl font-extrabold text-green-700">{{ $totalDisetujui }}</span>
            </div>
        </div>
    </div>

    {{-- Main Content Container --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden relative">
        {{-- Action Bar --}}
        <form method="GET" action="{{ route('kaprodi.konversi-sks.index') }}">
        <div class="p-6 border-b border-slate-100 bg-white">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                {{-- Search --}}
                <div class="relative w-full sm:w-96">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="block w-full pl-10 pr-3 py-2.5 border-none rounded-lg leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-sm font-medium"
                           placeholder="Cari nama atau NIM mahasiswa...">
                </div>

                {{-- Status Filters --}}
                <div class="flex items-center gap-3 w-full sm:w-auto overflow-x-auto pb-2 sm:pb-0">
                    <div class="relative w-48 flex-shrink-0">
                        <select name="status" onchange="this.form.submit()"
                                class="block w-full pl-4 pr-10 py-2.5 border-none rounded-lg leading-5 bg-slate-50 text-slate-700 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-sm appearance-none">
                            <option value="">Semua Status</option>
                            <option value="diproses"  {{ request('status') === 'diproses'  ? 'selected' : '' }}>Menunggu ACC</option>
                            <option value="disetujui" {{ request('status') === 'disetujui' ? 'selected' : '' }}>Telah Di-ACC</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <button type="submit" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-lg transition-colors flex-shrink-0">
                        Cari
                    </button>
                </div>
            </div>
        </div>
        </form>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">NIM & NAMA MAHASISWA</th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">USULAN MATA KULIAH</th>
                        <th scope="col" class="px-8 py-5 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">TOTAL SKS</th>
                        <th scope="col" class="px-8 py-5 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">STATUS</th>
                        <th scope="col" class="px-8 py-5 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">AKSI</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    @forelse ($konversis as $konversi)
                        @php
                            $pendaftaran = $konversi->pendaftaranMbkm;
                            $mahasiswa   = $pendaftaran?->mahasiswa;
                            $totalSks    = $konversi->detailKonversiSks->sum(fn($d) => $d->mataKuliah?->sks ?? 0);
                            $sudahAcc    = $konversi->status === 'disetujui';
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors {{ $sudahAcc ? 'bg-slate-50/30' : '' }}">
                            <td class="px-8 py-6">
                                <div class="text-[13px] font-medium text-slate-500 mb-1">{{ $mahasiswa?->nim ?? '-' }}</div>
                                <div class="text-sm font-bold {{ $sudahAcc ? 'text-slate-600' : 'text-blue-700' }} leading-tight">
                                    {{ $mahasiswa?->user?->name ?? '-' }}
                                </div>
                                <div class="text-xs text-slate-400 mt-0.5">{{ $pendaftaran?->mitraMbkm?->nama_mitra ?? '-' }}</div>
                            </td>
                            <td class="px-8 py-6">
                                <ul class="text-sm font-medium {{ $sudahAcc ? 'text-slate-500' : 'text-slate-700' }} list-disc list-inside space-y-1">
                                    @foreach ($konversi->detailKonversiSks as $detail)
                                        <li>{{ $detail->mataKuliah?->nama_mk ?? '-' }} ({{ $detail->mataKuliah?->sks ?? 0 }} SKS)</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="text-sm font-bold text-slate-700 bg-slate-100 px-3 py-1 rounded-lg">{{ $totalSks }} SKS</span>
                            </td>
                            <td class="px-8 py-6 text-center whitespace-nowrap">
                                @if ($sudahAcc)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700">
                                        Telah Di-ACC
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-600">
                                        Menunggu ACC
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap text-right">
                                @if ($sudahAcc)
                                    <span class="inline-flex items-center justify-end text-sm font-bold text-green-600 gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Disetujui
                                    </span>
                                @else
                                    <button
                                        @click="studentToAcc = '{{ addslashes($mahasiswa?->user?->name ?? '-') }}'; accId = {{ $konversi->id }}; showConfirmModal = true"
                                        class="inline-flex items-center px-5 py-2 rounded-lg text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white transition-colors shadow-sm gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        ACC Mata Kuliah
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                                    <p class="text-slate-500 font-medium">Belum ada pengajuan konversi</p>
                                    <p class="text-slate-400 text-sm">Pengajuan konversi dari mahasiswa akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between bg-white">
            <p class="text-xs text-slate-500 font-medium">
                Menampilkan {{ $konversis->firstItem() ?? 0 }}–{{ $konversis->lastItem() ?? 0 }} dari {{ $konversis->total() }} pengajuan
            </p>
            @if ($konversis->hasPages())
                <div>{{ $konversis->links() }}</div>
            @endif
        </div>

        {{-- Hidden Form untuk ACC --}}
        <form id="form-acc" method="POST" action="" style="display:none;">
            @csrf
        </form>

        {{-- Alpine Modal Konfirmasi ACC --}}
        <div x-show="showConfirmModal"
             style="display: none;"
             class="fixed inset-0 z-50 flex items-center justify-center">

            {{-- Backdrop --}}
            <div x-show="showConfirmModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm"
                 @click="showConfirmModal = false"></div>

            {{-- Modal Box --}}
            <div x-show="showConfirmModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative z-10 transform overflow-hidden text-center">

                {{-- Success Icon --}}
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-50 mb-5">
                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>

                <h3 class="text-xl font-extrabold text-slate-900 mb-2">Konfirmasi Pengesahan</h3>
                <p class="text-sm text-slate-500 mb-6 leading-relaxed">
                    Apakah Anda yakin ingin menyetujui (ACC) usulan mata kuliah konversi untuk mahasiswa
                    <strong class="text-slate-700" x-text="studentToAcc"></strong>?
                    <br>
                    <span class="text-xs text-slate-400 mt-1 block">Setelah di-ACC, mata kuliah tidak dapat diubah oleh mahasiswa.</span>
                </p>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="button" @click="showConfirmModal = false"
                            class="w-full inline-flex justify-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 hover:bg-slate-50 transition-colors focus:outline-none">
                        Batal
                    </button>
                    <button type="button"
                            @click="
                                let url = '{{ url('kaprodi/konversi-sks') }}/' + accId + '/acc';
                                document.getElementById('form-acc').action = url;
                                document.getElementById('form-acc').submit();
                            "
                            class="w-full inline-flex justify-center rounded-xl border border-transparent bg-blue-600 px-4 py-2.5 text-sm font-bold text-white hover:bg-blue-700 transition-colors focus:outline-none shadow-sm">
                        Ya, ACC Matakuliah
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
