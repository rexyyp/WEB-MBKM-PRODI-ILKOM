@extends('layouts.dosen-pembimbing')

@section('title', 'Daftar Mahasiswa Bimbingan')

@section('content')
<div x-data="{ 
    showModal: false,
    selected: {},
    openModal(data) {
        this.selected = data;
        this.showModal = true;
    }
}" class="space-y-8 font-['Inter',sans-serif]">
    
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Mahasiswa Bimbingan</h1>
        </div>
        <p class="text-slate-600 text-lg">Daftar mahasiswa yang berada di bawah bimbingan Anda</p>
    </div>

    {{-- Main Content Card --}}
    <div class="bg-white rounded-xl shadow-md p-6">
        {{-- Filter and Search Section --}}
        <form method="GET" action="{{ route('dosen-pembimbing.mahasiswa.index') }}" class="mb-6 pb-6 border-b border-slate-200" id="filterForm">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Search Box --}}
                <div class="relative">
                    <svg class="absolute left-3 top-3 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau NIM mahasiswa" class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" onchange="document.getElementById('filterForm').submit()">
                </div>

                {{-- Status MBKM Dropdown --}}
                <div>
                    <select name="status" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 appearance-none cursor-pointer bg-white" onchange="document.getElementById('filterForm').submit()">
                        <option value="">Semua Status MBKM</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="berjalan" {{ request('status') == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                {{-- Status Dokumen Dropdown --}}
                <div>
                    <select name="dokumen" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 appearance-none cursor-pointer bg-white" onchange="document.getElementById('filterForm').submit()">
                        <option value="">Semua Dokumen</option>
                        <option value="lengkap" {{ request('dokumen') == 'lengkap' ? 'selected' : '' }}>Lengkap</option>
                        <option value="belum" {{ request('dokumen') == 'belum' ? 'selected' : '' }}>Belum Lengkap</option>
                    </select>
                </div>
            </div>
        </form>

        {{-- Table Section --}}
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50">
                        <th class="text-left text-xs font-bold text-slate-500 uppercase tracking-wider py-4 px-6">NIM</th>
                        <th class="text-left text-xs font-bold text-slate-500 uppercase tracking-wider py-4 px-6">Nama</th>
                        <th class="text-left text-xs font-bold text-slate-500 uppercase tracking-wider py-4 px-6">Mitra MBKM</th>
                        <th class="text-left text-xs font-bold text-slate-500 uppercase tracking-wider py-4 px-6">Status MBKM</th>
                        <th class="text-left text-xs font-bold text-slate-500 uppercase tracking-wider py-4 px-6">Status Dokumen</th>
                        <th class="text-center text-xs font-bold text-slate-500 uppercase tracking-wider py-4 px-6">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($pendaftarans as $pendaftaran)
                    <tr class="hover:bg-slate-50 transition-colors duration-200">
                        <td class="py-4 px-6 text-slate-600 font-medium">{{ $pendaftaran->mahasiswa->nim ?? '-' }}</td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900">{{ $pendaftaran->mahasiswa->user->name ?? '-' }}</div>
                            <div class="text-xs text-slate-500">{{ $pendaftaran->programMbkm->nama ?? '-' }}</div>
                        </td>
                        <td class="py-4 px-6 text-slate-600">{{ $pendaftaran->mitraMbkm->nama_mitra ?? '-' }}</td>
                        <td class="py-4 px-6">
                            @if($pendaftaran->status === 'menunggu')
                                <span class="inline-block bg-amber-100 text-amber-700 text-xs font-semibold px-3 py-1 rounded-full">Menunggu</span>
                            @elseif($pendaftaran->status === 'berjalan')
                                <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">Berjalan</span>
                            @elseif($pendaftaran->status === 'selesai')
                                <span class="inline-block bg-emerald-100 text-emerald-700 text-xs font-semibold px-3 py-1 rounded-full">Selesai</span>
                            @else
                                <span class="inline-block bg-slate-100 text-slate-700 text-xs font-semibold px-3 py-1 rounded-full">{{ ucfirst($pendaftaran->status) }}</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            @if($pendaftaran->dokumenMbkms->count() >= $totalDokumenWajib)
                                <span class="inline-block bg-emerald-100 text-emerald-700 text-xs font-semibold px-3 py-1 rounded-full">Lengkap</span>
                            @else
                                <span class="inline-block bg-rose-100 text-rose-700 text-xs font-semibold px-3 py-1 rounded-full">Belum Lengkap ({{ $pendaftaran->dokumenMbkms->count() }}/{{ $totalDokumenWajib }})</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center">
                            @php
                                $detailData = [
                                    'id' => $pendaftaran->id,
                                    'nama' => $pendaftaran->mahasiswa->user->name ?? '-',
                                    'nim' => $pendaftaran->mahasiswa->nim ?? '-',
                                    'mitra' => $pendaftaran->mitraMbkm->nama_mitra ?? '-',
                                    'program' => $pendaftaran->programMbkm->nama ?? '-',
                                    'posisi' => $pendaftaran->posisi_magang ?? '-',
                                    'tanggal_mulai' => \Carbon\Carbon::parse($pendaftaran->tgl_mulai)->format('d M Y'),
                                    'tanggal_selesai' => \Carbon\Carbon::parse($pendaftaran->tgl_selesai)->format('d M Y'),
                                    'status' => ucfirst($pendaftaran->status),
                                    'dokumen' => $pendaftaran->dokumenMbkms->count() >= $totalDokumenWajib ? 'Lengkap' : 'Belum Lengkap'
                                ];
                            @endphp
                            <button type="button" @click="openModal({{ json_encode($detailData) }})" class="text-blue-600 hover:text-blue-800 font-semibold transition-colors bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-xs inline-block">
                                Lihat Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-500">Tidak ada mahasiswa yang ditemukan dengan filter tersebut.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer Section (Pagination) --}}
        <div class="mt-6 pt-4 border-t border-slate-200">
            @if($pendaftarans->hasPages())
                {{ $pendaftarans->links('pagination::tailwind') }}
            @else
                <div class="flex items-center justify-between text-sm">
                    <p class="text-slate-600">Menampilkan <span class="font-semibold">{{ $pendaftarans->count() }}</span> mahasiswa bimbingan</p>
                    <p class="text-slate-500 text-xs">Scroll horizontal untuk melihat semua kolom</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Detail Modal --}}
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div x-show="showModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" 
             @click="showModal = false"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div x-show="showModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-slate-100">
            
                {{-- Modal Header --}}
                <div class="bg-slate-50 px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Detail Mahasiswa</h3>
                    </div>
                    <button @click="showModal = false" type="button" class="text-slate-400 hover:text-slate-500 bg-white shadow-sm border border-slate-200 hover:bg-slate-100 rounded-full p-2 transition-colors">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                {{-- Modal Content --}}
                <div class="px-6 py-6 space-y-6">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="flex-1 space-y-4">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Nama Mahasiswa</p>
                                <p class="text-sm font-bold text-slate-800" x-text="selected.nama"></p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">NIM</p>
                                <p class="text-sm font-medium text-slate-600" x-text="selected.nim"></p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Program MBKM</p>
                                <p class="text-sm font-medium text-slate-600" x-text="selected.program"></p>
                            </div>
                        </div>
                        <div class="flex-1 space-y-4">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Mitra MBKM</p>
                                <p class="text-sm font-bold text-blue-700" x-text="selected.mitra"></p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Posisi Magang</p>
                                <p class="text-sm font-medium text-slate-600" x-text="selected.posisi"></p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Periode Magang</p>
                                <p class="text-sm font-medium text-slate-600" x-text="`${selected.tanggal_mulai} - ${selected.tanggal_selesai}`"></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 flex flex-col md:flex-row gap-4 justify-between items-center">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Status Aktivitas MBKM</p>
                            <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full" x-text="selected.status"></span>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Kelengkapan Dokumen</p>
                            <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full"
                                  :class="selected.dokumen === 'Lengkap' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700'"
                                  x-text="selected.dokumen">
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="bg-slate-50 px-6 py-4 flex flex-col-reverse sm:flex-row items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" @click="showModal = false" class="w-full sm:w-auto inline-flex justify-center items-center gap-1.5 px-4 py-2 bg-white border border-slate-300 text-slate-700 font-bold text-sm rounded-lg hover:bg-slate-50 transition-colors shadow-sm">
                        Tutup
                    </button>
                    <a :href="`/dosen-pembimbing/bimbingan?pendaftaran_id=${selected.id}`" class="w-full sm:w-auto inline-flex justify-center items-center gap-1.5 px-4 py-2 bg-blue-600 border border-transparent text-white font-bold text-sm rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                        Menuju Bimbingan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
