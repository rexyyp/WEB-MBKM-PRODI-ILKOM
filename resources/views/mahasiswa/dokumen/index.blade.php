@extends('layouts.mahasiswa')

@section('title', 'Dokumen - Mahasiswa')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900 mb-2">Dokumen MBKM</h1>
        <p class="text-slate-600 text-lg">Kelola dan pantau kelengkapan dokumen MBKM Anda</p>
    </div>

    {{-- Progress Card --}}
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-sm font-semibold text-slate-600 uppercase">Progress Kelengkapan</p>
                <p class="text-2xl font-bold text-slate-900 mt-1">75%</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-slate-600">9 dari 12 dokumen telah diunggah</p>
            </div>
        </div>
        <div class="w-full bg-slate-200 rounded-full h-3">
            <div class="bg-blue-600 h-3 rounded-full" style="width: 75%"></div>
        </div>
    </div>

    @php
        // Data simulasi dokumen beserta deadline & sisa harinya
        $documentSections = [
            'Surat Administrasi' => [
                ['title' => 'Permohonan Mahasiswa → Prodi', 'filename' => 'permohonan_mahasiswa.pdf', 'size' => '245 KB', 'status' => 'SUDAH UPLOAD', 'type' => 'prerequisite', 'hint' => 'Dokumen wajib inisiasi pendaftaran MBKM.', 'is_disabled' => false, 'icon_bg' => 'bg-blue-100', 'icon_text' => 'text-blue-600'],
                ['title' => 'Fakultas → Perusahaan', 'filename' => null, 'size' => null, 'status' => 'BELUM UPLOAD', 'type' => 'prerequisite', 'hint' => 'Surat pengantar resmi dari pihak fakultas.', 'is_disabled' => false, 'icon_bg' => 'bg-blue-100', 'icon_text' => 'text-blue-600'],
                ['title' => 'Penerimaan Magang', 'filename' => null, 'size' => null, 'status' => 'BELUM UPLOAD', 'type' => 'prerequisite', 'hint' => 'Wajib diunggah agar dapat mengakses pengisian Logbook.', 'is_disabled' => true, 'icon_bg' => 'bg-red-100', 'icon_text' => 'text-red-600'],
            ],
            'Dokumen Akademik' => [
                ['title' => 'Proposal MBKM', 'filename' => 'proposal_mbkm_v2.pdf', 'size' => '512 KB', 'status' => 'SUDAH UPLOAD', 'type' => 'deadline', 'deadline' => '10 Apr 2026', 'days_left' => 30, 'icon_bg' => 'bg-blue-100', 'icon_text' => 'text-blue-600'],
                ['title' => 'Laporan MBKM', 'filename' => null, 'size' => null, 'status' => 'BELUM UPLOAD', 'type' => 'deadline', 'deadline' => '08 Jun 2026', 'days_left' => 1, 'icon_bg' => 'bg-red-100', 'icon_text' => 'text-red-600'],
                ['title' => 'Berita Acara', 'filename' => 'berita_acara.pdf', 'size' => '156 KB', 'status' => 'SUDAH UPLOAD', 'type' => 'deadline', 'deadline' => '15 Jun 2026', 'days_left' => 8, 'icon_bg' => 'bg-green-100', 'icon_text' => 'text-green-600'],
                ['title' => 'Daftar Hadir', 'filename' => 'daftar_hadir.xlsx', 'size' => '87 KB', 'status' => 'SUDAH UPLOAD', 'type' => 'deadline', 'deadline' => '15 Jun 2026', 'days_left' => 8, 'icon_bg' => 'bg-blue-100', 'icon_text' => 'text-blue-600'],
            ],
            'Bimbingan' => [
                ['title' => 'Bukti Bimbingan Pembimbing Lapangan', 'filename' => 'bukti_bimbingan_lapangan.pdf', 'size' => '234 KB', 'status' => 'SUDAH UPLOAD', 'type' => 'deadline', 'deadline' => '20 Jun 2026', 'days_left' => 13, 'icon_bg' => 'bg-blue-100', 'icon_text' => 'text-blue-600'],
                ['title' => 'Bukti Bimbingan Dosen Pembimbing', 'filename' => 'bukti_bimbingan_dosen.pdf', 'size' => '267 KB', 'status' => 'SUDAH UPLOAD', 'type' => 'deadline', 'deadline' => '20 Jun 2026', 'days_left' => 13, 'icon_bg' => 'bg-blue-100', 'icon_text' => 'text-blue-600'],
            ],
            'Output MBKM' => [
                ['title' => 'Artikel / Publikasi / HKI', 'filename' => 'artikel_publikasi.pdf', 'size' => '445 KB', 'status' => 'SUDAH UPLOAD', 'type' => 'deadline', 'deadline' => '30 Jun 2026', 'days_left' => 23, 'icon_bg' => 'bg-purple-100', 'icon_text' => 'text-purple-600'],
                ['title' => 'Transkrip Nilai dari Mitra', 'filename' => 'transkrip_nilai_mitra.pdf', 'size' => '189 KB', 'status' => 'SUDAH UPLOAD', 'type' => 'deadline', 'deadline' => '05 Jul 2026', 'days_left' => 28, 'icon_bg' => 'bg-orange-100', 'icon_text' => 'text-orange-600'],
                ['title' => 'Sertifikat MBKM / Paklaring', 'filename' => null, 'size' => null, 'status' => 'BELUM UPLOAD', 'type' => 'deadline', 'deadline' => '10 Jun 2026', 'days_left' => 2, 'icon_bg' => 'bg-red-100', 'icon_text' => 'text-red-600'],
            ]
        ];
    @endphp

    @foreach($documentSections as $sectionName => $documents)
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-4 pb-3 border-b-2 border-slate-200">{{ $sectionName }}</h2>
            <div class="space-y-4">
                @foreach($documents as $doc)
                    <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4 flex-1">
                                <div class="w-12 h-12 {{ $doc['icon_bg'] }} rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 {{ $doc['icon_text'] }}" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-slate-900">{{ $doc['title'] }}</p>
                                    
                                    {{-- LOGIKA SECTION (PRASYARAT VS TENGGAT WAKTU) --}}
                                    @if(isset($doc['type']) && $doc['type'] === 'prerequisite')
                                        {{-- Teks Petunjuk Prasyarat --}}
                                        <p class="text-sm text-slate-500 mt-0.5">{{ $doc['hint'] }}</p>
                                    @else
                                        {{-- Logika Tenggat Waktu (Normal vs Warning) --}}
                                        @if($doc['status'] == 'SUDAH UPLOAD' || $doc['days_left'] >= 3)
                                            <p class="text-sm text-slate-500 mt-0.5">Tenggat: {{ $doc['deadline'] }}</p>
                                        @else
                                            <p class="text-sm text-red-500 font-medium mt-0.5 flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                Tenggat: {{ $doc['deadline'] }} (Sisa {{ $doc['days_left'] }} hari)
                                            </p>
                                        @endif
                                    @endif

                                    <p class="text-sm text-slate-600 mt-1">
                                        {{ $doc['status'] == 'SUDAH UPLOAD' ? $doc['filename'] . ' • ' . $doc['size'] : 'Belum ada file diunggah' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                @if($doc['status'] == 'SUDAH UPLOAD')
                                    <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">✓ Sudah Upload</span>
                                    <button onclick="openViewModal('{{ $doc['title'] }}', '{{ $doc['filename'] }}', '{{ $doc['size'] }}')" class="text-blue-600 hover:text-blue-800 font-semibold py-1 px-3 transition-all duration-200">Lihat</button>
                                    <button onclick="openEditModal('{{ $doc['title'] }}', '{{ $doc['filename'] }}')" class="text-slate-500 hover:text-slate-700 font-semibold py-1 px-3 transition-all duration-200">Edit</button>
                                @else
                                    <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">● Belum Upload</span>
                                    
                                    {{-- Logika Tombol Upload Disabled untuk Prasyarat --}}
                                    @if(isset($doc['is_disabled']) && $doc['is_disabled'])
                                        <button disabled class="bg-slate-300 text-slate-500 font-semibold py-1 px-4 rounded-full cursor-not-allowed">Upload File</button>
                                    @else
                                        <button onclick="openUploadModal('{{ $doc['title'] }}')" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1 px-4 rounded-full transition-all duration-200">Upload File</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    {{-- Footer Text --}}
    <div class="text-center text-sm text-slate-500 mt-12 py-8 border-t border-slate-200">
        <p>© 2026 Sistem Manajemen MBKM • Program Studi Ilmu Komputer</p>
    </div>

    {{-- Modal Components --}}
    @include('components.document.modal-view')
    @include('components.document.modal-edit')
    @include('components.document.modal-upload')
@endsection
