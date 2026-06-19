@extends('layouts.mahasiswa')

@section('title', 'Riwayat Bimbingan')

@section('content')
<div class="max-w-7xl mx-auto py-6" x-data="{ isModalOpen: {{ $errors->any() ? 'true' : 'false' }}, tipeBimbingan: '{{ old('tipe', 'offline') }}' }">
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

    {{-- Header & Summary --}}
    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                </div>
                <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Riwayat Bimbingan</h1>
            </div>
            <span class="inline-flex items-center gap-2 px-3 py-1 bg-slate-100 text-slate-700 text-sm font-semibold rounded-full border border-slate-200">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Total Bimbingan: {{ $totalBimbingan }} Kali <span class="text-slate-300">|</span> Syarat Minimal: {{ $syaratMinimal }} Kali
            </span>
        </div>
        @if ($pendaftaran)
            <button @click="isModalOpen = true" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-sm transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Ajukan Bimbingan Baru
            </button>
        @else
            <button disabled title="Anda belum memiliki pendaftaran MBKM aktif" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-300 text-slate-500 font-bold rounded-lg shadow-sm cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Ajukan Bimbingan Baru
            </button>
        @endif
    </div>

    {{-- Tabel Riwayat Bimbingan --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal Pengajuan</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Jadwal Pelaksanaan</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Topik Bimbingan</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Tipe</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse ($bimbingans as $bimbingan)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-6 text-slate-600">
                                {{ $bimbingan->created_at ? $bimbingan->created_at->translatedFormat('d M Y') : '-' }}
                            </td>
                            <td class="py-4 px-6">
                                <p class="font-semibold text-slate-800">
                                    {{ \Carbon\Carbon::parse($bimbingan->tanggal)->translatedFormat('d M Y') }}
                                </p>
                                <p class="text-xs text-slate-500">
                                    {{ $bimbingan->jam ? \Carbon\Carbon::parse($bimbingan->jam)->format('H:i') . ' WIB' : 'Belum diatur' }}
                                </p>
                            </td>
                            <td class="py-4 px-6 font-medium text-slate-900 text-wrap break-all max-w-xs">
                                {{ $bimbingan->topik }}
                            </td>
                            <td class="py-4 px-6">
                                @if ($bimbingan->tipe === 'online')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-600 border border-blue-200">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        Online
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        Offline
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                @if ($bimbingan->status === 'menunggu')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">
                                        Menunggu
                                    </span>
                                @elseif ($bimbingan->status === 'terjadwal')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                        Terjadwal
                                    </span>
                                @elseif ($bimbingan->status === 'selesai')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                @if ($bimbingan->tipe === 'online' && $bimbingan->link_meeting)
                                    <a href="{{ $bimbingan->link_meeting }}" target="_blank" class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-800 font-semibold text-xs border border-blue-200 hover:bg-blue-50 px-3 py-1.5 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        Lihat Link
                                    </a>
                                @else
                                    <span class="text-slate-400 font-medium text-lg">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 px-6 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                    <p class="font-medium text-slate-600">Belum ada riwayat bimbingan</p>
                                    <p class="text-xs text-slate-400">Silakan ajukan bimbingan baru dengan menekan tombol di atas.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Form Pengajuan --}}
    <div x-show="isModalOpen" 
         class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden p-4 sm:p-0"
         style="display: none;">
        
        {{-- Overlay Transparan --}}
        <div x-show="isModalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="isModalOpen = false"
             class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm"></div>

        {{-- Modal Card --}}
        <div x-show="isModalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4 sm:translate-y-0"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4 sm:translate-y-0"
             class="relative bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-auto my-8 flex flex-col max-h-[90vh]">
             
            {{-- Modal Header --}}
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between sticky top-0 bg-white rounded-t-2xl z-10">
                <div>
                    <h3 class="text-xl font-bold text-slate-900">Ajukan Bimbingan Baru</h3>
                    <p class="text-sm text-slate-500">Jadwalkan sesi dengan Dosen Pembimbing Anda.</p>
                </div>
                <button @click="isModalOpen = false" class="text-slate-400 hover:text-slate-600 hover:bg-slate-100 p-2 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            {{-- Modal Body (Scrollable) --}}
            <div class="px-6 py-6 overflow-y-auto flex-1">
                <form id="formBimbingan" action="{{ route('mahasiswa.bimbingan.store') }}" method="POST" class="space-y-6">
                    @csrf
                    {{-- Topik Bimbingan --}}
                    <div class="space-y-2">
                        <label for="topik" class="block text-sm font-semibold text-slate-700">Topik Bimbingan <span class="text-red-500">*</span></label>
                        <input type="text" id="topik" name="topik" value="{{ old('topik') }}" placeholder="Contoh: Pembahasan Bab 1 & 2" class="w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 text-slate-900 @error('topik') border-red-500 @enderror" required>
                        @error('topik')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tipe Pelaksanaan --}}
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-slate-700">Tipe Pelaksanaan <span class="text-red-500">*</span></label>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <label class="relative flex-1 flex items-center gap-3 p-3 border rounded-xl cursor-pointer transition-all duration-200"
                                   :class="tipeBimbingan === 'offline' ? 'border-blue-600 bg-blue-50 ring-1 ring-blue-600' : 'border-gray-200 hover:border-blue-300'">
                                <input type="radio" name="tipe" value="offline" x-model="tipeBimbingan" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                <span class="font-bold text-sm text-slate-900">Tatap Muka (Offline)</span>
                            </label>

                            <label class="relative flex-1 flex items-center gap-3 p-3 border rounded-xl cursor-pointer transition-all duration-200"
                                   :class="tipeBimbingan === 'online' ? 'border-blue-600 bg-blue-50 ring-1 ring-blue-600' : 'border-gray-200 hover:border-blue-300'">
                                <input type="radio" name="tipe" value="online" x-model="tipeBimbingan" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                <span class="font-bold text-sm text-slate-900">Daring (Online)</span>
                            </label>
                        </div>
                        @error('tipe')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Link Meeting (Conditional) --}}
                    <div x-show="tipeBimbingan === 'online'" 
                         x-transition
                         class="space-y-2 p-4 bg-blue-50/50 border border-blue-100 rounded-xl" style="display: none;">
                        <label for="link_meeting" class="block text-sm font-semibold text-blue-900">Link Meeting (GMeet/Zoom) <span class="text-red-500">*</span></label>
                        <input type="url" id="link_meeting" name="link_meeting" value="{{ old('link_meeting') }}" placeholder="https://meet.google.com/..." class="w-full border border-blue-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2.5 text-slate-900 @error('link_meeting') border-red-500 @enderror" :required="tipeBimbingan === 'online'">
                        @error('link_meeting')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </form>
            </div>

            {{-- Modal Footer --}}
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-2xl flex justify-end gap-3 sticky bottom-0 z-10">
                <button @click="isModalOpen = false" type="button" class="px-5 py-2.5 rounded-lg font-bold text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <button form="formBimbingan" type="submit" class="px-6 py-2.5 rounded-lg font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-sm transition-colors">
                    Kirim Pengajuan
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
