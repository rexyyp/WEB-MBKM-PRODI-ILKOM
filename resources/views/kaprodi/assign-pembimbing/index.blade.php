@extends('layouts.kaprodi')

@section('title', 'Assign Pembimbing & Penguji - Kaprodi Panel')

@section('content')
<div x-data="{ 
        showModal: false, 
        studentName: '', 
        studentNim: '', 
        studentMitra: '',
        assignId: null,
        pembimbingId: '',
        pengujiId: ''
    }"
    @set-assign-data.window="assignId = $event.detail.id; pembimbingId = $event.detail.pembimbing; pengujiId = $event.detail.penguji;">
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Assign Pembimbing & Penguji</h1>
        </div>
        <p class="text-slate-600 text-lg">Tentukan dosen pembimbing dan penguji untuk mahasiswa MBKM</p>
    </div>

    {{-- Main Content Container --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        {{-- Action Bar --}}
        <div class="p-6 border-b border-slate-100 bg-white">
            <form action="{{ route('kaprodi.assign-pembimbing.index') }}" method="GET" class="flex flex-col sm:flex-row sm:items-center gap-4 w-full">
                {{-- Search --}}
                <div class="relative w-full sm:w-96">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2.5 border-none rounded-lg leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-sm font-medium" placeholder="Cari nama atau NIM mahasiswa...">
                </div>

                {{-- Filters --}}
                <div class="flex items-center gap-3 w-full sm:w-auto overflow-x-auto pb-2 sm:pb-0">
                    <div class="relative w-44 flex-shrink-0">
                        <select name="status" onchange="this.form.submit()" class="block w-full pl-4 pr-10 py-2.5 border-none rounded-lg leading-5 bg-slate-50 text-slate-700 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-sm appearance-none">
                            <option value="">Semua Status</option>
                            <option value="belum_assign" {{ request('status') == 'belum_assign' ? 'selected' : '' }}>Belum assign</option>
                            <option value="sudah_assign" {{ request('status') == 'sudah_assign' ? 'selected' : '' }}>Sudah assign</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
                <button type="submit" class="hidden">Search</button>
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            NIM & Nama Mahasiswa
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Mitra MBKM
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Pembimbing
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Penguji
                        </th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-8 py-5 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    @forelse ($pendaftarans as $p)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="text-sm font-medium text-slate-500 mb-1">{{ $p->mahasiswa->nim ?? '-' }}</div>
                            <div class="text-sm font-bold text-slate-900 leading-tight">{{ $p->mahasiswa->user->name ?? '-' }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-bold text-slate-800">{{ $p->mitraMbkm->nama_mitra ?? '-' }} - {{ $p->posisi_magang ?? '-' }}</div>
                        </td>
                        <td class="px-8 py-6">
                            @if ($p->dosen_pembimbing_id)
                                <span class="text-sm font-semibold text-slate-700">{{ $p->dosenPembimbing->user->name ?? '-' }}</span>
                            @else
                                <span class="text-sm font-medium text-slate-400">Belum ditentukan</span>
                            @endif
                        </td>
                        <td class="px-8 py-6">
                            @if ($p->dosen_penguji_id)
                                <span class="text-sm font-semibold text-slate-700">{{ $p->dosenPenguji->user->name ?? '-' }}</span>
                            @else
                                <span class="text-sm font-medium text-slate-400">Belum ditentukan</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            @if ($p->dosen_pembimbing_id && $p->dosen_penguji_id)
                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[11px] font-bold bg-green-100 text-green-700 tracking-wide">
                                    SUDAH DITENTUKAN
                                </span>
                            @else
                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[11px] font-bold bg-red-50 text-red-600 tracking-wide">
                                    BELUM DITENTUKAN
                                </span>
                            @endif
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-right">
                            <button 
                                @click="showModal = true; studentName = '{{ addslashes($p->mahasiswa->user->name ?? '') }}'; studentNim = '{{ addslashes($p->mahasiswa->nim ?? '') }}'; studentMitra = '{{ addslashes(($p->mitraMbkm->nama_mitra ?? '') . ' - ' . ($p->posisi_magang ?? '')) }}'; $dispatch('set-assign-data', { id: {{ $p->id }}, pembimbing: '{{ $p->dosen_pembimbing_id ?? '' }}', penguji: '{{ $p->dosen_penguji_id ?? '' }}' })"
                                class="{{ $p->dosen_pembimbing_id && $p->dosen_penguji_id ? 'inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors gap-1.5' : 'inline-flex items-center px-5 py-2 rounded-lg text-sm font-bold bg-blue-600 hover:bg-blue-700 text-white transition-colors' }}">
                                {{ $p->dosen_pembimbing_id && $p->dosen_penguji_id ? 'Ubah' : 'Assign' }}
                                @if ($p->dosen_pembimbing_id && $p->dosen_penguji_id)
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                @endif
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-8 text-center text-slate-400 font-medium">
                            Tidak ada data mahasiswa.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
            {{ $pendaftarans->links() }}
        </div>
    </div>

    {{-- Modal Assign Dosen --}}
    <div 
        x-show="showModal" 
        style="display: none;"
        class="fixed inset-0 z-50 overflow-y-auto" 
        aria-labelledby="modal-title" 
        role="dialog" 
        aria-modal="true"
    >
        {{-- Backdrop --}}
        <div 
            x-show="showModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" 
            @click="showModal = false"
        ></div>

        {{-- Modal Panel --}}
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div 
                x-show="showModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
            >
                {{-- Modal Header --}}
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-slate-800" id="modal-title">
                        Tentukan Dosen Pembimbing & Penguji
                    </h3>
                    <button @click="showModal = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                {{-- Modal Body --}}
                <form :action="`{{ url('kaprodi/assign-pembimbing') }}/${assignId}`" method="POST">
                    @csrf
                    <div class="px-6 py-5">
                        {{-- Informasi Konteks --}}
                        <div class="bg-slate-50 rounded-lg p-4 mb-6 border border-slate-100">
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">Data Mahasiswa</p>
                            <div class="flex flex-col gap-1">
                                <p class="text-sm font-bold text-slate-900" x-text="studentName + ' (' + studentNim + ')'"></p>
                                <p class="text-sm font-medium text-slate-600 flex items-center gap-1.5 mt-1">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <span x-text="studentMitra"></span>
                                </p>
                            </div>
                        </div>

                        {{-- Form Inputs --}}
                        <div class="space-y-5">
                            {{-- Pilih Pembimbing --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Pilih Dosen Pembimbing</label>
                                <div class="relative">
                                    <select name="dosen_pembimbing_id" x-model="pembimbingId" required class="block w-full pl-4 pr-10 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm font-medium text-slate-700 appearance-none bg-white">
                                        <option value="" disabled selected>Pilih dosen pembimbing...</option>
                                        @foreach ($dosens as $dosen)
                                            <option value="{{ $dosen->id }}">{{ $dosen->user->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Pilih Penguji --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Pilih Dosen Penguji</label>
                                <div class="relative">
                                    <select name="dosen_penguji_id" x-model="pengujiId" required class="block w-full pl-4 pr-10 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm font-medium text-slate-700 appearance-none bg-white">
                                        <option value="" disabled selected>Pilih dosen penguji...</option>
                                        @foreach ($dosens as $dosen)
                                            <option value="{{ $dosen->id }}">{{ $dosen->user->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Footer --}}
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex items-center justify-end gap-3 rounded-b-2xl">
                        <button type="button" @click="showModal = false" class="px-5 py-2.5 rounded-lg text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2.5 rounded-lg text-sm font-bold bg-blue-600 hover:bg-blue-700 text-white transition-colors shadow-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
