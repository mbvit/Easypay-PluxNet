<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])


         <!-- Scripts -->
        <script>
            function copyToClipboard(name, text) {
                navigator.clipboard.writeText(text).then(() => {
                    alert(`${name} coppied to clipboard`);
                }).catch(err => {
                    alert(`Failed to copy ${name}` + err);
                });
            }
        </script>
        
    </head>
<body class="bg-gradient-to-br from-pluxnet-navy to-pluxnet-pink min-h-screen  antialiased font-sans">
    <div class="min-h-screen">
        <livewire:layout.navigation />

        <!-- Page Heading -->
        <!-- @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif -->

        <!-- Page Content -->
        <main class="w-full flex justify-center items-center">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
