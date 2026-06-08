<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MBKM System')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-900">
    <div class="min-h-screen flex flex-col">
        {{-- Navbar --}}
        @yield('navbar')

        <div class="flex flex-1">
            {{-- Sidebar --}}
            @yield('sidebar')

            {{-- Main Content --}}
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>

        {{-- Footer --}}
        @yield('footer')
    </div>

    @stack('scripts')
</body>
</html>
