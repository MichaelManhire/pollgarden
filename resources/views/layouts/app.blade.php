<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Poll Garden' }}</title>
        <meta name="description" content="{{ $description ?? '' }}">
        <meta name="robots" content="{{ $robots ?? 'index,follow' }}">

        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#3f9142">
        <meta name="theme-color" content="#ffffff">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>
    </head>
    <body class="font-sans antialiased text-gray-800">
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-dropdown')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <footer class="text-sm bg-gray-700 text-white">
            <div class="container flex justify-center sm:justify-end py-2.5">
                <a class="hover:underline" href="{{ url('terms') }}">{{ __('Terms of Use') }}</a>
                <p class="ml-6">{{ __('Copyright') }} &copy; {{ now()->year }} Poll Garden</p>
            </div>
        </footer>

        @stack('modals')

        @livewireScripts
    </body>
</html>
