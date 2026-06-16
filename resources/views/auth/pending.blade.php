@extends('layouts.auth')

@section('title', 'Menunggu Konfirmasi - MBKM System')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-50 to-blue-50 p-6">
    <div class="w-full max-w-lg">
        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            {{-- Top accent bar --}}
            <div class="h-2 bg-gradient-to-r from-amber-400 via-orange-400 to-amber-500"></div>

            <div class="p-10 text-center">
                {{-- Icon --}}
                <div class="flex items-center justify-center w-24 h-24 rounded-full bg-amber-50 border-4 border-amber-100 mx-auto mb-6">
                    <svg class="w-12 h-12 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                {{-- Title --}}
                <h1 class="text-2xl font-bold text-slate-900 mb-2">Menunggu Konfirmasi</h1>
                <p class="text-slate-500 mb-8">
                    Pendaftaran Anda telah berhasil dikirim. Akun Anda sedang dalam proses verifikasi oleh Admin.
                </p>

                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm flex items-start gap-3 text-left">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('info'))
                    <div class="mb-6 p-4 rounded-xl bg-blue-50 border border-blue-200 text-blue-700 text-sm flex items-start gap-3 text-left">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ session('info') }}</span>
                    </div>
                @endif

                {{-- Steps --}}
                <div class="bg-slate-50 rounded-xl p-6 text-left mb-8">
                    <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-4">Status Pendaftaran</p>
                    <div class="space-y-4">
                        {{-- Step 1: Done --}}
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-green-500 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-800 text-sm">Form Pendaftaran Terisi</p>
                                <p class="text-xs text-slate-500">Data Anda telah tersimpan di sistem</p>
                            </div>
                        </div>

                        {{-- Connector --}}
                        <div class="ml-4 w-0.5 h-4 bg-slate-200"></div>

                        {{-- Step 2: In Progress --}}
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-amber-400 flex items-center justify-center animate-pulse">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-amber-700 text-sm">Menunggu Verifikasi Admin</p>
                                <p class="text-xs text-slate-500">Admin sedang meninjau data Anda</p>
                            </div>
                        </div>

                        {{-- Connector --}}
                        <div class="ml-4 w-0.5 h-4 bg-slate-200"></div>

                        {{-- Step 3: Pending --}}
                        <div class="flex items-center gap-4 opacity-40">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-slate-300 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-800 text-sm">Akun Aktif & Bisa Login</p>
                                <p class="text-xs text-slate-500">Setelah dikonfirmasi, Anda dapat masuk</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Info Box --}}
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-left mb-6">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-sm text-blue-700">
                            Proses konfirmasi biasanya memakan waktu <strong>1x24 jam</strong>. Jika sudah lebih dari itu, 
                            silakan hubungi admin program studi Ilmu Komputer.
                        </p>
                    </div>
                </div>

                <a href="{{ route('auth.login') }}"
                   class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Halaman Login
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
