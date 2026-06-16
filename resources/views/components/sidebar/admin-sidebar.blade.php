<aside class="w-64 bg-white border-r border-slate-200 min-h-screen flex flex-col shadow-sm">
    {{-- Header --}}
    <div class="h-16 flex items-center px-6 border-b border-slate-200">
        <div>
            <h1 class="font-bold text-xl text-blue-700">MBKM Portal</h1>
            <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400">Admin Panel</p>
        </div>
    </div>

    {{-- Nav Menu --}}
    <div class="px-4 py-5 flex-1 overflow-y-auto">
        <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400 mb-3 px-2">Menu Utama</p>
        <nav class="space-y-1">

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors text-sm
                      {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Dashboard
            </a>

            {{-- Pendaftar (dengan badge pending) --}}
            <a href="{{ route('admin.pendaftar.index') }}"
               class="flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors text-sm
                      {{ request()->routeIs('admin.pendaftar.*') ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'text-slate-600 hover:bg-slate-50 hover:text-amber-600' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Pendaftar
                </div>
                @php
                    $pendingCount = \App\Models\User::where('role','mahasiswa')->where('is_active', false)->count();
                @endphp
                @if($pendingCount > 0)
                    <span class="text-xs font-bold bg-amber-500 text-white px-1.5 py-0.5 rounded-full min-w-[20px] text-center">
                        {{ $pendingCount > 99 ? '99+' : $pendingCount }}
                    </span>
                @endif
            </a>

            <a href="{{ route('admin.mahasiswa.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors text-sm
                      {{ request()->routeIs('admin.mahasiswa.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Mahasiswa
            </a>

            <a href="{{ route('admin.dosen.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors text-sm
                      {{ request()->routeIs('admin.dosen.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Kelola Dosen
            </a>

            <a href="{{ route('admin.mitra.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors text-sm
                      {{ request()->routeIs('admin.mitra.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Mitra MBKM
            </a>

            <a href="{{ route('admin.assign.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors text-sm
                      {{ request()->routeIs('admin.assign.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
                Penugasan
            </a>

            <a href="{{ route('admin.monitoring.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors text-sm
                      {{ request()->routeIs('admin.monitoring.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Monitoring
            </a>

            <a href="{{ route('admin.penilaian.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors text-sm
                      {{ request()->routeIs('admin.penilaian.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                Penilaian
            </a>

            <a href="{{ route('admin.laporan.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors text-sm
                      {{ request()->routeIs('admin.laporan.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Laporan
            </a>
        </nav>
    </div>

    {{-- Logout --}}
    <div class="px-4 py-4 border-t border-slate-200">
        <a href="{{ route('auth.logout') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 hover:bg-red-50 hover:text-red-600 font-medium transition-colors text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            Keluar
        </a>
    </div>
</aside>
