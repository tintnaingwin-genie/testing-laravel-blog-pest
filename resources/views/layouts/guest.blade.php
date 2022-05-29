<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="preconnect" href="https://fonts.gstatic.com">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500&family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        @livewireStyles

        <x-feed-links />

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body class="font-sans text-ink bg-paper">

    @if (flash()->message)
        <div class="{{ flash()->class }} p-4 font-medium">
            {{ flash()->message }}
        </div>
    @endif

        {{ $slot }}

        @livewireScripts
    </body>
</html>
