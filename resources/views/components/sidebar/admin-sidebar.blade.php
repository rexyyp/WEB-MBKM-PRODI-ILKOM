<aside class="w-64 bg-slate-900 text-white min-h-screen shadow-lg">
    <div class="p-6 border-b border-slate-700">
        <h2 class="text-lg font-bold">Menu Admin</h2>
    </div>

    <nav class="flex flex-col">
        <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 hover:bg-slate-800 transition-colors flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h12a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6z"></path>
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.mahasiswa.index') }}" class="px-6 py-3 hover:bg-slate-800 transition-colors flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5M6.5 6.5a2 2 0 114 0 2 2 0 01-4 0zM2.5 15.5c0-2 2-3.5 4-3.5s4 1.5 4 3.5"></path>
            </svg>
            <span>Mahasiswa</span>
        </a>

        <a href="{{ route('admin.mitra.index') }}" class="px-6 py-3 hover:bg-slate-800 transition-colors flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
            </svg>
            <span>Mitra</span>
        </a>

        <a href="{{ route('admin.assign.index') }}" class="px-6 py-3 hover:bg-slate-800 transition-colors flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 17v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.381z" clip-rule="evenodd"></path>
            </svg>
            <span>Penugasan</span>
        </a>

        <a href="{{ route('admin.monitoring.index') }}" class="px-6 py-3 hover:bg-slate-800 transition-colors flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
            </svg>
            <span>Monitoring</span>
        </a>

        <a href="{{ route('admin.penilaian.index') }}" class="px-6 py-3 hover:bg-slate-800 transition-colors flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
            <span>Penilaian</span>
        </a>

        <a href="{{ route('admin.laporan.index') }}" class="px-6 py-3 hover:bg-slate-800 transition-colors flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm1 2a1 1 0 000 2h6a1 1 0 100-2H7zm0 4a1 1 0 100 2h6a1 1 0 100-2H7zm0 4a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
            </svg>
            <span>Laporan</span>
        </a>
    </nav>
</aside>
