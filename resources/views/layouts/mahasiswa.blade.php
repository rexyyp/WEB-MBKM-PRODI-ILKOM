<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @vite('resources/css/app.css')
    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50">

    <div class="flex h-screen bg-slate-50 overflow-hidden">

        {{-- Sidebar --}}
        @include('components.sidebar.mahasiswa-sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- Navbar --}}
            @include('components.navbar.mahasiswa-navbar')

            {{-- Content --}}
            <main class="flex-1 overflow-y-auto flex flex-col">
                <div class="flex-1 p-6 lg:p-8 max-w-7xl mx-auto w-full">
                    @yield('content')
                </div>

                {{-- Footer --}}
                @include('components.footer.footer')
            </main>

        </div>
    </div>

</body>
</html>