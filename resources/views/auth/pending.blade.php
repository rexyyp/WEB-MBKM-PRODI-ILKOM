@extends('layouts.auth')

@section('title', 'Menunggu Konfirmasi - MBKM System')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-50 p-6">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl overflow-hidden text-center p-10">
        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        
        <h1 class="text-2xl font-bold text-slate-900 mb-4">Terima kasih sudah mendaftar!</h1>
        
        <p class="text-slate-600 text-lg leading-relaxed mb-8">
            Akun Anda saat ini sedang dalam proses <span class="font-semibold text-slate-900">konfirmasi oleh Admin</span>. Silakan cek email Anda secara berkala untuk notifikasi persetujuan.
        </p>
        
        <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-8 text-sm text-blue-800 text-left">
            <strong>Informasi:</strong> Proses verifikasi akun biasanya memakan waktu 1x24 jam pada hari kerja. Pastikan email yang Anda daftarkan aktif.
        </div>

        <a href="{{ route('auth.login') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full transition-all duration-200 shadow-md hover:shadow-lg">
            Kembali ke Halaman Login
        </a>
    </div>
</div>
@endsection
