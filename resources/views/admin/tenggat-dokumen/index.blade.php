@extends('layouts.admin')

@section('title', 'Tenggat Dokumen - Admin')

@section('content')
    {{-- Flash Messages --}}
    @if(session('success'))
        <div id="flash-success" class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl shadow-sm">
            <svg class="w-5 h-5 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif
    @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-xl px-4 py-3">
            <ul class="text-sm text-red-700 space-y-1">
                @foreach($errors->all() as $error)<li>• {{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    {{-- Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-indigo-100 p-2.5 rounded-xl text-indigo-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Manajemen Tenggat Dokumen</h1>
                <p class="text-slate-500 text-sm mt-0.5">Atur batas waktu pengumpulan dokumen MBKM untuk mahasiswa</p>
            </div>
        </div>
    </div>

    {{-- Info Banner --}}
    <div class="bg-blue-50 border border-blue-200 rounded-xl px-5 py-4 mb-8 flex items-start gap-3">
        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div class="text-sm text-blue-800">
            <p class="font-semibold">Tentang Tenggat Waktu</p>
            <p class="mt-1 text-blue-700">Tenggat waktu bersifat <strong>global</strong> — berlaku untuk semua mahasiswa. Kosongkan tanggal jika dokumen tidak memiliki tenggat waktu. Mahasiswa akan melihat peringatan merah jika tenggat &lt; 3 hari.</p>
        </div>
    </div>

    {{-- Tabel per Kategori --}}
    @foreach($kategoris as $kategori)
        @if(isset($tenggats[$kategori]) && $tenggats[$kategori]->count())
        <div class="mb-8">
            <h2 class="text-base font-bold text-slate-700 mb-3 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full
                    {{ $kategori === 'Surat Administrasi' ? 'bg-blue-500' :
                       ($kategori === 'Dokumen Akademik' ? 'bg-indigo-500' :
                       ($kategori === 'Bimbingan' ? 'bg-purple-500' : 'bg-orange-500')) }}">
                </span>
                {{ $kategori }}
            </h2>

            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="text-left px-5 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Nama Dokumen</th>
                            <th class="text-left px-5 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider w-48">Tenggat Waktu</th>
                            <th class="text-center px-5 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider w-28">Status</th>
                            <th class="text-center px-5 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($tenggats[$kategori] as $tenggat)
                        <tr class="hover:bg-slate-50 transition-colors group">
                            {{-- Nama Dokumen --}}
                            <td class="px-5 py-4">
                                <p class="font-medium text-slate-800">{{ $tenggat->nama_dokumen }}</p>
                                @if($tenggat->is_prasyarat && $tenggat->hint_prasyarat)
                                    <p class="text-xs text-slate-400 mt-0.5">{{ $tenggat->hint_prasyarat }}</p>
                                @endif
                                <div class="flex items-center gap-2 mt-1">
                                    @if($tenggat->is_wajib)
                                        <span class="text-xs bg-red-50 text-red-600 font-medium px-1.5 py-0.5 rounded">Wajib</span>
                                    @else
                                        <span class="text-xs bg-slate-100 text-slate-500 font-medium px-1.5 py-0.5 rounded">Opsional</span>
                                    @endif
                                    @if($tenggat->is_prasyarat)
                                        <span class="text-xs bg-amber-50 text-amber-600 font-medium px-1.5 py-0.5 rounded">Prasyarat</span>
                                    @endif
                                </div>
                            </td>

                            {{-- Tenggat Waktu (inline edit) --}}
                            <td class="px-5 py-4">
                                <form method="POST"
                                      action="{{ route('admin.tenggat-dokumen.update', $tenggat->id) }}"
                                      class="flex items-center gap-2"
                                      id="form-tenggat-{{ $tenggat->id }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="date"
                                           name="tenggat_waktu"
                                           id="input-tenggat-{{ $tenggat->id }}"
                                           value="{{ $tenggat->tenggat_waktu?->format('Y-m-d') }}"
                                           class="border border-slate-200 rounded-lg px-2 py-1.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-36"
                                           onchange="document.getElementById('form-tenggat-{{ $tenggat->id }}').submit()">
                                </form>
                            </td>

                            {{-- Status Tenggat --}}
                            <td class="px-5 py-4 text-center">
                                @if(!$tenggat->tenggat_waktu)
                                    <span class="text-xs bg-slate-100 text-slate-500 font-medium px-2.5 py-1 rounded-full">Tidak Ada</span>
                                @elseif($tenggat->is_overdue)
                                    <span class="text-xs bg-red-100 text-red-700 font-semibold px-2.5 py-1 rounded-full">Lewat</span>
                                @elseif($tenggat->days_left <= 3)
                                    <span class="text-xs bg-amber-100 text-amber-700 font-semibold px-2.5 py-1 rounded-full">{{ $tenggat->days_left }}h lagi</span>
                                @else
                                    <span class="text-xs bg-green-100 text-green-700 font-semibold px-2.5 py-1 rounded-full">{{ $tenggat->days_left }}h lagi</span>
                                @endif
                            </td>

                            {{-- Aksi: Reset Tenggat --}}
                            <td class="px-5 py-4 text-center">
                                @if($tenggat->tenggat_waktu)
                                    <form method="POST"
                                          action="{{ route('admin.tenggat-dokumen.reset', $tenggat->id) }}"
                                          onsubmit="return confirm('Reset tenggat waktu untuk \'{{ $tenggat->nama_dokumen }}\'?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-xs text-red-400 hover:text-red-600 font-medium transition-colors px-2 py-1 rounded hover:bg-red-50">
                                            Reset
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-slate-300">—</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    @endforeach

    {{-- Ringkasan Statistik --}}
    <div class="grid grid-cols-3 gap-4 mt-4">
        @php
            $allTenggats = collect($tenggats)->flatten();
            $withDeadline = $allTenggats->filter(fn($t) => $t->tenggat_waktu)->count();
            $overdue = $allTenggats->filter(fn($t) => $t->is_overdue)->count();
            $urgent = $allTenggats->filter(fn($t) => $t->tenggat_waktu && !$t->is_overdue && $t->days_left <= 3)->count();
        @endphp
        <div class="bg-white rounded-xl border border-slate-100 shadow-sm px-5 py-4 text-center">
            <p class="text-2xl font-bold text-slate-800">{{ $withDeadline }}</p>
            <p class="text-xs text-slate-500 mt-1">Dokumen Bertenggat</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-100 shadow-sm px-5 py-4 text-center">
            <p class="text-2xl font-bold text-amber-600">{{ $urgent }}</p>
            <p class="text-xs text-slate-500 mt-1">Tenggat ≤ 3 Hari</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-100 shadow-sm px-5 py-4 text-center">
            <p class="text-2xl font-bold text-red-600">{{ $overdue }}</p>
            <p class="text-xs text-slate-500 mt-1">Tenggat Lewat</p>
        </div>
    </div>
@endsection

@push('scripts')
<script>
// Auto-dismiss flash
setTimeout(() => document.getElementById('flash-success')?.remove(), 4000);
</script>
@endpush
