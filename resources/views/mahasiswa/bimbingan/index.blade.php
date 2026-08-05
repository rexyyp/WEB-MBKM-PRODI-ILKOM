@extends('layouts.mahasiswa')

@section('title', 'Riwayat Bimbingan')

@section('content')
<div x-data="{ isModalOpen: {{ $errors->any() ? 'true' : 'false' }}, tipeBimbingan: '{{ old('tipe', 'offline') }}' }">
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

    {{-- Header & Summary --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-start justify-between gap-6 animate-fade-in-up">
        <div class="flex items-start gap-4">
            <div class="bg-blue-50 border border-blue-100 p-3.5 rounded-2xl text-blue-600 shadow-sm shrink-0">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Riwayat Bimbingan</h1>
                <p class="text-slate-500 mt-1 font-medium mb-3">Pantau dan ajukan jadwal bimbingan dengan Dosen Pembimbing Anda.</p>
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-slate-50 text-slate-600 text-sm font-bold rounded-lg border border-slate-200 shadow-sm">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Total Bimbingan: <span class="text-blue-600">{{ $totalBimbingan }} Kali</span>
                    <span class="text-slate-300 mx-1">|</span> 
                    Syarat Minimal: <span class="text-slate-800">{{ $syaratMinimal }} Kali</span>
                </div>
            </div>
        </div>

        @if ($pendaftaran)
            <button @click="isModalOpen = true" class="px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all duration-300 flex items-center gap-2 shadow-sm hover:shadow-md shrink-0 w-fit">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Ajukan Bimbingan
            </button>
        @else
            <button disabled title="Anda belum memiliki pendaftaran MBKM aktif" class="px-6 py-3.5 bg-slate-100 border border-slate-200 text-slate-400 font-bold rounded-xl shadow-sm cursor-not-allowed flex items-center gap-2 shrink-0 w-fit">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Ajukan Bimbingan
            </button>
        @endif
    </div>

    {{-- Tabel Riwayat Bimbingan --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-8">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
            <div class="bg-slate-50 p-2 rounded-lg text-slate-600 border border-slate-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
            </div>
            <h2 class="text-lg font-bold text-slate-800">Daftar Pengajuan Bimbingan</h2>
        </div>

        <div class="overflow-x-auto rounded-xl border border-slate-100">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 text-xs uppercase tracking-wider font-bold">
                        <th class="py-4 px-6 rounded-tl-xl">Tanggal Pengajuan</th>
                        <th class="py-4 px-6">Jadwal Pelaksanaan</th>
                        <th class="py-4 px-6">Topik Bimbingan</th>
                        <th class="py-4 px-6 text-center">Tipe</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-right rounded-tr-xl">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($bimbingans as $bimbingan)
                        <tr class="hover:bg-slate-50/50 transition-colors duration-200">
                            <td class="py-4 px-6 text-slate-600 font-medium">
                                {{ $bimbingan->created_at ? $bimbingan->created_at->translatedFormat('d M Y') : '-' }}
                            </td>
                            <td class="py-4 px-6">
                                <p class="font-bold text-slate-800">
                                    {{ \Carbon\Carbon::parse($bimbingan->tanggal)->translatedFormat('d M Y') }}
                                </p>
                                <p class="text-xs font-semibold text-slate-500 mt-0.5">
                                    {{ $bimbingan->jam ? \Carbon\Carbon::parse($bimbingan->jam)->format('H:i') . ' WIB' : 'Belum diatur' }}
                                </p>
                            </td>
                            <td class="py-4 px-6 font-semibold text-slate-800 text-wrap break-all max-w-xs">
                                {{ $bimbingan->topik }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if ($bimbingan->tipe === 'online')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        Online
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-slate-50 text-slate-600 border border-slate-200">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        Offline
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if ($bimbingan->status === 'menunggu')
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-yellow-50 text-yellow-700 border border-yellow-100">
                                        Menunggu
                                    </span>
                                @elseif ($bimbingan->status === 'terjadwal')
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                        Terjadwal
                                    </span>
                                @elseif ($bimbingan->status === 'selesai')
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-100">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                @if ($bimbingan->tipe === 'online' && $bimbingan->link_meeting)
                                    <a href="{{ $bimbingan->link_meeting }}" target="_blank" class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-700 font-bold text-xs bg-blue-50 border border-blue-100 hover:bg-blue-100 px-3 py-2 rounded-lg transition-colors">
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
                            <td colspan="6" class="py-12 px-6 text-center">
                                <div class="flex flex-col items-center justify-center gap-3 text-slate-400">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center border border-slate-100 mb-2">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                    </div>
                                    <p class="font-bold text-slate-500">Belum ada riwayat bimbingan</p>
                                    <p class="text-sm font-medium">Silakan ajukan bimbingan baru dengan menekan tombol di atas.</p>
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
             class="relative bg-white rounded-2xl shadow-xl border border-slate-200 w-full max-w-2xl mx-auto my-8 flex flex-col max-h-[90vh]">
             
            {{-- Modal Header --}}
            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between sticky top-0 bg-white rounded-t-2xl z-10">
                <div class="flex items-center gap-4">
                    <div class="bg-slate-50 p-2.5 rounded-xl text-slate-600 border border-slate-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">Ajukan Bimbingan Baru</h3>
                        <p class="text-sm font-medium text-slate-500">Jadwalkan sesi dengan Dosen Pembimbing Anda.</p>
                    </div>
                </div>
                <button @click="isModalOpen = false" class="text-slate-400 hover:text-slate-600 bg-slate-50 hover:bg-slate-100 p-2 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            {{-- Modal Body (Scrollable) --}}
            <div class="px-8 py-6 overflow-y-auto flex-1">
                <form id="formBimbingan" action="{{ route('mahasiswa.bimbingan.store') }}" method="POST" class="space-y-6">
                    @csrf
                    {{-- Topik Bimbingan --}}
                    <div>
                        <label for="topik" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Topik Bimbingan <span class="text-red-500">*</span></label>
                        <input type="text" id="topik" name="topik" value="{{ old('topik') }}" placeholder="Contoh: Pembahasan Bab 1 & 2" class="w-full bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium px-4 py-3.5 text-slate-800 transition-all @error('topik') border-red-500 @enderror" required>
                        @error('topik')
                            <p class="text-red-500 text-xs font-medium mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tipe Pelaksanaan --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tipe Pelaksanaan <span class="text-red-500">*</span></label>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <label class="relative flex-1 flex items-center gap-3 p-4 border rounded-xl cursor-pointer transition-all duration-300"
                                   :class="tipeBimbingan === 'offline' ? 'border-blue-500 bg-blue-50 ring-1 ring-blue-500' : 'border-slate-200 hover:border-blue-300 bg-slate-50'">
                                <input type="radio" name="tipe" value="offline" x-model="tipeBimbingan" class="w-4 h-4 text-blue-600 border-slate-300 focus:ring-blue-500">
                                <span class="font-bold text-sm text-slate-800">Tatap Muka (Offline)</span>
                            </label>

                            <label class="relative flex-1 flex items-center gap-3 p-4 border rounded-xl cursor-pointer transition-all duration-300"
                                   :class="tipeBimbingan === 'online' ? 'border-blue-500 bg-blue-50 ring-1 ring-blue-500' : 'border-slate-200 hover:border-blue-300 bg-slate-50'">
                                <input type="radio" name="tipe" value="online" x-model="tipeBimbingan" class="w-4 h-4 text-blue-600 border-slate-300 focus:ring-blue-500">
                                <span class="font-bold text-sm text-slate-800">Daring (Online)</span>
                            </label>
                        </div>
                        @error('tipe')
                            <p class="text-red-500 text-xs font-medium mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Link Meeting (Conditional) --}}
                    <div x-show="tipeBimbingan === 'online'" 
                         x-transition
                         class="p-5 bg-blue-50 border border-blue-100 rounded-xl" style="display: none;">
                        <label for="link_meeting" class="block text-xs font-bold text-blue-800 uppercase tracking-wider mb-2">Link Meeting (GMeet/Zoom) <span class="text-red-500">*</span></label>
                        <input type="url" id="link_meeting" name="link_meeting" value="{{ old('link_meeting') }}" placeholder="https://meet.google.com/..." class="w-full bg-white border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium px-4 py-3 text-slate-800 transition-all @error('link_meeting') border-red-500 @enderror" :required="tipeBimbingan === 'online'">
                        @error('link_meeting')
                            <p class="text-red-500 text-xs font-medium mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                </form>
            </div>

            {{-- Modal Footer --}}
            <div class="px-8 py-5 border-t border-slate-100 bg-slate-50 rounded-b-2xl flex justify-end gap-3 sticky bottom-0 z-10">
                <button @click="isModalOpen = false" type="button" class="px-6 py-3 rounded-xl font-bold text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <button form="formBimbingan" type="submit" class="px-6 py-3 rounded-xl font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-sm hover:shadow-md transition-all flex items-center gap-2">
                    Kirim Pengajuan
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
