<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Dosen MBKM')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased">
    <div class="flex h-screen bg-slate-50">
        {{-- Sidebar --}}
        @include('components.sidebar.dosen-pembimbing-sidebar')

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- Navbar --}}
            @include('components.navbar.dosen-pembimbing-navbar')

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
<!-- hh -->