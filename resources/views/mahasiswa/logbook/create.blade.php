@extends('layouts.mahasiswa')

@section('title', 'Tambah Logbook - Mahasiswa')

@section('content')
    {{-- Header Section --}}
    <div class="mb-6 flex items-start gap-2">
        <a href="{{ route('mahasiswa.logbook.index') }}" class="p-2 mt-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-colors duration-200 shrink-0" title="Kembali">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Tambah Logbook Harian</h1>
            </div>
            <p class="text-slate-500 mt-1">Catat detail aktivitas magang Anda dengan lengkap dan akurat.</p>
        </div>
    </div>

    {{-- Form Section --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <form action="#" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Kiri: Tanggal & Kegiatan --}}
                <div class="space-y-6">
                    <div>
                        <label for="tanggal" class="block text-sm font-bold text-slate-900 mb-2">Hari & Tanggal <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal" name="tanggal" required 
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-slate-50 focus:bg-white transition-colors duration-200">
                    </div>

                    <div>
                        <label for="kegiatan" class="block text-sm font-bold text-slate-900 mb-2">Nama Kegiatan / Aktivitas <span class="text-red-500">*</span></label>
                        <input type="text" id="kegiatan" name="kegiatan" placeholder="Contoh: Pengembangan Fitur Login dan Testing UI" required 
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-slate-50 focus:bg-white transition-colors duration-200">
                    </div>
                </div>

                {{-- Kanan: Waktu --}}
                <div class="space-y-6 bg-blue-50 p-6 rounded-xl border border-blue-100">
                    <h3 class="font-bold text-blue-900 mb-2 border-b border-blue-200 pb-2">Ringkasan Waktu Pelaksanaan</h3>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="jam_mulai" class="block text-sm font-bold text-blue-900 mb-2">Jam Mulai <span class="text-red-500">*</span></label>
                            <input type="time" id="jam_mulai" name="jam_mulai" required onchange="calculateTotalTime()" 
                                class="w-full px-4 py-3 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white transition-colors duration-200 text-slate-700">
                        </div>
                        <div>
                            <label for="jam_selesai" class="block text-sm font-bold text-blue-900 mb-2">Jam Selesai <span class="text-red-500">*</span></label>
                            <input type="time" id="jam_selesai" name="jam_selesai" required onchange="calculateTotalTime()" 
                                class="w-full px-4 py-3 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white transition-colors duration-200 text-slate-700">
                        </div>
                    </div>

                    <div>
                        <label for="total_waktu" class="block text-sm font-bold text-blue-900 mb-2">Total Waktu Aktual</label>
                        <input type="text" id="total_waktu" name="total_waktu" readonly placeholder="0 Jam" 
                            class="w-full px-4 py-3 border border-blue-200 rounded-lg bg-blue-100/50 text-blue-800 font-bold cursor-not-allowed text-center text-lg">
                        <p class="text-xs text-blue-700/70 mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Terkalkulasi otomatis berdasarkan jam mulai dan selesai.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Deskripsi Lengkap --}}
            <div class="pt-2">
                <label for="deskripsi" class="block text-sm font-bold text-slate-900 mb-2">Deskripsi Lengkap <span class="text-red-500">*</span></label>
                <textarea id="deskripsi" name="deskripsi" rows="6" placeholder="Ceritakan detail aktivitas yang Anda kerjakan hari ini, termasuk:&#10;- Hasil pekerjaan yang dicapai&#10;- Kendala atau masalah yang dihadapi&#10;- Solusi atau tindak lanjut" required 
                    class="w-full px-4 py-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-slate-50 focus:bg-white transition-colors duration-200 leading-relaxed"></textarea>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-200">
                <a href="{{ route('mahasiswa.logbook.index') }}" class="px-6 py-3 border border-slate-300 text-slate-700 font-semibold rounded-lg hover:bg-slate-50 transition-colors duration-200">
                    Batal
                </a>
                <button type="button" class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 shadow-md hover:shadow-lg transition-all duration-200 flex items-center gap-2" onclick="alert('Logbook berhasil disimpan!')">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2zM5 19h14V8.83L14.17 4H5v15zm7-10c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3z"/>
                    </svg>
                    Simpan Logbook
                </button>
            </div>
        </form>
    </div>

    <script>
        function calculateTotalTime() {
            const startTime = document.getElementById('jam_mulai').value;
            const endTime = document.getElementById('jam_selesai').value;
            
            if (startTime && endTime) {
                // Gunakan tanggal dummy untuk menghitung selisih jam
                const start = new Date(`2000-01-01T${startTime}:00`);
                let end = new Date(`2000-01-01T${endTime}:00`);
                
                // Jika jam selesai lebih kecil dari jam mulai (lewat tengah malam)
                if (end < start) {
                    end = new Date(`2000-01-02T${endTime}:00`);
                }
                
                const diffMs = end - start;
                const diffHrs = diffMs / (1000 * 60 * 60);
                
                // Bulatkan ke 1 desimal
                document.getElementById('total_waktu').value = diffHrs.toFixed(1) + ' Jam';
            } else {
                document.getElementById('total_waktu').value = '';
            }
        }
    </script>
@endsection
