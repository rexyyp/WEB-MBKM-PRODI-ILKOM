@extends('layouts.mahasiswa')

@section('title', 'Pembimbing - Mahasiswa')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8 animate-fade-in-up">
        <div class="flex items-center gap-4">
            <div class="bg-blue-50 border border-blue-100 p-3.5 rounded-2xl text-blue-600 shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Data Pembimbing</h1>
                <p class="text-slate-500 mt-1 font-medium">Informasi pembimbing akademik dan pembimbing lapangan Anda.</p>
            </div>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-white border-l-4 border-green-500 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-8">
            <div class="bg-green-50 p-2.5 rounded-xl text-green-600 flex-shrink-0 mt-0.5 border border-green-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-slate-800 font-bold text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="bg-white border-l-4 border-red-500 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-8">
            <div class="bg-red-50 p-2.5 rounded-xl text-red-600 flex-shrink-0 mt-0.5 border border-red-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
            <div>
                <p class="text-red-800 font-bold text-sm">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        {{-- Dosen Pembimbing & Penguji Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-slate-50 rounded-bl-full opacity-50 -z-10"></div>
            
            {{-- Card Header --}}
            <div class="flex items-center justify-between mb-8 pb-6 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="bg-slate-50 p-2 rounded-lg text-slate-600 border border-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Dosen Kampus</h3>
                </div>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                    Ditentukan Admin
                </span>
            </div>

            <div class="space-y-6">
                {{-- Dosen Pembimbing Section --}}
                <div class="bg-slate-50 rounded-xl p-6 border border-slate-100 hover:border-blue-100 transition-colors">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Dosen Pembimbing Akademik</p>
                    @if($pendaftaran && $pendaftaran->dosenPembimbing)
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 font-bold text-lg flex items-center justify-center flex-shrink-0">
                                {{ substr($pendaftaran->dosenPembimbing->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="text-base font-bold text-slate-800 mb-2">{{ $pendaftaran->dosenPembimbing->user->name }}</h4>
                                <div class="flex flex-wrap items-center gap-x-5 gap-y-2 mt-1">
                                    <div class="flex items-center gap-2 text-sm text-slate-600 font-medium">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                        {{ $pendaftaran->dosenPembimbing->nip }}
                                    </div>
                                    @if($pendaftaran->dosenPembimbing->no_telp)
                                    <div class="flex items-center gap-2 text-sm text-slate-600 font-medium">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        {{ $pendaftaran->dosenPembimbing->no_telp }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-6">
                            <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <p class="text-slate-500 font-bold text-sm">Belum ditentukan</p>
                            <p class="text-xs text-slate-400 font-medium mt-1">Menunggu penugasan admin</p>
                        </div>
                    @endif
                </div>

                {{-- Dosen Penguji Section --}}
                <div class="bg-slate-50 rounded-xl p-6 border border-slate-100 hover:border-blue-100 transition-colors">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Dosen Penguji MBKM</p>
                    @if($pendaftaran && $pendaftaran->dosenPenguji)
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 font-bold text-lg flex items-center justify-center flex-shrink-0">
                                {{ substr($pendaftaran->dosenPenguji->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="text-base font-bold text-slate-800 mb-2">{{ $pendaftaran->dosenPenguji->user->name }}</h4>
                                <div class="flex flex-wrap items-center gap-x-5 gap-y-2 mt-1">
                                    <div class="flex items-center gap-2 text-sm text-slate-600 font-medium">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                        {{ $pendaftaran->dosenPenguji->nip }}
                                    </div>
                                    @if($pendaftaran->dosenPenguji->no_telp)
                                    <div class="flex items-center gap-2 text-sm text-slate-600 font-medium">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        {{ $pendaftaran->dosenPenguji->no_telp }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-6">
                            <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <p class="text-slate-500 font-bold text-sm">Belum ditentukan</p>
                            <p class="text-xs text-slate-400 font-medium mt-1">Menunggu penugasan admin</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Pembimbing Lapangan Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 relative overflow-hidden flex flex-col">
            <div class="absolute top-0 left-0 w-64 h-64 bg-slate-50 rounded-br-full opacity-50 -z-10"></div>

            {{-- Card Header --}}
            <div class="flex items-center gap-3 mb-8 pb-6 border-b border-slate-100">
                <div class="bg-slate-50 p-2 rounded-lg text-slate-600 border border-slate-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Pembimbing Lapangan</h3>
            </div>

            {{-- Form Content --}}
            <form action="{{ route('mahasiswa.pembimbing.update-lapangan') }}" method="POST" class="flex-grow flex flex-col">
                @csrf
                
                {{-- Validation Errors --}}
                @if($errors->any())
                    <div class="bg-white border-l-4 border-red-500 rounded-xl p-5 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-6">
                        <div class="bg-red-50 p-2 rounded-lg text-red-600 flex-shrink-0 mt-0.5 border border-red-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                        <div>
                            <ul class="text-sm text-red-800 list-disc list-inside font-medium">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="space-y-6 flex-grow">
                    {{-- Nama Pembimbing Lapangan --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-2 tracking-wide">Nama Pembimbing Lapangan <span class="text-red-500">*</span></label>
                        <input type="text" name="narahubung" placeholder="Masukkan nama pembimbing" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 font-medium @error('narahubung') border-red-500 bg-red-50 @enderror" value="{{ old('narahubung', $pembimbingLapangan['nama'] ?? '') }}" required>
                        @error('narahubung')
                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nomor WhatsApp --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-2 tracking-wide">Nomor WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" name="no_telp_narahubung" placeholder="+62 812xxxxxxxx" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 font-medium @error('no_telp_narahubung') border-red-500 bg-red-50 @enderror" value="{{ old('no_telp_narahubung', $pembimbingLapangan['no_telp'] ?? '') }}" required>
                        @error('no_telp_narahubung')
                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Info Box --}}
                    <div class="bg-blue-50 border-l-4 border-blue-500 rounded-xl p-4 flex items-start gap-3 mt-4">
                        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-xs font-medium text-blue-800 leading-relaxed">Isi sesuai dengan pembimbing di tempat magang. Data ini digunakan untuk keperluan verifikasi laporan Anda.</p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-8 pt-6 border-t border-slate-100">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        {{ $pembimbingLapangan && $pembimbingLapangan['nama'] ? 'Simpan Perubahan' : 'Simpan Pembimbing' }}
                    </button>
                </div>
            </form>
        </div>
    </div>


@endsection
