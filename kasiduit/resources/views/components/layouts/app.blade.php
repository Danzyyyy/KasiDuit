<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KasiDuit') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="android-chrome-icon" sizes="192x192" href="{{ asset('img/android-chrome-192x192.png') }}">
    <link rel="android-chrome-icon2" sizes="512x512" href="{{ asset('img/android-chrome-512x512.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/site.webmanifest') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>