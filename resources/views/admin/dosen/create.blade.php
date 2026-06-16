@extends('layouts.admin')

@section('title', 'Tambah Dosen - Admin')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.dosen.index') }}" class="bg-slate-100 hover:bg-slate-200 p-2 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Tambah Dosen Baru</h1>
                <p class="text-slate-600 mt-1">Buat akun dosen pembimbing atau penguji baru</p>
            </div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden max-w-3xl">
        <form action="{{ route('admin.dosen.store') }}" method="POST">
            @csrf

            {{-- Form Body --}}
            <div class="p-8">
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

                {{-- Section: Informasi Akun --}}
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="text-blue-700 font-bold text-sm">1</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Informasi Akun</h3>
                    </div>

                    <div class="space-y-5">
                        {{-- Nama Lengkap --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                NAMA LENGKAP <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Dr. Siti Nurhaliza, M.Kom" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('name') border-red-500 @enderror" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                EMAIL <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Contoh: siti.nurhaliza@upi.edu" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('email') border-red-500 @enderror" required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-slate-500 mt-1">Email ini akan digunakan untuk login</p>
                        </div>

                        {{-- Password --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    PASSWORD <span class="text-red-500">*</span>
                                </label>
                                <input type="password" name="password" placeholder="Minimal 8 karakter" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('password') border-red-500 @enderror" required>
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    KONFIRMASI PASSWORD <span class="text-red-500">*</span>
                                </label>
                                <input type="password" name="password_confirmation" placeholder="Ulangi password" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="border-t border-slate-200 my-8"></div>

                {{-- Section: Data Dosen --}}
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="text-blue-700 font-bold text-sm">2</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Data Dosen</h3>
                    </div>

                    <div class="space-y-5">
                        {{-- NIP --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                NIP (NOMOR INDUK PEGAWAI) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nip" value="{{ old('nip') }}" placeholder="Contoh: 198501012010122001" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nip') border-red-500 @enderror" required>
                            @error('nip')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jenis Dosen --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                JENIS DOSEN <span class="text-red-500">*</span>
                            </label>
                            <select name="jenis_dosen" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('jenis_dosen') border-red-500 @enderror" required>
                                <option value="" disabled selected>-- Pilih Jenis Dosen --</option>
                                <option value="pembimbing" {{ old('jenis_dosen') == 'pembimbing' ? 'selected' : '' }}>Dosen Pembimbing</option>
                                <option value="penguji" {{ old('jenis_dosen') == 'penguji' ? 'selected' : '' }}>Dosen Penguji</option>
                            </select>
                            @error('jenis_dosen')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-slate-500 mt-1">
                                <span class="font-semibold">Pembimbing:</span> Membimbing mahasiswa MBKM | 
                                <span class="font-semibold">Penguji:</span> Menguji proposal & laporan akhir
                            </p>
                        </div>

                        {{-- No Telp --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                NO. TELEPON
                            </label>
                            <input type="text" name="no_telp" value="{{ old('no_telp') }}" placeholder="Contoh: 081234567890" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('no_telp') border-red-500 @enderror">
                            @error('no_telp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Info Box --}}
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="font-semibold text-blue-900 text-sm mb-1">Informasi Penting</h4>
                            <p class="text-sm text-blue-800">
                                Akun dosen yang dibuat akan langsung aktif dan bisa digunakan untuk login. 
                                Dosen dapat berperan sebagai <strong>Dosen Pembimbing</strong> atau <strong>Dosen Penguji</strong> 
                                yang akan ditugaskan oleh admin atau kaprodi pada menu penugasan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Footer --}}
            <div class="bg-slate-50 px-8 py-4 border-t border-slate-200 flex gap-4">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Simpan Akun Dosen
                </button>
                <a href="{{ route('admin.dosen.index') }}" class="flex-1 border-2 border-slate-300 text-slate-600 hover:bg-slate-100 font-semibold py-3 px-6 rounded-lg transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
            </div>
        </form>
    </div>

    {{-- Help Card --}}
    <div class="bg-slate-50 border border-slate-200 rounded-lg p-6 mt-6 max-w-3xl">
        <h4 class="font-semibold text-slate-900 mb-3 flex items-center gap-2">
            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Panduan Pengisian
        </h4>
        <ul class="space-y-2 text-sm text-slate-600">
            <li class="flex gap-2">
                <span class="text-blue-600">•</span>
                <span><strong>Nama Lengkap:</strong> Masukkan nama lengkap beserta gelar akademik</span>
            </li>
            <li class="flex gap-2">
                <span class="text-blue-600">•</span>
                <span><strong>Email:</strong> Gunakan email institusi (@upi.edu) jika memungkinkan</span>
            </li>
            <li class="flex gap-2">
                <span class="text-blue-600">•</span>
                <span><strong>Password:</strong> Minimal 8 karakter, kombinasi huruf dan angka disarankan</span>
            </li>
            <li class="flex gap-2">
                <span class="text-blue-600">•</span>
                <span><strong>NIP:</strong> Nomor Induk Pegawai sesuai dengan data kepegawaian</span>
            </li>
            <li class="flex gap-2">
                <span class="text-blue-600">•</span>
                <span><strong>No. Telepon:</strong> Opsional, bisa diisi untuk kemudahan komunikasi</span>
            </li>
        </ul>
    </div>
@endsection
