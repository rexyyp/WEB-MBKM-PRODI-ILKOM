@extends('layouts.mahasiswa')

@section('title', 'Tambah Mata Kuliah - Mahasiswa')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8 flex flex-col justify-center">
        <a href="{{ route('mahasiswa.konversi-mk.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2 mb-4 text-sm font-medium transition-colors w-fit">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Konversi Mata Kuliah
        </a>
        <h1 class="text-4xl font-bold text-slate-900 mb-2">Tambah Mata Kuliah Konversi</h1>
        <p class="text-slate-600 text-lg">Masukkan data mata kuliah baru untuk konversi MBKM Anda.</p>
    </div>

    {{-- Form Card --}}
    <div class="max-w-3xl">
        <div class="bg-white rounded-xl shadow-md p-8">
            <form class="space-y-6">
                {{-- Kode Mata Kuliah --}}
                <div>
                    <label for="kodeMk" class="block text-sm font-semibold text-slate-900 mb-2">Kode Mata Kuliah <span class="text-red-500">*</span></label>
                    <input type="text" id="kodeMk" placeholder="Contoh: IF1234" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    <p class="text-xs text-slate-600 mt-1">Format: 2 huruf + 4 angka (contoh: IF1234)</p>
                </div>

                {{-- Nama Mata Kuliah --}}
                <div>
                    <label for="namaMk" class="block text-sm font-semibold text-slate-900 mb-2">Nama Mata Kuliah <span class="text-red-500">*</span></label>
                    <input type="text" id="namaMk" placeholder="Contoh: Magang Industri I" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                </div>

                {{-- SKS --}}
                <div>
                    <label for="sks" class="block text-sm font-semibold text-slate-900 mb-2">SKS <span class="text-red-500">*</span></label>
                    <input type="number" id="sks" min="1" max="20" placeholder="Contoh: 10" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                </div>


                {{-- Action Buttons --}}
                <div class="flex gap-3 pt-4 border-t border-slate-200">
                    <a href="{{ route('mahasiswa.konversi-mk.index') }}" class="px-6 py-3 border border-slate-300 text-slate-700 font-semibold rounded-lg hover:bg-slate-50 transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Mata Kuliah
                    </button>
                </div>
            </form>
        </div>

        {{-- Info Card --}}
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-start gap-4">
            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM9 13a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"></path>
            </svg>
            <div>
                <p class="text-sm font-semibold text-blue-900 mb-1">Informasi</p>
                <p class="text-sm text-blue-800">Pastikan data mata kuliah sudah benar sebelum menambahkan. Anda dapat mengedit atau menghapus data mata kuliah nanti jika diperlukan.</p>
            </div>
        </div>
    </div>
@endsection
