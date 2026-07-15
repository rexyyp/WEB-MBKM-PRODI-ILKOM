@extends('layouts.kaprodi')

@section('title', 'Penilaian & Konversi - Kaprodi Panel')

@section('content')
<div class="min-h-screen pb-12">
    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="mb-6 flex items-center gap-3 rounded-xl bg-green-50 border border-green-200 px-5 py-4 text-green-800 text-sm font-medium">
            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-6 flex items-center gap-3 rounded-xl bg-red-50 border border-red-200 px-5 py-4 text-red-800 text-sm font-medium">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('error') }}
        </div>
    @endif

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
        <p class="text-slate-600 text-lg">Input nilai huruf dan sahkan konversi SKS untuk kegiatan MBKM mahasiswa</p>
    </div>

    {{-- Card 1: Ringkasan Mahasiswa --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="flex items-center gap-6">
            <div class="h-14 w-14 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xl">
                {{ strtoupper(substr($pendaftaran->mahasiswa->user->name ?? 'MH', 0, 2)) }}
            </div>
            <div>
                <span class="block text-xl font-bold text-slate-900 leading-tight">{{ $pendaftaran->mahasiswa->user->name ?? '-' }}</span>
                <span class="block text-sm font-medium text-slate-500 mt-1">{{ $pendaftaran->mahasiswa->nim ?? '-' }}</span>
                <span class="block text-xs font-medium text-slate-400 mt-0.5">{{ $pendaftaran->mitraMbkm->nama_mitra ?? '-' }}</span>
            </div>
        </div>

        {{-- Ringkasan Nilai --}}
        <div class="flex flex-wrap gap-3 w-full md:w-auto">
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 text-center min-w-[80px]">
                <span class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Pembimbing</span>
                <span class="block text-xl font-extrabold {{ $nilaiPembimbing !== null ? 'text-slate-900' : 'text-slate-300' }}">
                    {{ $nilaiPembimbing ?? '-' }}
                </span>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 text-center min-w-[80px]">
                <span class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Penguji</span>
                <span class="block text-xl font-extrabold {{ $nilaiPenguji !== null ? 'text-slate-900' : 'text-slate-300' }}">
                    {{ $nilaiPenguji ?? '-' }}
                </span>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 text-center min-w-[80px]">
                <span class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Lapangan</span>
                <span class="block text-xl font-extrabold {{ $nilaiMitra !== null ? 'text-slate-900' : 'text-slate-300' }}">
                    {{ $nilaiMitra ?? '-' }}
                </span>
            </div>
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex items-center gap-4 justify-center shrink-0">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <span class="block text-xs font-bold text-blue-600 uppercase tracking-wider mb-0.5">Nilai Final</span>
                    <span class="block text-2xl font-extrabold text-slate-900 leading-none">
                        {{ $nilaiAkhir ?? '-' }}
                        @if($nilaiHurufFinal !== '-')
                            <span class="text-blue-600">/ {{ $nilaiHurufFinal }}</span>
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Validasi: Konversi harus disetujui --}}
    @if (!$konversiSks || $konversiSks->status !== 'disetujui')
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 mb-8 flex items-start gap-4">
            <svg class="w-6 h-6 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div>
                <p class="font-bold text-amber-800">Konversi Mata Kuliah Belum Disetujui</p>
                <p class="text-sm text-amber-700 mt-1">
                    @if (!$konversiSks)
                        Mahasiswa belum mengajukan konversi mata kuliah. Penilaian nilai huruf tidak dapat dilakukan.
                    @else
                        Status konversi saat ini: <strong>{{ $konversiSks->status }}</strong>. Setujui terlebih dahulu di halaman
                        <a href="{{ route('kaprodi.konversi-sks.index') }}" class="underline font-bold">Konversi SKS</a>.
                    @endif
                </p>
            </div>
        </div>
    @endif

    {{-- Sudah selesai di-ACC --}}
    @if ($konversiSks && $konversiSks->status_penilaian === 'selesai')
        <div class="bg-green-50 border border-green-200 rounded-2xl p-6 mb-8 flex items-center gap-4">
            <svg class="w-8 h-8 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
            <div>
                <p class="font-bold text-green-800">Penilaian Sudah Disahkan</p>
                <p class="text-sm text-green-700 mt-1">Nilai huruf untuk seluruh mata kuliah konversi sudah tersimpan. Anda dapat memperbaruinya kembali jika diperlukan.</p>
            </div>
        </div>
    @endif

    {{-- Card 2: Form Pemetaan Mata Kuliah --}}
    <form method="POST" action="{{ route('kaprodi.penilaian-mbkm.simpan', $pendaftaran->id) }}">
        @csrf
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-800">Daftar Mata Kuliah Terkonversi & Penilaian</h2>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-bold">
                    Total: {{ $totalSks }} SKS ({{ $details->count() }} MK)
                </div>
            </div>

            <div class="p-6">
                @if ($details->isEmpty())
                    <div class="text-center py-10">
                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        <p class="text-slate-500 font-medium">Belum ada mata kuliah konversi</p>
                        <p class="text-slate-400 text-sm mt-1">Mahasiswa belum mengajukan atau belum ada konversi yang disetujui</p>
                    </div>
                @else
                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Table Header --}}
                    <div class="hidden md:grid grid-cols-12 gap-4 px-6 py-3 bg-slate-50 rounded-lg mb-3">
                        <div class="col-span-1 text-xs font-bold text-slate-500 uppercase tracking-wider">Kode MK</div>
                        <div class="col-span-5 text-xs font-bold text-slate-500 uppercase tracking-wider">Mata Kuliah Prodi</div>
                        <div class="col-span-2 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">SKS</div>
                        <div class="col-span-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nilai Huruf</div>
                    </div>

                    {{-- Rows from DB --}}
                    <div class="space-y-3">
                        @foreach ($details as $detail)
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center bg-white border border-slate-200 p-4 md:px-6 md:py-3 rounded-xl md:rounded-lg shadow-sm md:shadow-none hover:border-blue-200 transition-colors">
                                <div class="col-span-1 md:col-span-1">
                                    <label class="block md:hidden text-xs font-semibold text-slate-500 mb-1">Kode MK</label>
                                    <span class="text-xs font-bold text-slate-500 bg-slate-100 px-2 py-1 rounded">{{ $detail->mataKuliah->kode_mk ?? '-' }}</span>
                                </div>
                                <div class="col-span-1 md:col-span-5 flex flex-col">
                                    <label class="block md:hidden text-xs font-semibold text-slate-500 mb-1">Mata Kuliah Prodi</label>
                                    <span class="text-sm font-bold text-slate-800">{{ $detail->mataKuliah->nama_mk ?? '-' }}</span>
                                </div>
                                <div class="col-span-1 md:col-span-2 md:text-center">
                                    <label class="block md:hidden text-xs font-semibold text-slate-500 mb-1">SKS</label>
                                    <span class="text-sm font-bold text-slate-600 bg-slate-100 px-3 py-1 rounded-md">{{ $detail->mataKuliah->sks ?? 0 }} SKS</span>
                                </div>
                                <div class="col-span-1 md:col-span-4">
                                    <label class="block md:hidden text-xs font-semibold text-slate-500 mb-1">Nilai Huruf</label>
                                    <select name="nilai_huruf[{{ $detail->id }}]"
                                            {{ ($konversiSks && $konversiSks->status !== 'disetujui') ? 'disabled' : '' }}
                                            class="w-full px-4 py-2 border border-slate-200 rounded-lg bg-slate-50 text-slate-700 text-sm font-bold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed @error('nilai_huruf.'.$detail->id) border-red-400 @enderror">
                                        <option value="">-- Pilih Nilai --</option>
                                        @foreach(['A','A-','B+','B','B-','C+','C','D','E'] as $nh)
                                            <option value="{{ $nh }}" {{ old('nilai_huruf.'.$detail->id, $detail->nilai_huruf) === $nh ? 'selected' : '' }}>
                                                {{ $nh }}
                                                @if($nh === 'A') (Sangat Baik) @endif
                                                @if($nh === 'B') (Baik) @endif
                                                @if($nh === 'C') (Cukup) @endif
                                                @if($nh === 'D') (Kurang) @endif
                                                @if($nh === 'E') (Tidak Lulus) @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Info Note --}}
                    <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-100 flex gap-3 text-blue-700 text-sm font-medium">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p>Mata Kuliah dan SKS di atas tidak dapat diubah karena telah di-ACC di halaman Konversi.
                           Anda hanya perlu memetakan dan mengesahkan Nilai Huruf untuk setiap mata kuliah.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Action Bar Bawah --}}
        @if ($details->isNotEmpty() && $konversiSks && $konversiSks->status === 'disetujui')
        <div class="pt-6 border-t border-slate-200 flex items-center justify-end gap-3">
            <a href="{{ route('kaprodi.penilaian-mbkm.index') }}" class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 transition-colors shadow-sm">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-sm shadow-blue-600/20 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Simpan & Sahkan Nilai
            </button>
        </div>
        @endif
    </form>
</div>
@endsection
