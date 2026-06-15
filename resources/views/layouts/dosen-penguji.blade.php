<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Dosen Penguji MBKM')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased">
    <div class="flex h-screen bg-slate-50">
        {{-- Sidebar --}}
        @include('components.sidebar.dosen-penguji-sidebar')

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- Navbar --}}
            @include('components.navbar.dosen-penguji-navbar')

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto">
                <div class="px-8 py-8">
                    @yield('content')
                </div>

                {{-- Footer --}}
                @include('components.footer.footer')
            </main>
        </div>
    </div>
</body>
</html>
