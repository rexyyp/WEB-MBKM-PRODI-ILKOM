<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Kaprodi - MBKM System')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased">
    <div class="flex h-screen bg-slate-50 overflow-hidden">
        {{-- Sidebar --}}
        @include('components.sidebar.kaprodi-sidebar')

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- Navbar --}}
            @include('components.navbar.kaprodi-navbar')

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto">
                <div class="p-6 lg:p-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
