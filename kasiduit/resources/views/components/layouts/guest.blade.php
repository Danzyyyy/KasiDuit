<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kasiduit - Masuk</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        @livewireStyles
        
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-900">
        
        <main>
            {{ $slot }}
        </main>

    </body>
</html>