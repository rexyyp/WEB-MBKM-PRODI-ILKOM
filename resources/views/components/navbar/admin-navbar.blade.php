<nav class="h-16 bg-white border-b border-slate-200 shadow-sm flex items-center px-6">
    <div class="flex-1 flex items-center gap-4">
        {{-- Page Title (dynamic via yield or fallback) --}}
        <div class="hidden sm:block">
            <p class="text-xs text-slate-400 font-medium">MBKM Admin</p>
        </div>
    </div>

    <div class="flex items-center gap-3">
        {{-- Notification Bell --}}
        @php
            $pendingCount = \App\Models\User::where('role','mahasiswa')->where('is_active', false)->count();
        @endphp
        <a href="{{ route('admin.pendaftar.index') }}" class="relative p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            @if($pendingCount > 0)
                <span class="absolute top-1 right-1 w-2 h-2 bg-amber-500 rounded-full ring-2 ring-white"></span>
            @endif
        </a>

        {{-- Divider --}}
        <div class="h-8 w-px bg-slate-200"></div>

        {{-- User Info --}}
        <div class="flex items-center gap-3">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-semibold text-slate-900">{{ auth()->user()->name }}</p>
                <p class="text-xs text-slate-400">Administrator</p>
            </div>
            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-600 to-indigo-700 flex items-center justify-center text-white font-bold text-sm">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        </div>
    </div>
</nav>
