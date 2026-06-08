<aside class="w-64 bg-white border-r border-slate-200 min-h-screen flex flex-col z-50 shadow-sm relative">
    <div class="h-16 flex items-center px-6 border-b border-slate-200">
        <div>
            <h1 class="font-bold text-xl text-blue-700">MBKM Portal</h1>
            <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400">Kaprodi Panel</p>
        </div>
    </div>
    <div class="px-6 py-4 flex-1 overflow-y-auto">
        <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400 mb-3">Menu Utama</p>
        <nav class="space-y-1.5">
            <a href="{{ route('kaprodi.dashboard.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('kaprodi.dashboard.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Beranda
            </a>

            <a href="{{ route('kaprodi.data-mahasiswa.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('kaprodi.data-mahasiswa.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Data Mahasiswa
            </a>
            <a href="{{ route('kaprodi.konversi-sks.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('kaprodi.konversi-sks.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                Konversi Matakuliah
            </a>
            <a href="{{ route('kaprodi.mitra-mbkm.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('kaprodi.mitra-mbkm.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                Mitra MBKM
            </a>
            <a href="{{ route('kaprodi.assign-pembimbing.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('kaprodi.assign-pembimbing.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                Assign Pembimbing
            </a>
            <a href="{{ route('kaprodi.penilaian-mbkm.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('kaprodi.penilaian-mbkm.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                Penilaian
            </a>
            <a href="{{ route('kaprodi.laporan-mbkm.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('kaprodi.laporan-mbkm.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Laporan & Rekap
            </a>
            <a href="{{ route('kaprodi.monitoring.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('kaprodi.monitoring.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                Monitoring Bimbingan
            </a>
        </nav>
    </div>
    <div class="px-6 py-4 border-t border-slate-200">
        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 hover:bg-red-50 hover:text-red-600 font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            Keluar
        </a>
    </div>
</aside>
