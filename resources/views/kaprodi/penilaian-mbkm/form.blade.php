@extends('layouts.kaprodi')

@section('title', 'Penilaian & Konversi - Kaprodi Panel')

@section('content')
<div class="min-h-screen pb-12">
    {{-- Back Link & Header --}}
    <div class="mb-8">
        <a href="{{ route('kaprodi.penilaian-mbkm.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-blue-600 transition-colors mb-4">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Data Penilaian
        </a>
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Penilaian Konversi Mata Kuliah</h1>
        </div>
        <p class="text-slate-600 text-lg">Input nilai akhir dan konversi SKS untuk kegiatan MBKM mahasiswa</p>
    </div>

    {{-- Card 1: Ringkasan Mahasiswa --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="flex items-center gap-6">
            <div class="h-14 w-14 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xl">
                DP
            </div>
            <div>
                <span class="block text-xl font-bold text-slate-900 leading-tight">Dimas Pratama</span>
                <span class="block text-sm font-medium text-slate-500 mt-1">190123459</span>
            </div>
        </div>
        
        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex items-center gap-4 w-full md:w-auto justify-center md:justify-start shrink-0">
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <span class="block text-xs font-bold text-blue-600 uppercase tracking-wider mb-0.5">Nilai Final MBKM</span>
                <span class="block text-2xl font-extrabold text-slate-900 leading-none">93.6 <span class="text-blue-600">/ A</span></span>
            </div>
        </div>
    </div>

    {{-- Card 2: Form Pemetaan Mata Kuliah --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-800">Daftar Mata Kuliah Terkonversi & Penilaian</h2>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-bold">
                Total: 10 SKS
            </div>
        </div>
        
        <div class="p-6">
            {{-- Table Header --}}
            <div class="hidden md:grid grid-cols-12 gap-4 px-6 py-3 bg-slate-50 rounded-lg mb-3">
                <div class="col-span-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Mata Kuliah Prodi</div>
                <div class="col-span-2 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">SKS</div>
                <div class="col-span-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nilai Huruf</div>
            </div>

            {{-- Static Rows --}}
            <div class="space-y-3">
                
                {{-- Row 1 --}}
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center bg-white border border-slate-200 p-4 md:px-6 md:py-3 rounded-xl md:rounded-lg shadow-sm md:shadow-none hover:border-blue-200 transition-colors">
                    <div class="col-span-1 md:col-span-6 flex flex-col">
                        <label class="block md:hidden text-xs font-semibold text-slate-500 mb-1">Mata Kuliah Prodi</label>
                        <span class="text-sm font-bold text-slate-800">Praktik Kerja Lapangan</span>
                    </div>
                    <div class="col-span-1 md:col-span-2 md:text-center">
                        <label class="block md:hidden text-xs font-semibold text-slate-500 mb-1">SKS</label>
                        <span class="text-sm font-bold text-slate-600 bg-slate-100 px-3 py-1 rounded-md">4 SKS</span>
                    </div>
                    <div class="col-span-1 md:col-span-4">
                        <label class="block md:hidden text-xs font-semibold text-slate-500 mb-1">Nilai Huruf</label>
                        <select class="w-full px-4 py-2 border border-slate-200 rounded-lg bg-slate-50 text-slate-700 text-sm font-bold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all cursor-pointer">
                            <option value="">-- Input Nilai --</option>
                            <option value="A" selected>A (Sangat Baik)</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B">B (Baik)</option>
                            <option value="B-">B-</option>
                            <option value="C">C (Cukup)</option>
                        </select>
                    </div>
                </div>

                {{-- Row 2 --}}
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center bg-white border border-slate-200 p-4 md:px-6 md:py-3 rounded-xl md:rounded-lg shadow-sm md:shadow-none hover:border-blue-200 transition-colors">
                    <div class="col-span-1 md:col-span-6 flex flex-col">
                        <label class="block md:hidden text-xs font-semibold text-slate-500 mb-1">Mata Kuliah Prodi</label>
                        <span class="text-sm font-bold text-slate-800">Pengembangan Perangkat Lunak</span>
                    </div>
                    <div class="col-span-1 md:col-span-2 md:text-center">
                        <label class="block md:hidden text-xs font-semibold text-slate-500 mb-1">SKS</label>
                        <span class="text-sm font-bold text-slate-600 bg-slate-100 px-3 py-1 rounded-md">3 SKS</span>
                    </div>
                    <div class="col-span-1 md:col-span-4">
                        <label class="block md:hidden text-xs font-semibold text-slate-500 mb-1">Nilai Huruf</label>
                        <select class="w-full px-4 py-2 border border-slate-200 rounded-lg bg-slate-50 text-slate-700 text-sm font-bold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all cursor-pointer">
                            <option value="">-- Input Nilai --</option>
                            <option value="A" selected>A (Sangat Baik)</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B">B (Baik)</option>
                            <option value="B-">B-</option>
                            <option value="C">C (Cukup)</option>
                        </select>
                    </div>
                </div>

                {{-- Row 3 --}}
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center bg-white border border-slate-200 p-4 md:px-6 md:py-3 rounded-xl md:rounded-lg shadow-sm md:shadow-none hover:border-blue-200 transition-colors">
                    <div class="col-span-1 md:col-span-6 flex flex-col">
                        <label class="block md:hidden text-xs font-semibold text-slate-500 mb-1">Mata Kuliah Prodi</label>
                        <span class="text-sm font-bold text-slate-800">Kapita Selekta</span>
                    </div>
                    <div class="col-span-1 md:col-span-2 md:text-center">
                        <label class="block md:hidden text-xs font-semibold text-slate-500 mb-1">SKS</label>
                        <span class="text-sm font-bold text-slate-600 bg-slate-100 px-3 py-1 rounded-md">3 SKS</span>
                    </div>
                    <div class="col-span-1 md:col-span-4">
                        <label class="block md:hidden text-xs font-semibold text-slate-500 mb-1">Nilai Huruf</label>
                        <select class="w-full px-4 py-2 border border-slate-200 rounded-lg bg-slate-50 text-slate-700 text-sm font-bold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all cursor-pointer">
                            <option value="">-- Input Nilai --</option>
                            <option value="A">A (Sangat Baik)</option>
                            <option value="A-" selected>A-</option>
                            <option value="B+">B+</option>
                            <option value="B">B (Baik)</option>
                            <option value="B-">B-</option>
                            <option value="C">C (Cukup)</option>
                        </select>
                    </div>
                </div>

            </div>
            
            {{-- Validation Info --}}
            <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-100 flex gap-3 text-blue-700 text-sm font-medium">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p>Mata Kuliah dan SKS di atas (Total 10 SKS) tidak dapat diubah karena telah di-ACC sebelumnya pada halaman Konversi. Anda hanya perlu memetakan dan mengesahkan Nilai Huruf saja.</p>
            </div>
            
        </div>
    </div>

    {{-- Action Bar Bawah --}}
    <div class="pt-6 border-t border-slate-200 flex items-center justify-end gap-3">
        <a href="{{ route('kaprodi.penilaian-mbkm.index') }}" class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 transition-colors shadow-sm">
            Batal
        </a>
        <button type="button" class="px-6 py-3 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-sm shadow-blue-600/20 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Simpan & Sahkan Nilai
        </button>
    </div>
</div>
@endsection
