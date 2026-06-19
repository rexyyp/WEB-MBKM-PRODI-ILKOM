@extends('layouts.mahasiswa')

@section('title', 'Konversi Mata Kuliah - Mahasiswa')

@section('content')
    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4 flex items-start gap-3">
            <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <p class="text-sm font-semibold text-green-900">{{ session('success') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 flex items-start gap-3">
            <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <p class="text-sm font-semibold text-red-900">{{ session('error') }}</p>
        </div>
    @endif

    {{-- Header Section with Status --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </div>
                <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Konversi Mata Kuliah</h1>
            </div>
            <p class="text-slate-600 text-lg">Informasi hasil konversi mata kuliah dari kegiatan MBKM.</p>
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
            <div class="flex items-center gap-2 {{ $statusBadge['bg'] }} px-4 py-2 rounded-full border {{ $statusBadge['border'] }} shrink-0 w-fit">
                <span class="w-2 h-2 {{ $statusBadge['dot'] }} rounded-full"></span>
                <span class="text-sm font-semibold {{ $statusBadge['text'] }}">Status Konversi: {{ $statusBadge['label'] }}</span>
            </div>
        @else
            <div class="flex items-center gap-2 bg-slate-50 px-4 py-2 rounded-full border border-slate-200 shrink-0 w-fit">
                <span class="w-2 h-2 bg-slate-400 rounded-full"></span>
                <span class="text-sm font-semibold text-slate-600">Belum Ada Konversi</span>
            </div>
        @endif
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Total Mata Kuliah --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider mb-3">Total Mata Kuliah</p>
            <p class="text-4xl font-bold text-slate-900">{{ $totalMk }} <span class="text-lg font-semibold">MK</span></p>
        </div>

        {{-- Total SKS --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider mb-3">Total SKS</p>
            <p class="text-4xl font-bold text-slate-900">{{ $totalSks }} <span class="text-lg font-semibold">SKS</span></p>
        </div>

        {{-- Status Konversi (Special Blue Card) --}}
        <div class="bg-blue-600 rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <p class="text-xs font-semibold text-blue-100 uppercase tracking-wider mb-3">Status Konversi</p>
            @if ($konversiSks)
                @php
                    $statusLabel = match($konversiSks->status) {
                        'pending'   => 'Belum Diajukan',
                        'diproses'  => 'Diproses',
                        'disetujui' => 'Disetujui',
                        'ditolak'   => 'Ditolak',
                        default     => '—',
                    };
                @endphp
                <p class="text-3xl font-bold text-white mb-1">{{ $statusLabel }}</p>
                <p class="text-lg font-semibold text-blue-100">{{ $totalSks }} SKS</p>
            @else
                <p class="text-2xl font-bold text-white mb-1">Belum Ada</p>
                <p class="text-sm text-blue-100">0 SKS</p>
            @endif
        </div>
    </div>

    {{-- Alert / Info Card --}}
    @if (!$pendaftaran)
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-8 flex items-start gap-4">
            <svg class="w-6 h-6 text-yellow-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="text-sm font-semibold text-yellow-900">Anda belum memiliki pendaftaran MBKM aktif.</p>
                <p class="text-sm text-yellow-800 mt-1">Silakan isi data MBKM terlebih dahulu di halaman Data MBKM.</p>
            </div>
        </div>
    @elseif ($konversiSks && $konversiSks->status === 'disetujui')
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-8 flex items-start gap-4">
            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="text-sm font-semibold text-blue-900">Konversi mata kuliah telah disetujui oleh Koordinator Program Studi.</p>
            </div>
        </div>
    @elseif ($konversiSks && $konversiSks->status === 'diproses')
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-8 flex items-start gap-4">
            <svg class="w-6 h-6 text-blue-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="text-sm font-semibold text-blue-900">Pengajuan konversi sedang diproses oleh Koordinator Program Studi.</p>
                <p class="text-sm text-blue-800 mt-1">Anda tidak dapat mengubah daftar mata kuliah saat pengajuan sedang diproses.</p>
            </div>
        </div>
    @elseif ($konversiSks && $konversiSks->status === 'ditolak')
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-8 flex items-start gap-4">
            <svg class="w-6 h-6 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="text-sm font-semibold text-red-900">Pengajuan konversi ditolak. Silakan perbarui daftar mata kuliah dan ajukan kembali.</p>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <div class="mb-8">
        {{-- Daftar Konversi --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h2 class="text-2xl font-bold text-slate-900">Daftar Konversi Mata Kuliah</h2>

                {{-- Tombol Tambah: hanya tampil jika belum diproses/disetujui --}}
                @if ($pendaftaran && (!$konversiSks || in_array($konversiSks->status, ['pending', 'ditolak'])))
                    <a href="{{ route('mahasiswa.konversi-mk.create') }}"
                       class="w-fit px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Mata Kuliah
                    </a>
                @endif
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50">
                            <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider py-4 px-6">Kode MK</th>
                            <th class="text-left text-xs font-semibold text-slate-600 uppercase tracking-wider py-4 px-6">Nama Mata Kuliah</th>
                            <th class="text-center text-xs font-semibold text-slate-600 uppercase tracking-wider py-4 px-6">SKS</th>
                            <th class="text-center text-xs font-semibold text-slate-600 uppercase tracking-wider py-4 px-6">Status</th>
                            <th class="text-center text-xs font-semibold text-slate-600 uppercase tracking-wider py-4 px-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse ($details as $detail)
                            @php
                                $mk = $detail->mataKuliah;
                                $statusRow = match($konversiSks?->status) {
                                    'disetujui' => ['label' => 'Terkonversi', 'class' => 'bg-green-100 text-green-700'],
                                    'diproses'  => ['label' => 'Diproses',   'class' => 'bg-blue-100 text-blue-700'],
                                    'ditolak'   => ['label' => 'Ditolak',    'class' => 'bg-red-100 text-red-700'],
                                    default     => ['label' => 'Pending',    'class' => 'bg-yellow-100 text-yellow-700'],
                                };
                                $canEdit = !in_array($konversiSks?->status, ['disetujui', 'diproses']);
                            @endphp
                            <tr class="hover:bg-slate-50 transition-colors duration-200">
                                <td class="py-4 px-6 font-semibold text-slate-900">{{ $mk?->kode_mk ?? '—' }}</td>
                                <td class="py-4 px-6 text-slate-700">{{ $mk?->nama_mk ?? '—' }}</td>
                                <td class="py-4 px-6 text-center font-semibold text-slate-900">{{ $mk?->sks ?? '—' }}</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-block {{ $statusRow['class'] }} text-xs font-semibold px-3 py-1 rounded-full">
                                        {{ $statusRow['label'] }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        @if ($canEdit)
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('mahasiswa.konversi-mk.edit', $detail->id) }}"
                                               class="text-slate-400 hover:text-blue-600 bg-white hover:bg-blue-50 border border-slate-200 hover:border-blue-200 p-2 rounded-lg transition-colors duration-200 shadow-sm"
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
                                                        class="text-slate-400 hover:text-red-600 bg-white hover:bg-red-50 border border-slate-200 hover:border-red-200 p-2 rounded-lg transition-colors duration-200 shadow-sm"
                                                        title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-slate-400 italic">Terkunci</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center">
                                    <div class="flex flex-col items-center gap-3 text-slate-400">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        <p class="font-semibold text-slate-500">Belum ada mata kuliah konversi</p>
                                        <p class="text-sm">Klik tombol "Tambah Mata Kuliah" untuk memulai.</p>
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
        <div class="flex justify-end">
            <form action="{{ route('mahasiswa.konversi-mk.ajukan') }}" method="POST"
                  onsubmit="return confirm('Yakin ingin mengajukan konversi mata kuliah ke Koordinator Prodi? Data tidak dapat diubah setelah diajukan.')">
                @csrf
                <button type="submit"
                        class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-full transition-all duration-200 shadow-md hover:shadow-lg">
                    Ajukan Konversi
                </button>
            </form>
        </div>
    @elseif ($konversiSks && $konversiSks->status === 'ditolak')
        <div class="flex justify-end">
            <form action="{{ route('mahasiswa.konversi-mk.ajukan') }}" method="POST"
                  onsubmit="return confirm('Yakin ingin mengajukan ulang konversi mata kuliah?')">
                @csrf
                <button type="submit"
                        class="px-8 py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-full transition-all duration-200 shadow-md hover:shadow-lg">
                    Ajukan Ulang Konversi
                </button>
            </form>
        </div>
    @endif
@endsection
