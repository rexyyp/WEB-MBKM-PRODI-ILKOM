@extends('layouts.mahasiswa')

@section('title', 'Edit Mata Kuliah - Mahasiswa')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8 flex flex-col justify-center">
        <a href="{{ route('mahasiswa.konversi-mk.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2 mb-4 text-sm font-medium transition-colors w-fit">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Konversi Mata Kuliah
        </a>
        <h1 class="text-4xl font-bold text-slate-900 mb-2">Edit Mata Kuliah Konversi</h1>
        <p class="text-slate-600 text-lg">Perbarui data mata kuliah pada daftar konversi MBKM Anda.</p>
    </div>

    {{-- Form Card --}}
    <div class="max-w-3xl">
        <div class="bg-white rounded-xl shadow-md p-8">
            <form action="{{ route('mahasiswa.konversi-mk.update', $detail->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Kode Mata Kuliah --}}
                <div>
                    <label for="kode_mk" class="block text-sm font-semibold text-slate-900 mb-2">
                        Kode Mata Kuliah <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="kode_mk"
                           name="kode_mk"
                           value="{{ old('kode_mk', $detail->mataKuliah?->kode_mk) }}"
                           placeholder="Contoh: IF1234"
                           class="w-full px-4 py-3 border @error('kode_mk') border-red-400 bg-red-50 @else border-slate-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 uppercase">
                    <p class="text-xs text-slate-500 mt-1">Format: 2 huruf kapital + 4 angka (contoh: IF1234)</p>
                    @error('kode_mk')
                        <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nama Mata Kuliah --}}
                <div>
                    <label for="nama_mk" class="block text-sm font-semibold text-slate-900 mb-2">
                        Nama Mata Kuliah <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="nama_mk"
                           name="nama_mk"
                           value="{{ old('nama_mk', $detail->mataKuliah?->nama_mk) }}"
                           placeholder="Contoh: Magang Industri I"
                           class="w-full px-4 py-3 border @error('nama_mk') border-red-400 bg-red-50 @else border-slate-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    @error('nama_mk')
                        <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- SKS --}}
                <div>
                    <label for="sks" class="block text-sm font-semibold text-slate-900 mb-2">
                        SKS <span class="text-red-500">*</span>
                    </label>
                    <input type="number"
                           id="sks"
                           name="sks"
                           value="{{ old('sks', $detail->mataKuliah?->sks) }}"
                           min="1"
                           max="24"
                           placeholder="Contoh: 4"
                           class="w-full px-4 py-3 border @error('sks') border-red-400 bg-red-50 @else border-slate-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    @error('sks')
                        <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-3 pt-4 border-t border-slate-200">
                    <a href="{{ route('mahasiswa.konversi-mk.index') }}"
                       class="px-6 py-3 border border-slate-300 text-slate-700 font-semibold rounded-lg hover:bg-slate-50 transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit"
                            class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- Info Card --}}
        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-xl p-4 flex items-start gap-4">
            <svg class="w-6 h-6 text-yellow-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="text-sm font-semibold text-yellow-900 mb-1">Perhatian</p>
                <p class="text-sm text-yellow-800">Data mata kuliah hanya dapat diubah selama status konversi masih <strong>Pending</strong> atau <strong>Ditolak</strong>. Setelah diajukan, data tidak dapat diubah.</p>
            </div>
        </div>
    </div>
@endsection
