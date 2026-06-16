@extends('layouts.admin')

@section('title', 'Edit Mitra - Admin')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.mitra.index') }}" class="bg-slate-100 hover:bg-slate-200 p-2 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Edit Mitra MBKM</h1>
                <p class="text-slate-600 mt-1">Perbarui informasi mitra industri atau perusahaan</p>
            </div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden max-w-3xl">
        <form action="{{ route('admin.mitra.update', $mitra->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Form Body --}}
            <div class="p-8">
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

                {{-- Error Messages --}}
                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-red-800 mb-2">Terdapat kesalahan:</p>
                                <ul class="text-sm text-red-700 list-disc list-inside space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Section: Informasi Mitra --}}
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="text-blue-700 font-bold text-sm">1</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Informasi Mitra</h3>
                    </div>

                    <div class="space-y-5">
                        {{-- Nama Mitra --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                NAMA MITRA <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_mitra" value="{{ old('nama_mitra', $mitra->nama_mitra) }}" placeholder="Contoh: PT Teknologi Nusantara" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nama_mitra') border-red-500 @enderror" required>
                            @error('nama_mitra')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Lokasi --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                LOKASI (KOTA) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="lokasi" value="{{ old('lokasi', $mitra->lokasi) }}" placeholder="Contoh: Jakarta, Bandung, Surabaya" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('lokasi') border-red-500 @enderror" required>
                            @error('lokasi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Alamat Lengkap --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                ALAMAT LENGKAP <span class="text-red-500">*</span>
                            </label>
                            <textarea name="alamat" placeholder="Contoh: Jl. Gatot Subroto No. 12, Kuningan Timur, Jakarta Selatan 12950" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none @error('alamat') border-red-500 @enderror" rows="3" required>{{ old('alamat', $mitra->alamat) }}</textarea>
                            @error('alamat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="border-t border-slate-200 my-8"></div>

                {{-- Section: Kontak Person --}}
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="text-blue-700 font-bold text-sm">2</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Kontak Person</h3>
                    </div>

                    <div class="space-y-5">
                        {{-- Narahubung --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                NAMA NARAHUBUNG <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="narahubung" value="{{ old('narahubung', $mitra->narahubung) }}" placeholder="Contoh: Budi Santoso" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('narahubung') border-red-500 @enderror" required>
                            @error('narahubung')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- No Telp --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                NO. TELEPON NARAHUBUNG <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="no_telp_narahubung" value="{{ old('no_telp_narahubung', $mitra->no_telp_narahubung) }}" placeholder="Contoh: 081234567890 atau 021-12345678" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('no_telp_narahubung') border-red-500 @enderror" required>
                            @error('no_telp_narahubung')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Info Box --}}
                <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="font-semibold text-amber-900 text-sm mb-1">Perhatian</h4>
                            <p class="text-sm text-amber-800">
                                Perubahan data mitra akan mempengaruhi informasi yang ditampilkan untuk semua mahasiswa 
                                yang terhubung dengan mitra ini. Pastikan data yang diinput sudah benar.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Footer --}}
            <div class="bg-slate-50 px-8 py-4 border-t border-slate-200 flex gap-4">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Update Mitra
                </button>
                <a href="{{ route('admin.mitra.index') }}" class="flex-1 border-2 border-slate-300 text-slate-600 hover:bg-slate-100 font-semibold py-3 px-6 rounded-lg transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
