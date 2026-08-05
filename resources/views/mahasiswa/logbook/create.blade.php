@extends('layouts.mahasiswa')

@section('title', 'Tambah Logbook - Mahasiswa')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8 animate-fade-in-up">
        <div class="flex items-center gap-4">
            <a href="{{ route('mahasiswa.logbook.index') }}" 
               class="bg-white border border-slate-200 p-2.5 rounded-xl text-slate-500 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-200 transition-all duration-300 shadow-sm group flex items-center justify-center"
               title="Kembali">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Tambah Logbook Harian</h1>
                <p class="text-slate-500 mt-1 font-medium">Catat detail aktivitas magang Anda dengan lengkap dan akurat.</p>
            </div>
        </div>
    </div>

    {{-- Form Section --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-slate-50 rounded-bl-full opacity-50 -z-10"></div>
        
        <form action="{{ route('mahasiswa.logbook.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Kiri: Tanggal & Kegiatan --}}
                <div class="space-y-6">
                    <div>
                        <label for="tanggal" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Hari & Tanggal <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="tanggal" name="tanggal"
                               value="{{ old('tanggal') }}"
                               required
                               class="w-full bg-slate-50 border @error('tanggal') border-red-500 bg-red-50 @else border-slate-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 font-medium px-4 py-3.5 text-slate-800">
                        @error('tanggal')
                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kegiatan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Nama Kegiatan / Aktivitas <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="kegiatan" name="kegiatan"
                               value="{{ old('kegiatan') }}"
                               placeholder="Contoh: Pengembangan Fitur Login dan Testing UI"
                               required
                               class="w-full bg-slate-50 border @error('kegiatan') border-red-500 bg-red-50 @else border-slate-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 font-medium px-4 py-3.5 text-slate-800">
                        @error('kegiatan')
                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Kanan: Waktu --}}
                <div class="bg-blue-50 p-6 rounded-2xl border border-blue-100 flex flex-col justify-center space-y-6 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-100 rounded-full opacity-50 z-0"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-blue-200/50">
                            <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="font-bold text-slate-800 text-lg">Ringkasan Waktu Pelaksanaan</h3>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <label for="jam_mulai" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Jam Mulai <span class="text-red-500">*</span>
                                </label>
                                <input type="time" id="jam_mulai" name="jam_mulai"
                                       value="{{ old('jam_mulai') }}"
                                       required
                                       onchange="calculateTotalTime()"
                                       class="w-full bg-white border @error('jam_mulai') border-red-500 @else border-blue-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-300 transition-all duration-300 font-bold px-4 py-3.5 text-slate-800 text-center">
                                @error('jam_mulai')
                                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="jam_selesai" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Jam Selesai <span class="text-red-500">*</span>
                                </label>
                                <input type="time" id="jam_selesai" name="jam_selesai"
                                       value="{{ old('jam_selesai') }}"
                                       required
                                       onchange="calculateTotalTime()"
                                       class="w-full bg-white border @error('jam_selesai') border-red-500 @else border-blue-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-300 transition-all duration-300 font-bold px-4 py-3.5 text-slate-800 text-center">
                                @error('jam_selesai')
                                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="total_waktu" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Total Waktu Aktual</label>
                            <input type="text" id="total_waktu" readonly placeholder="0 Jam"
                                   class="w-full px-4 py-3.5 border border-blue-200 rounded-xl bg-blue-100/50 text-blue-800 font-black cursor-not-allowed text-center text-xl tracking-tight">
                            <p class="text-xs font-medium text-blue-700/80 mt-2 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Terkalkulasi otomatis berdasarkan jam mulai dan selesai.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-8 space-y-6">
                {{-- Deskripsi Lengkap --}}
                <div>
                    <label for="deskripsi" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Deskripsi Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="6"
                              placeholder="Ceritakan detail aktivitas yang Anda kerjakan hari ini, termasuk:&#10;- Hasil pekerjaan yang dicapai&#10;- Kendala atau masalah yang dihadapi&#10;- Solusi atau tindak lanjut"
                              required
                              class="w-full bg-slate-50 border @error('deskripsi') border-red-500 bg-red-50 @else border-slate-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 font-medium px-4 py-4 text-slate-800 resize-none leading-relaxed">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Upload Bukti (Opsional) --}}
                <div>
                    <label for="file_bukti" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Bukti Kegiatan
                        <span class="text-slate-400 font-normal lowercase ml-1">(Opsional — PDF, JPG, PNG, maks. 5MB)</span>
                    </label>
                    <div class="flex items-center gap-4">
                        <label for="file_bukti"
                               class="flex items-center gap-2 px-5 py-3.5 border-2 border-dashed border-slate-300 hover:border-blue-400 rounded-xl cursor-pointer text-slate-500 hover:text-blue-600 transition-colors duration-300 bg-slate-50 hover:bg-blue-50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            <span class="text-sm font-bold">Pilih File</span>
                        </label>
                        <input type="file" id="file_bukti" name="file_bukti"
                               accept=".pdf,.jpg,.jpeg,.png"
                               class="hidden"
                               onchange="updateFileName(this)">
                        <span id="file-name-display" class="text-sm font-medium text-slate-500 italic">Belum ada file dipilih</span>
                    </div>
                    @error('file_bukti')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-4 pt-6 border-t border-slate-100">
                <a href="{{ route('mahasiswa.logbook.index') }}"
                   class="w-full sm:w-auto px-6 py-3.5 border border-slate-200 bg-white text-slate-600 font-bold rounded-xl hover:bg-slate-50 transition-colors duration-300 text-center flex items-center justify-center">
                    Batal
                </a>
                <button type="submit"
                        class="w-full sm:w-auto px-8 py-3.5 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Logbook
                </button>
            </div>
        </form>
    </div>

    <script>
        function calculateTotalTime() {
            const startTime = document.getElementById('jam_mulai').value;
            const endTime   = document.getElementById('jam_selesai').value;

            if (startTime && endTime) {
                const start = new Date(`2000-01-01T${startTime}:00`);
                let end     = new Date(`2000-01-01T${endTime}:00`);

                // Jika jam selesai lebih kecil dari jam mulai (lewat tengah malam)
                if (end < start) {
                    end = new Date(`2000-01-02T${endTime}:00`);
                }

                const diffMs  = end - start;
                const diffHrs = diffMs / (1000 * 60 * 60);

                document.getElementById('total_waktu').value = diffHrs.toFixed(1) + ' Jam';
            } else {
                document.getElementById('total_waktu').value = '';
            }
        }

        function updateFileName(input) {
            const display = document.getElementById('file-name-display');
            display.textContent = input.files[0] ? input.files[0].name : 'Belum ada file dipilih';
            if (input.files[0]) {
                display.classList.remove('italic', 'text-slate-500');
                display.classList.add('not-italic', 'text-slate-800', 'font-bold');
            } else {
                display.classList.add('italic', 'text-slate-500');
                display.classList.remove('not-italic', 'text-slate-800', 'font-bold');
            }
        }

        // Kalkulasi ulang jika ada old() values (setelah validasi gagal)
        document.addEventListener('DOMContentLoaded', function () {
            if (document.getElementById('jam_mulai').value) {
                calculateTotalTime();
            }
        });
    </script>
@endsection
