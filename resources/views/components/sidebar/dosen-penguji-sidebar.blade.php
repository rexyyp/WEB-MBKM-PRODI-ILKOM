<aside class="w-64 bg-white border-r border-slate-200 min-h-screen flex flex-col z-50 shadow-sm relative">
    <div class="h-16 flex items-center px-6 border-b border-slate-200">
        <div>
            <h1 class="font-bold text-xl text-blue-700">MBKM Portal</h1>
            <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400">Dosen Penguji Panel</p>
        </div>
    </div>
    <div class="px-6 py-4 flex-1 overflow-y-auto">
        <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400 mb-3">Menu Utama</p>
        <nav class="space-y-1.5">
            <a href="{{ route('dosen-penguji.dashboard.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('dosen-penguji.dashboard.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Beranda
            </a>
            <a href="{{ route('dosen-penguji.mahasiswa.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('dosen-penguji.mahasiswa.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Mahasiswa
            </a>
            <div x-data="{ open: {{ request()->routeIs('dosen-penguji.uji-kompetensi.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('dosen-penguji.uji-kompetensi.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Uji Kompetensi
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-collapse class="mt-1 pl-11 space-y-1">
                    <a href="{{ route('dosen-penguji.uji-kompetensi.proposal') }}" class="block px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('dosen-penguji.uji-kompetensi.proposal') ? 'text-blue-700 font-bold' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                        Proposal
                    </a>
                    <a href="{{ route('dosen-penguji.uji-kompetensi.laporan-akhir') }}" class="block px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('dosen-penguji.uji-kompetensi.laporan-akhir') ? 'text-blue-700 font-bold' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                        Laporan Akhir
                    </a>
                </div>
            </div>
            <a href="{{ route('dosen-penguji.penilaian.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('dosen-penguji.penilaian.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                Penilaian
            </a>
        </nav>
    </div>
    <div class="px-6 py-4 border-t border-slate-200">
        <a href="{{ route('auth.logout') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 hover:bg-red-50 hover:text-red-600 font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            Keluar
        </a>
    </div>
</aside>
