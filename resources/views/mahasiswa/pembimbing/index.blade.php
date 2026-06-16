@extends('layouts.mahasiswa')

@section('title', 'Pembimbing - Mahasiswa')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Pembimbing</h1>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Dosen Pembimbing Card --}}
    <div class="bg-white rounded-xl shadow-md p-8 mb-8">
        {{-- Card Header --}}
        <div class="flex items-center justify-between mb-8 pb-6 border-b border-slate-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM15 20H9m0 0H4m11 0a3 3 0 01-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900">Dosen Pembimbing</h3>
            </div>
            <span class="inline-block bg-blue-600 text-white text-xs font-semibold px-4 py-2 rounded-full">Ditentukan oleh Admin</span>
        </div>

        {{-- Content: 2 columns --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Dosen Pembimbing Section --}}
            <div class="bg-slate-50 rounded-xl p-6">
                <p class="text-xs font-semibold text-slate-600 uppercase mb-4">Dosen Pembimbing</p>
                @if($pendaftaran && $pendaftaran->dosenPembimbing)
                    <h4 class="text-lg font-bold text-slate-900 mb-1">{{ $pendaftaran->dosenPembimbing->user->name }}</h4>
                    <p class="text-sm text-slate-600 mb-4">Dosen Pembimbing Akademik</p>
                    <div class="space-y-2">
                        <div>
                            <p class="text-xs text-slate-600">NIP</p>
                            <p class="text-sm font-semibold text-slate-900">{{ $pendaftaran->dosenPembimbing->nip }}</p>
                        </div>
                        @if($pendaftaran->dosenPembimbing->no_telp)
                        <div>
                            <p class="text-xs text-slate-600">No. Telepon</p>
                            <p class="text-sm font-semibold text-slate-900">{{ $pendaftaran->dosenPembimbing->no_telp }}</p>
                        </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <p class="text-slate-500 font-medium">Belum ada dosen pembimbing</p>
                        <p class="text-sm text-slate-400 mt-1">Menunggu penugasan dari admin</p>
                    </div>
                @endif
            </div>

            {{-- Dosen Penguji Section --}}
            <div class="bg-slate-50 rounded-xl p-6">
                <p class="text-xs font-semibold text-slate-600 uppercase mb-4">Dosen Penguji</p>
                @if($pendaftaran && $pendaftaran->dosenPenguji)
                    <h4 class="text-lg font-bold text-slate-900 mb-1">{{ $pendaftaran->dosenPenguji->user->name }}</h4>
                    <p class="text-sm text-slate-600 mb-4">Dosen Penguji MBKM</p>
                    <div class="space-y-2">
                        <div>
                            <p class="text-xs text-slate-600">NIP</p>
                            <p class="text-sm font-semibold text-slate-900">{{ $pendaftaran->dosenPenguji->nip }}</p>
                        </div>
                        @if($pendaftaran->dosenPenguji->no_telp)
                        <div>
                            <p class="text-xs text-slate-600">No. Telepon</p>
                            <p class="text-sm font-semibold text-slate-900">{{ $pendaftaran->dosenPenguji->no_telp }}</p>
                        </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <p class="text-slate-500 font-medium">Belum ada dosen penguji</p>
                        <p class="text-sm text-slate-400 mt-1">Menunggu penugasan dari admin</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Pembimbing Lapangan Card --}}
    <div class="bg-white rounded-xl shadow-md p-8 mb-8 relative overflow-hidden">
        {{-- Decorative shape --}}
        <div class="absolute top-0 right-0 w-32 h-32 bg-slate-100 rounded-bl-3xl opacity-50"></div>

        {{-- Card Header --}}
        <div class="flex items-center gap-4 mb-8 pb-6 border-b border-slate-200 relative z-10">
            <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-900">Pembimbing Lapangan</h3>
        </div>

        {{-- Form Content --}}
        <form action="{{ route('mahasiswa.pembimbing.update-lapangan') }}" method="POST" class="space-y-6 relative z-10">
            @csrf
            
            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <ul class="text-sm text-red-700 list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Nama Pembimbing Lapangan --}}
            <div>
                <label class="block text-xs font-semibold text-slate-700 uppercase mb-3">Nama Pembimbing Lapangan <span class="text-red-500">*</span></label>
                <input type="text" name="narahubung" placeholder="Masukkan nama pembimbing" class="w-full bg-slate-100 text-slate-900 placeholder-slate-500 rounded-full px-6 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-200 @error('narahubung') border-2 border-red-500 @enderror" value="{{ old('narahubung', $pembimbingLapangan['nama'] ?? '') }}" required>
                @error('narahubung')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nomor WhatsApp --}}
            <div>
                <label class="block text-xs font-semibold text-slate-700 uppercase mb-3">Nomor WhatsApp <span class="text-red-500">*</span></label>
                <input type="text" name="no_telp_narahubung" placeholder="+62 812xxxxxxxx" class="w-full bg-slate-100 text-slate-900 placeholder-slate-500 rounded-full px-6 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-200 @error('no_telp_narahubung') border-2 border-red-500 @enderror" value="{{ old('no_telp_narahubung', $pembimbingLapangan['no_telp'] ?? '') }}" required>
                @error('no_telp_narahubung')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Info Box --}}
            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 mt-6">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm text-blue-800">Isi sesuai dengan pembimbing di tempat magang. Data ini digunakan untuk verifikasi laporan anda</p>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-slate-200">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transition-all duration-200 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    {{ $pembimbingLapangan && $pembimbingLapangan['nama'] ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </form>
    </div>

    {{-- Footer Text --}}
    <div class="text-center text-sm text-slate-500 mt-12 py-8 border-t border-slate-200">
        <p>© 2024 Lumni University Academic System</p>
    </div>
@endsection
