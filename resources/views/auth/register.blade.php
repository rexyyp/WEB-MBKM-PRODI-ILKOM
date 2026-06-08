@extends('layouts.auth')

@section('title', 'Register - MBKM System')

@section('content')
<div class="min-h-screen flex">
    {{-- Left Panel: Visual/Branding --}}
    <div class="hidden lg:flex lg:w-1/2 bg-blue-700 items-center justify-center relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <svg patternUnits="userSpaceOnUse" width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                <path d="M54.627 0l.83.83-54.628 54.628-.83-.83L54.627 0zm0 10.435l.83.83-44.193 44.193-.83-.83L54.627 10.435zm0 10.435l.83.83-33.758 33.758-.83-.83L54.627 20.87zm0 10.435l.83.83-23.323 23.323-.83-.83L54.627 31.305zm0 10.435l.83.83-12.888 12.888-.83-.83L54.627 41.74zm0 10.435l.83.83-2.453 2.453-.83-.83L54.627 52.175z" fill="currentColor" fill-rule="evenodd"/>
            </svg>
        </div>
        
        <div class="relative z-10 w-full max-w-md px-12 text-white">
            <div class="mb-10">
                <svg class="w-24 h-24 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-extrabold mb-4 leading-tight">Bergabung Bersama<br>Komunitas Kami.</h1>
            <p class="text-blue-100 text-lg">Pendaftaran akun Mahasiswa dan Pembimbing Lapangan terintegrasi.</p>
        </div>
    </div>

    {{-- Right Panel: Register Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white min-h-screen py-12">
        <div class="w-full max-w-md">
            {{-- Header --}}
            <div class="mb-8 text-center lg:text-left">
                <h2 class="text-3xl font-bold text-slate-900 mb-2">Buat Akun</h2>
                <p class="text-slate-500">Pilih role Anda dan lengkapi data pendaftaran.</p>
            </div>

            {{-- Role Tabs --}}
            <div class="flex p-1 bg-slate-100 rounded-lg mb-8">
                <button type="button" id="tab-mahasiswa" onclick="switchTab('mahasiswa')" class="flex-1 py-2.5 text-sm font-bold rounded-md transition-all duration-200 bg-white shadow-sm text-blue-700">
                    Mahasiswa
                </button>
                <button type="button" id="tab-pembimbing" onclick="switchTab('pembimbing')" class="flex-1 py-2.5 text-sm font-bold rounded-md transition-all duration-200 text-slate-500 hover:text-slate-700">
                    Pembimbing Lapangan
                </button>
            </div>

            {{-- Form Mahasiswa --}}
            <form id="form-mahasiswa" action="{{ route('auth.register.process') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="role" value="mahasiswa">
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name_mhs" value="{{ old('name_mhs') }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Sesuai KTP/KTM" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">NIM</label>
                        <input type="text" name="nim" value="{{ old('nim') }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Nomor Induk Mahasiswa" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Angkatan</label>
                        <select name="angkatan" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors" required>
                            <option value="">Pilih Angkatan</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <input type="email" name="email_mhs" value="{{ old('email_mhs') }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Disarankan menggunakan email kampus" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                        <input type="password" name="password_mhs" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="••••••••" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi</label>
                        <input type="password" name="password_confirmation_mhs" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="flex items-start pt-2">
                    <div class="flex items-center h-5">
                        <input id="tos-mhs" type="checkbox" required class="w-4 h-4 border border-slate-300 rounded bg-slate-50 focus:ring-3 focus:ring-blue-300">
                    </div>
                    <label for="tos-mhs" class="ml-2 text-sm text-slate-600">Saya menyetujui <a href="#" class="text-blue-600 hover:underline">Syarat dan Ketentuan</a> yang berlaku.</label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                        Daftar sebagai Mahasiswa
                    </button>
                </div>
            </form>

            {{-- Form Pembimbing --}}
            <form id="form-pembimbing" action="{{ route('auth.register.process') }}" method="POST" class="space-y-4 hidden">
                @csrf
                <input type="hidden" name="role" value="pembimbing">
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name_pem" value="{{ old('name_pem') }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Nama dengan gelar" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Perusahaan / Mitra</label>
                    <input type="text" name="company" value="{{ old('company') }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Contoh: PT Teknologi Bangsa" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jabatan</label>
                        <input type="text" name="position" value="{{ old('position') }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Contoh: HR Manager" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">No. WhatsApp</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="08..." required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email Profesional</label>
                    <input type="email" name="email_pem" value="{{ old('email_pem') }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="email@perusahaan.com" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                        <input type="password" name="password_pem" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="••••••••" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi</label>
                        <input type="password" name="password_confirmation_pem" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="flex items-start pt-2">
                    <div class="flex items-center h-5">
                        <input id="tos-pembimbing" type="checkbox" required class="w-4 h-4 border border-slate-300 rounded bg-slate-50 focus:ring-3 focus:ring-blue-300">
                    </div>
                    <label for="tos-pembimbing" class="ml-2 text-sm text-slate-600">Saya menyetujui <a href="#" class="text-blue-600 hover:underline">Ketentuan Kerja Sama</a> Mitra MBKM.</label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                        Daftar sebagai Pembimbing
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center text-sm text-slate-600">
                Sudah punya akun? 
                <a href="{{ route('auth.login') }}" class="font-bold text-blue-600 hover:text-blue-800 transition-colors">Masuk di sini</a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function switchTab(role) {
        const btnMhs = document.getElementById('tab-mahasiswa');
        const btnPem = document.getElementById('tab-pembimbing');
        const formMhs = document.getElementById('form-mahasiswa');
        const formPem = document.getElementById('form-pembimbing');

        const activeClass = ['bg-white', 'shadow-sm', 'text-blue-700'];
        const inactiveClass = ['text-slate-500', 'hover:text-slate-700'];

        if (role === 'mahasiswa') {
            formMhs.classList.remove('hidden');
            formPem.classList.add('hidden');
            
            btnMhs.classList.add(...activeClass);
            btnMhs.classList.remove(...inactiveClass);
            
            btnPem.classList.remove(...activeClass);
            btnPem.classList.add(...inactiveClass);
        } else {
            formPem.classList.remove('hidden');
            formMhs.classList.add('hidden');
            
            btnPem.classList.add(...activeClass);
            btnPem.classList.remove(...inactiveClass);
            
            btnMhs.classList.remove(...activeClass);
            btnMhs.classList.add(...inactiveClass);
        }
    }
</script>
@endpush
@endsection
