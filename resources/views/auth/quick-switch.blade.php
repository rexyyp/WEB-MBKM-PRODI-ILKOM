@extends('layouts.auth')

@section('title', 'Quick Switch User - Testing')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-slate-50 flex items-center justify-center p-4">
        <div class="w-full max-w-5xl">
            {{-- Header --}}
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-slate-900 mb-2">🔄 Quick Switch User</h1>
                <p class="text-slate-600">Login cepat untuk testing berbagai role</p>
            </div>

            {{-- Grid User Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                {{-- Admin Card --}}
                <div class="bg-white rounded-xl shadow-lg border-2 border-blue-200 p-6 hover:shadow-xl transition-all duration-200 hover:-translate-y-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900">Admin</h3>
                            <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full font-semibold">Administrator</span>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm mb-4">
                        <p class="text-slate-600"><span class="font-semibold">Email:</span> admin@mbkm.ac.id</p>
                        <p class="text-slate-600"><span class="font-semibold">Password:</span> admin123</p>
                    </div>
                    <form action="{{ route('auth.quick-login') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="admin@mbkm.ac.id">
                        <input type="hidden" name="password" value="admin123">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Login sebagai Admin
                        </button>
                    </form>
                </div>

                {{-- Mahasiswa Rexy (No Data) --}}
                <div class="bg-white rounded-xl shadow-lg border-2 border-green-200 p-6 hover:shadow-xl transition-all duration-200 hover:-translate-y-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <span class="text-green-700 font-bold text-lg">R</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900">Rexy Mahasiswa</h3>
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-semibold">Mahasiswa</span>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm mb-4">
                        <p class="text-slate-600"><span class="font-semibold">Email:</span> rexy@student.upi.edu</p>
                        <p class="text-slate-600"><span class="font-semibold">Password:</span> password</p>
                        <p class="text-xs text-yellow-600 bg-yellow-50 px-2 py-1 rounded">⚠️ Belum ada data MBKM</p>
                    </div>
                    <form action="{{ route('auth.quick-login') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="rexy@student.upi.edu">
                        <input type="hidden" name="password" value="password">
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Login sebagai Rexy
                        </button>
                    </form>
                </div>

                {{-- Mahasiswa Andi (With Data) --}}
                <div class="bg-white rounded-xl shadow-lg border-2 border-emerald-200 p-6 hover:shadow-xl transition-all duration-200 hover:-translate-y-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center">
                            <span class="text-emerald-700 font-bold text-lg">A</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900">Andi Pratama</h3>
                            <span class="text-xs bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full font-semibold">Mahasiswa</span>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm mb-4">
                        <p class="text-slate-600"><span class="font-semibold">Email:</span> andi@student.upi.edu</p>
                        <p class="text-slate-600"><span class="font-semibold">Password:</span> password</p>
                        <p class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded">✅ Punya data MBKM</p>
                    </div>
                    <form action="{{ route('auth.quick-login') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="andi@student.upi.edu">
                        <input type="hidden" name="password" value="password">
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Login sebagai Andi
                        </button>
                    </form>
                </div>

                {{-- Dosen Pembimbing --}}
                <div class="bg-white rounded-xl shadow-lg border-2 border-purple-200 p-6 hover:shadow-xl transition-all duration-200 hover:-translate-y-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <span class="text-purple-700 font-bold text-lg">S</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900">Dr. Siti Nurhaliza</h3>
                            <span class="text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full font-semibold">Dosen Pembimbing</span>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm mb-4">
                        <p class="text-slate-600"><span class="font-semibold">Email:</span> siti@upi.edu</p>
                        <p class="text-slate-600"><span class="font-semibold">Password:</span> password</p>
                        <p class="text-xs text-purple-600 bg-purple-50 px-2 py-1 rounded">🎓 Pembimbing MBKM</p>
                    </div>
                    <form action="{{ route('auth.quick-login') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="siti@upi.edu">
                        <input type="hidden" name="password" value="password">
                        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Login sebagai Siti
                        </button>
                    </form>
                </div>

                {{-- Dosen Penguji --}}
                <div class="bg-white rounded-xl shadow-lg border-2 border-indigo-200 p-6 hover:shadow-xl transition-all duration-200 hover:-translate-y-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                            <span class="text-indigo-700 font-bold text-lg">B</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900">Prof. Dr. Budi Santoso</h3>
                            <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full font-semibold">Dosen Penguji</span>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm mb-4">
                        <p class="text-slate-600"><span class="font-semibold">Email:</span> budi.santoso@upi.edu</p>
                        <p class="text-slate-600"><span class="font-semibold">Password:</span> password</p>
                        <p class="text-xs text-indigo-600 bg-indigo-50 px-2 py-1 rounded">📋 Penguji MBKM</p>
                    </div>
                    <form action="{{ route('auth.quick-login') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="budi.santoso@upi.edu">
                        <input type="hidden" name="password" value="password">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Login sebagai Budi
                        </button>
                    </form>
                </div>

                {{-- Normal Login --}}
                <div class="bg-white rounded-xl shadow-lg border-2 border-slate-200 p-6 hover:shadow-xl transition-all duration-200 hover:-translate-y-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center">
                            <svg class="w-7 h-7 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900">Login Manual</h3>
                            <span class="text-xs bg-slate-100 text-slate-700 px-2 py-0.5 rounded-full font-semibold">Custom</span>
                        </div>
                    </div>
                    <p class="text-sm text-slate-600 mb-4">Login dengan akun lain atau akun custom Anda sendiri</p>
                    <a href="{{ route('auth.login') }}" class="block w-full bg-slate-600 hover:bg-slate-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors text-center">
                        Login Manual
                    </a>
                </div>

            </div>

            {{-- Info Box --}}
            <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex gap-3">
                    <svg class="w-6 h-6 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-yellow-900 mb-1">💡 Tips untuk Testing Multi-User:</h4>
                        <ul class="text-sm text-yellow-800 space-y-1">
                            <li>• <strong>Cara 1:</strong> Gunakan browser berbeda (Chrome, Firefox, Edge) untuk setiap user</li>
                            <li>• <strong>Cara 2:</strong> Gunakan Incognito/Private mode untuk user tambahan</li>
                            <li>• <strong>Cara 3:</strong> Gunakan halaman ini untuk switch user dengan cepat</li>
                            <li>• <strong>Perhatian:</strong> Login di tab yang sama akan logout user sebelumnya</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Back to Home --}}
            <div class="text-center mt-6">
                <a href="/" class="text-slate-600 hover:text-slate-900 font-medium inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Home
                </a>
            </div>
        </div>
    </div>
@endsection
