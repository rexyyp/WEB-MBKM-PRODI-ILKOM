@extends('layouts.dosen-pembimbing')

@section('title', 'Penilaian Mahasiswa - Dosen')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900 mb-2">Penilaian Mahasiswa</h1>
        <p class="text-slate-600 text-lg">Input dan kelola nilai mahasiswa MBKM.</p>
    </div>

    {{-- Student Selector --}}
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <label class="block text-sm font-semibold text-slate-600 uppercase tracking-wider mb-3">Pilih Mahasiswa</label>
        <select id="studentSelect" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none cursor-pointer bg-white hover:border-slate-400 transition-colors duration-200">
            <option value="" disabled selected>-- Pilih Mahasiswa --</option>
            <option value="andi">Andi Wijaya - 190204001</option>
            <option value="siti">Siti Aminah - 190204002</option>
            <option value="budi">Budi Pratama - 190204003</option>
        </select>
    </div>

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left Column: Student Profile & Score Summary --}}
        <div class="space-y-6">
            {{-- Student Profile Card --}}
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                        AW
                    </div>
                    <div>
                        <p class="font-semibold text-slate-900 text-lg">Andi Wijaya</p>
                        <p class="text-sm text-slate-600">190204001</p>
                    </div>
                </div>
                
                <div class="space-y-4 border-t border-slate-200 pt-4">
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Mitra MBKM</p>
                        <p class="text-slate-900 font-medium">PT. Telkom Indonesia</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Status Program</p>
                        <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">Berjalan</span>
                    </div>
                </div>
            </div>

            {{-- Score Summary Card --}}
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Rekap Nilai</h3>
                
                {{-- Nilai Pembimbing Lapangan --}}
                <div class="mb-6 pb-6 border-b border-slate-200">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Nilai Pembimbing Lapangan</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-slate-900">88</span>
                    </div>
                    <p class="text-sm text-slate-600 mt-1">Dari Mitra Industri</p>
                </div>

                {{-- Prediksi Nilai Akhir --}}
                <div class="bg-blue-50 rounded-lg p-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Prediksi Nilai Akhir</p>
                    <div class="flex items-baseline gap-2">
                        <span id="finalScore" class="text-4xl font-bold text-blue-600">0</span>
                    </div>
                    <p class="text-sm text-slate-600 mt-1">Kalkulasi Otomatis</p>
                </div>
            </div>
        </div>

        {{-- Right Column: Assessment Form --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-slate-900 mb-2">Form Penilaian Akademik</h2>
                <p class="text-slate-600 mb-6">Masukkan nilai komponen akademik untuk mahasiswa ini.</p>

                <form id="assessmentForm" class="space-y-6">
                    {{-- Nilai Dosen Pembimbing --}}
                    <div>
                        <label for="nilaiPembimbing" class="block text-sm font-semibold text-slate-900 mb-2">Nilai Dosen Pembimbing</label>
                        <div class="relative">
                            <input type="number" id="nilaiPembimbing" min="0" max="100" placeholder="0" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <span class="absolute right-4 top-3 text-slate-600 font-semibold">/100</span>
                        </div>
                    </div>


                    {{-- Action Buttons --}}
                    <div class="flex gap-3 pt-4 border-t border-slate-200">
                        <button type="reset" class="px-6 py-3 border border-slate-300 text-slate-700 font-semibold rounded-lg hover:bg-slate-50 transition-colors duration-200">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V5"></path>
                            </svg>
                            Simpan Nilai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto-calculate final score
        const nilaiPembimbing = document.getElementById('nilaiPembimbing');
        const finalScore = document.getElementById('finalScore');
        const nilaiPembimbingLapangan = 88; // From field supervisor

        function calculateFinalScore() {
            const pembimbing = parseFloat(nilaiPembimbing.value) || 0;

            // Formula: (40% × Nilai Pembimbing Lapangan) + (60% × Nilai Dosen Pembimbing)
            const score = (0.40 * nilaiPembimbingLapangan) + (0.60 * pembimbing);
            finalScore.textContent = Math.round(score * 10) / 10;
        }

        nilaiPembimbing.addEventListener('input', calculateFinalScore);

        // Form submission
        document.getElementById('assessmentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validation
            if (!nilaiPembimbing.value) {
                alert('Nilai Dosen Pembimbing harus diisi!');
                return;
            }

            if (nilaiPembimbing.value < 0 || nilaiPembimbing.value > 100) {
                alert('Nilai harus antara 0-100!');
                return;
            }

            alert('Nilai berhasil disimpan!');
            // Here you would send data to backend
        });

        // Student selector
        document.getElementById('studentSelect').addEventListener('change', function(e) {
            // This is placeholder - in production, fetch student data via AJAX
            alert('Fitur mengganti mahasiswa akan diimplementasikan setelah database integration');
        });
    </script>
@endsection
