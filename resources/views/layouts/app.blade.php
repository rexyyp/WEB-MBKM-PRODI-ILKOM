<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MBKM System')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden bg-slate-50">

        {{-- Mobile Sidebar Overlay --}}
        <div x-show="sidebarOpen" 
             class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false" style="display: none;"></div>

        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
               class="fixed inset-y-0 left-0 z-50 w-[280px] lg:w-72 bg-white border-r border-slate-200 flex flex-col transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto">
            
            {{-- Sidebar Header --}}
            <div class="h-[76px] flex items-center px-8 border-b border-slate-200 shrink-0">
                <div>
                    <h1 class="font-bold text-xl text-blue-700 tracking-tight">MBKM Portal</h1>
                    <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400">@yield('role_name', 'Sistem Informasi')</p>
                </div>
            </div>

            {{-- Sidebar Menu --}}
            <div class="px-6 py-6 flex-1 overflow-y-auto">
                <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400 mb-4 px-2">Menu Utama</p>
                <nav class="space-y-1.5">
                    @yield('sidebar_menu')
                </nav>
            </div>

            {{-- Sidebar Footer --}}
            <div class="p-6 border-t border-slate-200 shrink-0">
                <a href="{{ route('auth.logout') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-red-50 hover:text-red-600 font-bold transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar
                </a>
            </div>
        </aside>

        {{-- Main Content Wrapper --}}
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
            {{-- Topbar --}}
            <header class="h-[76px] bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-6 lg:px-8 shrink-0">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    {{-- Judul atau Breadcrumb opsional dapat diletakkan di sini, tetapi saya biarkan kosong seperti aslinya --}}
                </div>
                
                <div class="flex items-center gap-5">
                    <button class="relative p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-xl transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>

                    <div class="flex items-center gap-3 sm:gap-4 pl-4 sm:pl-6 border-l border-slate-200">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-slate-800 leading-none mb-1">{{ Auth::user() ? Auth::user()->name : 'User' }}</p>
                            <p class="text-xs font-bold text-slate-500 leading-none">@yield('role_name', 'Pengguna')</p>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-base border border-blue-100 shadow-sm">
                            {{ substr(Auth::user() ? Auth::user()->name : 'U', 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            {{-- Main Content Area --}}
            <main class="flex-1 overflow-y-auto">
                <div class="p-4 sm:p-6 lg:p-8 w-full max-w-[1400px] mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
