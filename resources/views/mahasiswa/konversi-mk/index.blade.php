@extends('layouts.mahasiswa')

@section('title', 'Konversi Mata Kuliah - Mahasiswa')

@section('content')
    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="bg-white border-l-4 border-green-500 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-8 animate-fade-in-up">
            <div class="bg-green-50 p-2.5 rounded-xl text-green-600 flex-shrink-0 mt-0.5 border border-green-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-slate-800 font-bold text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-white border-l-4 border-red-500 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-8 animate-fade-in-up">
            <div class="bg-red-50 p-2.5 rounded-xl text-red-600 flex-shrink-0 mt-0.5 border border-red-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <p class="text-red-800 font-bold text-sm">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    {{-- Header Section with Status --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6 animate-fade-in-up">
        <div class="flex items-center gap-4">
            <div class="bg-blue-50 border border-blue-100 p-3.5 rounded-2xl text-blue-600 shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Konversi Mata Kuliah</h1>
                <p class="text-slate-500 mt-1 font-medium">Informasi hasil konversi mata kuliah dari kegiatan MBKM Anda.</p>
            </div>
        </div>

        {{-- Status Badge --}}
        @if ($konversiSks)
            @php
                $statusBadge = match($konversiSks->status) {
                    'pending'   => ['bg' => 'bg-yellow-50', 'border' => 'border-yellow-200', 'dot' => 'bg-yellow-400', 'text' => 'text-yellow-700', 'label' => 'Belum Diajukan'],
                    'diproses'  => ['bg' => 'bg-blue-50',   'border' => 'border-blue-200',   'dot' => 'bg-blue-500',   'text' => 'text-blue-700',   'label' => 'Sedang Diproses'],
                    'disetujui' => ['bg' => 'bg-green-50',  'border' => 'border-green-200',  'dot' => 'bg-green-500',  'text' => 'text-green-700',  'label' => 'Disetujui'],
                    'ditolak'   => ['bg' => 'bg-red-50',    'border' => 'border-red-200',    'dot' => 'bg-red-500',    'text' => 'text-red-700',    'label' => 'Ditolak'],
                    default     => ['bg' => 'bg-slate-50',  'border' => 'border-slate-200',  'dot' => 'bg-slate-400',  'text' => 'text-slate-700',  'label' => 'Tidak Diketahui'],
                };
            @endphp
            <div class="flex items-center gap-2 {{ $statusBadge['bg'] }} px-4 py-2 rounded-xl border {{ $statusBadge['border'] }} shrink-0 w-fit shadow-sm">
                <span class="w-2.5 h-2.5 {{ $statusBadge['dot'] }} rounded-full animate-pulse"></span>
                <span class="text-sm font-bold {{ $statusBadge['text'] }}">Status: {{ $statusBadge['label'] }}</span>
            </div>
        @else
            <div class="flex items-center gap-2 bg-slate-50 px-4 py-2 rounded-xl border border-slate-200 shrink-0 w-fit shadow-sm">
                <span class="w-2.5 h-2.5 bg-slate-400 rounded-full"></span>
                <span class="text-sm font-bold text-slate-600">Belum Ada Konversi</span>
            </div>
        @endif
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Total Mata Kuliah --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md hover:border-blue-200 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-slate-50 group-hover:bg-blue-50 p-3 rounded-xl transition-colors duration-300 border border-slate-100 group-hover:border-blue-100">
                    <svg class="w-6 h-6 text-slate-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Mata Kuliah</p>
                <p class="text-2xl font-black text-slate-800">{{ $totalMk }} <span class="text-base font-bold text-slate-500">MK</span></p>
            </div>
        </div>

        {{-- Total SKS --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md hover:border-blue-200 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-slate-50 group-hover:bg-blue-50 p-3 rounded-xl transition-colors duration-300 border border-slate-100 group-hover:border-blue-100">
                    <svg class="w-6 h-6 text-slate-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                </div>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total SKS Terkonversi</p>
                <p class="text-2xl font-black text-slate-800">{{ $totalSks }} <span class="text-base font-bold text-slate-500">SKS</span></p>
            </div>
        </div>

        {{-- Status Konversi (Special Blue Card adjusted) --}}
        <div class="bg-blue-50 rounded-2xl shadow-sm border border-blue-100 p-6 hover:shadow-md transition-all duration-300 group relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-100 rounded-full opacity-50 z-0"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-blue-100 p-3 rounded-xl border border-blue-200">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div>
                    <p class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">Total SKS Valid</p>
                    @if ($konversiSks)
                        @php
                            $statusLabel = match($konversiSks->status) {
                                'pending'   => 'Belum Diajukan',
                                'diproses'  => 'Sedang Diproses',
                                'disetujui' => 'Disetujui',
                                'ditolak'   => 'Ditolak',
                                default     => '—',
                            };
                        @endphp
                        <p class="text-2xl font-black text-slate-800 mb-1">{{ $totalSks }} <span class="text-base font-bold text-slate-500">SKS</span></p>
                    @else
                        <p class="text-2xl font-black text-slate-800 mb-1">Belum Ada</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Alert / Info Card --}}
    @if (!$pendaftaran)
        <div class="bg-white border-l-4 border-yellow-400 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-8">
            <div class="bg-yellow-50 p-2.5 rounded-xl text-yellow-600 flex-shrink-0 mt-0.5 border border-yellow-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-lg mb-1">Pendaftaran MBKM Tidak Ditemukan</h3>
                <p class="text-slate-600 text-sm leading-relaxed font-medium">Anda belum memiliki pendaftaran MBKM aktif. Silakan isi data MBKM terlebih dahulu di halaman Data MBKM.</p>
            </div>
        </div>
    @elseif ($konversiSks && $konversiSks->status === 'disetujui')
        <div class="bg-white border-l-4 border-blue-500 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-8">
            <div class="bg-blue-50 p-2.5 rounded-xl text-blue-600 flex-shrink-0 mt-0.5 border border-blue-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-lg mb-1">Konversi Disetujui</h3>
                <p class="text-slate-600 text-sm leading-relaxed font-medium">Konversi mata kuliah telah disetujui oleh Koordinator Program Studi.</p>
            </div>
        </div>
    @elseif ($konversiSks && $konversiSks->status === 'diproses')
        <div class="bg-white border-l-4 border-blue-500 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-8">
            <div class="bg-blue-50 p-2.5 rounded-xl text-blue-600 flex-shrink-0 mt-0.5 border border-blue-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-lg mb-1">Sedang Diproses</h3>
                <p class="text-slate-600 text-sm leading-relaxed font-medium">Pengajuan konversi sedang diproses oleh Koordinator Program Studi. Anda tidak dapat mengubah daftar mata kuliah saat pengajuan sedang diproses.</p>
            </div>
        </div>
    @elseif ($konversiSks && $konversiSks->status === 'ditolak')
        <div class="bg-white border-l-4 border-red-500 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-8">
            <div class="bg-red-50 p-2.5 rounded-xl text-red-600 flex-shrink-0 mt-0.5 border border-red-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-lg mb-1">Konversi Ditolak</h3>
                <p class="text-slate-600 text-sm leading-relaxed font-medium">Pengajuan konversi ditolak. Silakan perbarui daftar mata kuliah dan ajukan kembali.</p>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <div class="mb-8">
        {{-- Daftar Konversi --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <div class="flex items-center gap-3">
                    <div class="bg-slate-50 p-2 rounded-lg text-slate-600 border border-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    </div>
                    <h2 class="text-lg font-bold text-slate-800">Daftar Konversi Mata Kuliah</h2>
                </div>

                {{-- Tombol Tambah: hanya tampil jika belum diproses/disetujui --}}
                @if ($pendaftaran && (!$konversiSks || in_array($konversiSks->status, ['pending', 'ditolak'])))
                    <a href="{{ route('mahasiswa.konversi-mk.create') }}"
                       class="w-fit px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all duration-300 flex items-center gap-2 shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Mata Kuliah
                    </a>
                @endif
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-xl border border-slate-100">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 text-xs uppercase tracking-wider font-bold">
                            <th class="py-4 px-6 rounded-tl-xl">Kode MK</th>
                            <th class="py-4 px-6">Nama Mata Kuliah</th>
                            <th class="py-4 px-6 text-center">SKS</th>
                            <th class="py-4 px-6 text-center">Status</th>
                            <th class="py-4 px-6 text-center rounded-tr-xl">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($details as $detail)
                            @php
                                $mk = $detail->mataKuliah;
                                $statusRow = match($konversiSks?->status) {
                                    'disetujui' => ['label' => 'Terkonversi', 'class' => 'bg-green-50 border border-green-100 text-green-700'],
                                    'diproses'  => ['label' => 'Diproses',    'class' => 'bg-blue-50 border border-blue-100 text-blue-700'],
                                    'ditolak'   => ['label' => 'Ditolak',     'class' => 'bg-red-50 border border-red-100 text-red-700'],
                                    default     => ['label' => 'Pending',     'class' => 'bg-yellow-50 border border-yellow-100 text-yellow-700'],
                                };
                                $canEdit = !in_array($konversiSks?->status, ['disetujui', 'diproses']);
                            @endphp
                            <tr class="hover:bg-slate-50/50 transition-colors duration-200">
                                <td class="py-4 px-6 font-bold text-slate-800">{{ $mk?->kode_mk ?? '—' }}</td>
                                <td class="py-4 px-6 font-medium text-slate-700">{{ $mk?->nama_mk ?? '—' }}</td>
                                <td class="py-4 px-6 text-center font-bold text-slate-800">{{ $mk?->sks ?? '—' }}</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex {{ $statusRow['class'] }} text-xs font-bold px-3 py-1 rounded-full">
                                        {{ $statusRow['label'] }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        @if ($canEdit)
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('mahasiswa.konversi-mk.edit', $detail->id) }}"
                                               class="text-slate-400 hover:text-blue-600 bg-white hover:bg-blue-50 border border-slate-200 hover:border-blue-200 p-2 rounded-lg transition-all duration-300 shadow-sm"
                                               title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>

                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('mahasiswa.konversi-mk.destroy', $detail->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus mata kuliah {{ $mk?->nama_mk }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-slate-400 hover:text-red-600 bg-white hover:bg-red-50 border border-slate-200 hover:border-red-200 p-2 rounded-lg transition-all duration-300 shadow-sm"
                                                        title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-50 text-slate-400 border border-slate-100 rounded-lg text-xs font-bold">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                                Terkunci
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center">
                                    <div class="flex flex-col items-center gap-3 text-slate-400">
                                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center border border-slate-100 mb-2">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                        </div>
                                        <p class="font-bold text-slate-500">Belum ada mata kuliah konversi</p>
                                        <p class="text-sm font-medium">Klik tombol "Tambah Mata Kuliah" untuk memulai.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Action Buttons: Tombol Ajukan Konversi --}}
    @if ($pendaftaran && $konversiSks && $konversiSks->status === 'pending' && $details->isNotEmpty())
        <div class="flex justify-end mb-8">
            <form action="{{ route('mahasiswa.konversi-mk.ajukan') }}" method="POST"
                  onsubmit="return confirm('Yakin ingin mengajukan konversi mata kuliah ke Koordinator Prodi? Data tidak dapat diubah setelah diajukan.')">
                @csrf
                <button type="submit"
                        class="px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all duration-300 shadow-sm hover:shadow-md flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Ajukan Konversi
                </button>
            </form>
        </div>
    @elseif ($konversiSks && $konversiSks->status === 'ditolak')
        <div class="flex justify-end mb-8">
            <form action="{{ route('mahasiswa.konversi-mk.ajukan') }}" method="POST"
                  onsubmit="return confirm('Yakin ingin mengajukan ulang konversi mata kuliah?')">
                @csrf
                <button type="submit"
                        class="px-8 py-3.5 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-xl transition-all duration-300 shadow-sm hover:shadow-md flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Ajukan Ulang Konversi
                </button>
            </form>
        </div>
    @endif
@endsection
