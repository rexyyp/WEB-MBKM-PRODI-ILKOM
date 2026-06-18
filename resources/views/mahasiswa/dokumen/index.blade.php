@extends('layouts.mahasiswa')

@section('title', 'Dokumen - Mahasiswa')

@section('content')
    {{-- Flash Messages --}}
    @if(session('success'))
        <div id="flash-success" class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl shadow-sm">
            <svg class="w-5 h-5 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div id="flash-error" class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl shadow-sm">
            <svg class="w-5 h-5 flex-shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <span class="text-sm font-medium">{{ session('error') }}</span>
        </div>
    @endif

    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="bg-blue-100 p-2.5 rounded-xl text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">Dokumen MBKM</h1>
        </div>
        <p class="text-slate-600 text-lg">Kelola dan pantau kelengkapan dokumen MBKM Anda</p>
    </div>

    @if(!$pendaftaran)
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 text-center">
            <svg class="w-12 h-12 text-amber-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <p class="text-amber-800 font-semibold">Anda belum memiliki pendaftaran MBKM aktif.</p>
            <p class="text-amber-600 text-sm mt-1">Silakan lengkapi Data MBKM terlebih dahulu.</p>
            <a href="{{ route('mahasiswa.data-mbkm.index') }}" class="inline-block mt-4 bg-amber-500 hover:bg-amber-600 text-white font-semibold py-2 px-5 rounded-lg transition-colors text-sm">Isi Data MBKM</a>
        </div>
    @else
        {{-- Progress Card --}}
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm font-semibold text-slate-600 uppercase">Progress Kelengkapan</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">{{ $progressPercent }}%</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-slate-600">{{ $uploadedCount }} dari {{ $totalDokumen }} dokumen wajib telah diunggah</p>
                    @if($progressPercent === 100)
                        <span class="inline-block mt-1 bg-green-100 text-green-700 text-xs font-bold px-2 py-0.5 rounded-full">✓ Lengkap</span>
                    @endif
                </div>
            </div>
            <div class="w-full bg-slate-200 rounded-full h-3 overflow-hidden">
                <div class="h-3 rounded-full transition-all duration-500
                    {{ $progressPercent === 100 ? 'bg-green-500' : ($progressPercent >= 50 ? 'bg-blue-600' : 'bg-amber-500') }}"
                    style="width: {{ $progressPercent }}%"></div>
            </div>
        </div>

        {{-- Dokumen Sections --}}
        @foreach($dokumenSections as $sectionName => $documents)
            <div class="mb-8">
                <h2 class="text-xl font-bold text-slate-800 mb-4 pb-3 border-b-2 border-slate-200 flex items-center gap-2">
                    @if($sectionName === 'Surat Administrasi')
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    @elseif($sectionName === 'Dokumen Akademik')
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    @elseif($sectionName === 'Bimbingan')
                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    @else
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    @endif
                    {{ $sectionName }}
                </h2>
                <div class="space-y-4">
                    @foreach($documents as $doc)
                        @php
                            $tenggat  = $doc['tenggat'];
                            $uploaded = $doc['uploaded'];
                            $daysLeft = $tenggat->days_left;
                            $isOverdue = $tenggat->is_overdue;
                            $isUploaded = $uploaded !== null;
                        @endphp
                        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 hover:shadow-md transition-shadow duration-200
                            {{ $isUploaded ? 'border-l-4 border-l-green-400' : ($isOverdue ? 'border-l-4 border-l-red-400' : 'border-l-4 border-l-slate-200') }}">
                            <div class="flex items-center justify-between gap-4">
                                {{-- Kiri: Icon + Info --}}
                                <div class="flex items-center gap-4 flex-1 min-w-0">
                                    <div class="w-11 h-11 rounded-lg flex items-center justify-center flex-shrink-0
                                        {{ $isUploaded ? 'bg-green-100' : ($isOverdue ? 'bg-red-100' : 'bg-blue-100') }}">
                                        <svg class="w-6 h-6 {{ $isUploaded ? 'text-green-600' : ($isOverdue ? 'text-red-600' : 'text-blue-600') }}" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-slate-900 text-sm">{{ $doc['title'] }}</p>

                                        {{-- Sub-info: Prasyarat atau Tenggat --}}
                                        @if($tenggat->is_prasyarat && $tenggat->hint_prasyarat)
                                            <p class="text-xs text-slate-500 mt-0.5">{{ $tenggat->hint_prasyarat }}</p>
                                        @elseif($tenggat->tenggat_waktu)
                                            @if($isUploaded || $daysLeft >= 3)
                                                <p class="text-xs text-slate-500 mt-0.5">Tenggat: {{ $tenggat->tenggat_waktu->format('d M Y') }}</p>
                                            @elseif($isOverdue)
                                                <p class="text-xs text-red-600 font-semibold mt-0.5 flex items-center gap-1">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                                    Tenggat sudah lewat! ({{ $tenggat->tenggat_waktu->format('d M Y') }})
                                                </p>
                                            @else
                                                <p class="text-xs text-red-600 font-semibold mt-0.5 flex items-center gap-1">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                                    Tenggat: {{ $tenggat->tenggat_waktu->format('d M Y') }} (Sisa {{ $daysLeft }} hari)
                                                </p>
                                            @endif
                                        @else
                                            <p class="text-xs text-slate-400 mt-0.5 italic">Belum ada tenggat waktu</p>
                                        @endif

                                        {{-- Info file jika sudah upload --}}
                                        @if($isUploaded)
                                            <p class="text-xs text-slate-500 mt-1">
                                                {{ $uploaded->file_name }} &bull; {{ $uploaded->file_size_human }}
                                                &bull; {{ $uploaded->uploaded_at?->format('d M Y, H:i') }}
                                            </p>
                                        @else
                                            <p class="text-xs text-slate-400 mt-1 italic">Belum ada file diunggah</p>
                                        @endif
                                    </div>
                                </div>

                                {{-- Kanan: Badge + Aksi --}}
                                <div class="flex items-center gap-2 flex-shrink-0">
                                    @if($isUploaded)
                                        <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-1 rounded-full">✓ Sudah Upload</span>
                                        <a href="{{ route('mahasiswa.dokumen.download', $uploaded->id) }}"
                                           class="text-blue-600 hover:text-blue-800 font-semibold py-1 px-3 text-sm transition-colors">
                                            Unduh
                                        </a>
                                        <button onclick="openUploadModal('{{ $doc['kode'] }}', '{{ $doc['title'] }}')"
                                                class="text-slate-500 hover:text-blue-600 font-semibold py-1 px-3 text-sm transition-colors">
                                            Ganti
                                        </button>
                                        <form method="POST" action="{{ route('mahasiswa.dokumen.delete', $uploaded->id) }}"
                                              onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-600 font-semibold py-1 px-2 text-sm transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-1 rounded-full">● Belum Upload</span>

                                        @if($doc['is_disabled'])
                                            <button disabled
                                                    class="bg-slate-200 text-slate-400 font-semibold py-1.5 px-4 rounded-full text-xs cursor-not-allowed"
                                                    title="{{ $tenggat->hint_prasyarat }}">
                                                Upload File
                                            </button>
                                        @else
                                            <button onclick="openUploadModal('{{ $doc['kode'] }}', '{{ $doc['title'] }}')"
                                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1.5 px-4 rounded-full text-xs transition-colors">
                                                Upload File
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif

    {{-- Footer Text --}}
    <div class="text-center text-sm text-slate-500 mt-12 py-8 border-t border-slate-200">
        <p>© {{ date('Y') }} Sistem Manajemen MBKM • Program Studi Ilmu Komputer</p>
    </div>

    {{-- Upload Modal --}}
    @include('components.document.modal-upload')

@endsection

@push('scripts')
<script>
// Auto-dismiss flash messages after 4 seconds
setTimeout(() => {
    document.getElementById('flash-success')?.remove();
    document.getElementById('flash-error')?.remove();
}, 4000);
</script>
@endpush
