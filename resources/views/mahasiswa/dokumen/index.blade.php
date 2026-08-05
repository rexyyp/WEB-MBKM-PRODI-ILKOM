@extends('layouts.mahasiswa')

@section('title', 'Dokumen - Mahasiswa')

@section('content')
    {{-- Flash Messages --}}
    @if(session('success'))
        <div id="flash-success" class="bg-white border-l-4 border-green-500 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-8 animate-fade-in-up">
            <div class="bg-green-50 p-2.5 rounded-xl text-green-600 flex-shrink-0 mt-0.5 border border-green-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-slate-800 font-bold text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div id="flash-error" class="bg-white border-l-4 border-red-500 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-8 animate-fade-in-up">
            <div class="bg-red-50 p-2.5 rounded-xl text-red-600 flex-shrink-0 mt-0.5 border border-red-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <p class="text-red-800 font-bold text-sm">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    {{-- Header Section --}}
    <div class="mb-8 animate-fade-in-up">
        <div class="flex items-center gap-4">
            <div class="bg-blue-50 border border-blue-100 p-3.5 rounded-2xl text-blue-600 shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Dokumen MBKM</h1>
                <p class="text-slate-500 mt-1 font-medium">Kelola dan pantau kelengkapan dokumen MBKM Anda.</p>
            </div>
        </div>
    </div>

    @if(!$pendaftaran)
        <div class="bg-white border-l-4 border-yellow-400 rounded-2xl p-6 flex items-start gap-4 shadow-sm border-y border-r border-slate-200 mb-8">
            <div class="bg-yellow-50 p-2.5 rounded-xl text-yellow-600 flex-shrink-0 mt-0.5 border border-yellow-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-lg mb-1">Pendaftaran MBKM Tidak Ditemukan</h3>
                <p class="text-slate-600 text-sm leading-relaxed font-medium mb-4">Anda belum memiliki pendaftaran MBKM aktif. Silakan lengkapi Data MBKM terlebih dahulu.</p>
                <a href="{{ route('mahasiswa.data-mbkm.index') }}" class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl transition-colors text-sm shadow-sm">
                    Isi Data MBKM
                </a>
            </div>
        </div>
    @else
        {{-- Progress Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-8 relative overflow-hidden group hover:shadow-md transition-all duration-300 hover:border-blue-200">
            <div class="absolute top-0 right-0 w-64 h-64 bg-slate-50 rounded-bl-full opacity-50 -z-10 group-hover:bg-blue-50/50 transition-colors duration-500"></div>
            
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="bg-slate-50 p-2 rounded-lg text-slate-600 border border-slate-100 group-hover:bg-blue-50 group-hover:text-blue-600 transition-colors duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Progress Kelengkapan</p>
                </div>
            </div>

            <div class="flex items-end justify-between mb-4">
                <p class="text-4xl font-black text-slate-800">{{ $progressPercent }}<span class="text-2xl text-slate-500 font-bold">%</span></p>
                <div class="text-right">
                    <p class="text-sm font-bold text-slate-600">{{ $uploadedCount }} dari {{ $totalDokumen }} <span class="font-medium text-slate-500">dokumen wajib</span></p>
                    @if($progressPercent === 100)
                        <span class="inline-flex items-center mt-2 bg-green-50 border border-green-100 text-green-700 text-xs font-bold px-2.5 py-1 rounded-md">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Lengkap
                        </span>
                    @endif
                </div>
            </div>

            <div class="w-full bg-slate-100 rounded-full h-3 mt-4 border border-slate-200/50">
                <div class="h-full rounded-full transition-all duration-1000 relative
                    {{ $progressPercent === 100 ? 'bg-green-500' : 'bg-blue-500' }}"
                    style="width: {{ $progressPercent }}%">
                    @if($progressPercent > 0 && $progressPercent < 100)
                        <div class="absolute right-0 top-0 bottom-0 w-8 bg-white/20 animate-pulse rounded-r-full"></div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Dokumen Sections --}}
        @foreach($dokumenSections as $sectionName => $documents)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-8">
                <div class="flex items-center gap-3 mb-6 pb-6 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100 flex-shrink-0">
                        @if($sectionName === 'Surat Administrasi')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        @elseif($sectionName === 'Dokumen Akademik')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        @elseif($sectionName === 'Bimbingan')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        @endif
                    </div>
                    <h2 class="text-xl font-bold text-slate-800 tracking-wide">{{ $sectionName }}</h2>
                </div>

                <div class="space-y-4">
                    @foreach($documents as $doc)
                        @php
                            $tenggat  = $doc['tenggat'];
                            $uploaded = $doc['uploaded'];
                            $daysLeft = $tenggat->days_left;
                            $isOverdue = $tenggat->is_overdue;
                            $isUploaded = $uploaded !== null;
                            
                            $statusBorderClass = $isUploaded ? 'border-l-4 border-l-green-400' : ($isOverdue ? 'border-l-4 border-l-red-400' : 'border-l-4 border-l-slate-200');
                            $iconBgClass = $isUploaded ? 'bg-green-50 border-green-100 text-green-600' : ($isOverdue ? 'bg-red-50 border-red-100 text-red-600' : 'bg-slate-50 border-slate-100 text-slate-400');
                        @endphp
                        
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 hover:shadow-md hover:border-slate-300 transition-all duration-300 {{ $statusBorderClass }}">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">
                                {{-- Kiri: Icon + Info --}}
                                <div class="flex items-start md:items-center gap-4 flex-1 min-w-0">
                                    <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 border {{ $iconBgClass }}">
                                        @if($isUploaded)
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        @else
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-slate-800 text-base">{{ $doc['title'] }}</p>

                                        {{-- Sub-info: Prasyarat atau Tenggat --}}
                                        <div class="mt-1">
                                            @if($tenggat->is_prasyarat && $tenggat->hint_prasyarat)
                                                <p class="text-xs font-semibold text-slate-500">{{ $tenggat->hint_prasyarat }}</p>
                                            @elseif($tenggat->tenggat_waktu)
                                                @if($isUploaded || $daysLeft >= 3)
                                                    <p class="text-xs font-semibold text-slate-500">Tenggat: {{ $tenggat->tenggat_waktu->format('d M Y') }}</p>
                                                @elseif($isOverdue)
                                                    <p class="text-xs font-bold text-red-600 flex items-center gap-1.5">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                                        Tenggat sudah lewat! ({{ $tenggat->tenggat_waktu->format('d M Y') }})
                                                    </p>
                                                @else
                                                    <p class="text-xs font-bold text-red-500 flex items-center gap-1.5">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                                        Tenggat: {{ $tenggat->tenggat_waktu->format('d M Y') }} (Sisa {{ $daysLeft }} hari)
                                                    </p>
                                                @endif
                                            @else
                                                <p class="text-xs font-medium text-slate-400 italic">Belum ada tenggat waktu</p>
                                            @endif
                                        </div>

                                        {{-- Info file jika sudah upload --}}
                                        @if($isUploaded)
                                            <p class="text-xs font-medium text-slate-500 mt-1.5 flex flex-wrap gap-2 items-center">
                                                <span class="bg-slate-100 px-2 py-0.5 rounded">{{ $uploaded->file_name }}</span>
                                                <span class="text-slate-400">&bull;</span>
                                                <span>{{ $uploaded->file_size_human }}</span>
                                                <span class="text-slate-400">&bull;</span>
                                                <span>{{ $uploaded->uploaded_at?->format('d M Y, H:i') }}</span>
                                            </p>
                                        @else
                                            <p class="text-xs font-medium text-slate-400 mt-1.5 italic">Belum ada file diunggah</p>
                                        @endif
                                    </div>
                                </div>

                                {{-- Kanan: Badge + Aksi --}}
                                <div class="flex items-center gap-3 flex-shrink-0 w-full md:w-auto mt-4 md:mt-0 pt-4 md:pt-0 border-t md:border-t-0 border-slate-100">
                                    @if($isUploaded)
                                        <span class="inline-flex items-center bg-green-50 text-green-700 border border-green-100 text-xs font-bold px-2.5 py-1.5 rounded-lg mr-2">
                                            ✓ Sudah Upload
                                        </span>
                                        <a href="{{ route('mahasiswa.dokumen.download', $uploaded->id) }}"
                                           class="text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 font-bold py-1.5 px-3.5 rounded-lg text-sm transition-colors flex items-center gap-1.5">
                                           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                            Unduh
                                        </a>
                                        <button onclick="openUploadModal('{{ $doc['kode'] }}', '{{ $doc['title'] }}')"
                                                class="text-slate-600 hover:text-slate-800 bg-slate-50 hover:bg-slate-100 font-bold py-1.5 px-3.5 rounded-lg text-sm transition-colors">
                                            Ganti
                                        </button>
                                        <form method="POST" action="{{ route('mahasiswa.dokumen.delete', $uploaded->id) }}"
                                              onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 hover:bg-red-50 font-bold py-1.5 px-3.5 rounded-lg text-sm transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="inline-flex items-center bg-slate-50 text-slate-500 border border-slate-200 text-xs font-bold px-2.5 py-1.5 rounded-lg mr-2">
                                            Belum Upload
                                        </span>

                                        @if($doc['is_disabled'])
                                            <button disabled
                                                    class="bg-slate-100 text-slate-400 font-bold py-2 px-5 rounded-xl text-sm cursor-not-allowed border border-slate-200 flex items-center gap-2"
                                                    title="{{ $tenggat->hint_prasyarat }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                                Terkunci
                                            </button>
                                        @else
                                            <button onclick="openUploadModal('{{ $doc['kode'] }}', '{{ $doc['title'] }}')"
                                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded-xl text-sm transition-colors shadow-sm flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
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
