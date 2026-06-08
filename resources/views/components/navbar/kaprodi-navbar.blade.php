<nav class="bg-white border-b border-slate-200 sticky top-0 z-40 shadow-sm">
    <div class="px-8 py-3.5 flex items-center justify-between">
        {{-- Left: Logo and Title --}}
        <div></div>

        {{-- Right: User Menu --}}
        <div class="flex items-center gap-6">
            {{-- Notifications --}}
            <button class="relative p-2 text-slate-600 hover:text-slate-900 bg-slate-50 hover:bg-slate-100 rounded-full transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>

            {{-- Divider --}}
            <div class="w-px h-6 bg-slate-200"></div>

            {{-- User Profile --}}
            {{-- User Profile --}}
            <div class="flex items-center gap-3 cursor-pointer hover:opacity-75 transition-opacity duration-200">
                <div class="text-right">
                    <p class="font-bold text-slate-900 text-sm">Dr. Budi Santoso, M.Kom.</p>
                    <p class="text-xs text-blue-600 font-semibold">Kepala Program Studi</p>
                </div>
            </div>
        </div>
    </div>
</nav>
