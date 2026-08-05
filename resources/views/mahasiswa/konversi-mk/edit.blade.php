@extends('layouts.mahasiswa')

@section('title', 'Edit Mata Kuliah - Mahasiswa')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8 animate-fade-in-up">
        <div class="flex items-center gap-4">
            <a href="{{ route('mahasiswa.konversi-mk.index') }}" 
               class="bg-white border border-slate-200 p-2.5 rounded-xl text-slate-500 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-200 transition-all duration-300 shadow-sm group flex items-center justify-center"
               title="Kembali">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Edit Mata Kuliah Konversi</h1>
                <p class="text-slate-500 mt-1 font-medium">Perbarui data mata kuliah pada daftar konversi MBKM Anda.</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Form Card (2/3 width on large screens) --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-slate-50 rounded-bl-full opacity-50 -z-10"></div>
                
                <div class="flex items-center gap-3 mb-8 pb-6 border-b border-slate-100">
                    <div class="bg-slate-50 p-2 rounded-lg text-slate-600 border border-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <h2 class="text-lg font-bold text-slate-800">Formulir Mata Kuliah Konversi</h2>
                </div>

                <form action="{{ route('mahasiswa.konversi-mk.update', $detail->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Kode Mata Kuliah --}}
                    <div>
                        <label for="kode_mk" class="block text-xs font-bold text-slate-700 uppercase mb-2 tracking-wide">
                            Kode Mata Kuliah <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="kode_mk"
                               name="kode_mk"
                               value="{{ old('kode_mk', $detail->mataKuliah?->kode_mk) }}"
                               placeholder="Contoh: IF1234"
                               class="w-full px-4 py-3.5 bg-slate-50 border @error('kode_mk') border-red-500 bg-red-50 @else border-slate-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 font-medium uppercase">
                        <p class="text-xs font-medium text-slate-500 mt-2">Format: 2 huruf kapital + 4 angka (contoh: IF1234)</p>
                        @error('kode_mk')
                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nama Mata Kuliah --}}
                    <div>
                        <label for="nama_mk" class="block text-xs font-bold text-slate-700 uppercase mb-2 tracking-wide">
                            Nama Mata Kuliah <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="nama_mk"
                               name="nama_mk"
                               value="{{ old('nama_mk', $detail->mataKuliah?->nama_mk) }}"
                               placeholder="Contoh: Magang Industri I"
                               class="w-full px-4 py-3.5 bg-slate-50 border @error('nama_mk') border-red-500 bg-red-50 @else border-slate-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 font-medium">
                        @error('nama_mk')
                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- SKS --}}
                    <div>
                        <label for="sks" class="block text-xs font-bold text-slate-700 uppercase mb-2 tracking-wide">
                            SKS <span class="text-red-500">*</span>
                        </label>
                        <input type="number"
                               id="sks"
                               name="sks"
                               value="{{ old('sks', $detail->mataKuliah?->sks) }}"
                               min="1"
                               max="24"
                               placeholder="Contoh: 4"
                               class="w-full px-4 py-3.5 bg-slate-50 border @error('sks') border-red-500 bg-red-50 @else border-slate-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 font-medium">
                        @error('sks')
                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-6 border-t border-slate-100">
                        <button type="submit"
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-6 rounded-xl transition-all duration-300 shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('mahasiswa.konversi-mk.index') }}"
                           class="flex-1 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold py-3.5 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Sidebar (1/3 width) --}}
        <div class="lg:col-span-1">
            {{-- Info Card --}}
            <div class="bg-white border-l-4 border-yellow-400 rounded-2xl p-6 shadow-sm border-y border-r border-slate-200 relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-yellow-50 rounded-full opacity-50 z-0"></div>
                <div class="relative z-10 flex items-start gap-4">
                    <div class="bg-yellow-50 p-2.5 rounded-xl text-yellow-600 flex-shrink-0 mt-0.5 border border-yellow-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-lg mb-1">Perhatian</h4>
                        <p class="text-sm text-slate-600 font-medium leading-relaxed">
                            Data mata kuliah hanya dapat diubah selama status konversi masih <strong>Pending</strong> atau <strong>Ditolak</strong>. Setelah diajukan, data tidak dapat diubah.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
