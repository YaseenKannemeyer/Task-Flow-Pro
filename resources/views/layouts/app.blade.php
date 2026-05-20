<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TaskFlow Pro') }} — @yield('title', 'Dashboard')</title>
    {{-- Vite-compiled CSS/JS (no inline styles) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans antialiased">

    {{-- ----------------------- Navbar ----------------------- --}}
    <x-navbar />

    <div class="flex">
        {{-- ----------------------- Sidebar ----------------------- --}}
        <x-sidebar />

        {{-- ----------------------- Main Content ----------------------- --}}
        <main class="flex-1 p-6">

            {{-- Breadcrumb --}}
            @hasSection('breadcrumb')
                <x-breadcrumb>
                    @yield('breadcrumb')
                </x-breadcrumb>
            @endif

            {{-- Flash Messages --}}
            @if (session('success'))
                <x-alert type="success" :message="session('success')" />
            @endif
            @if (session('error'))
                <x-alert type="error" :message="session('error')" />
            @endif
            @if ($errors->any())
                <x-alert type="error">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </x-alert>
            @endif

            {{-- Page content --}}
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>