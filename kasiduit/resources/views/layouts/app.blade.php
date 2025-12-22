<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KasiDuit - Sedikit dari Kita, Besar untuk Mereka</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<<<<<<< HEAD
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
=======
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
>>>>>>> 3b05a1277d1ccccd91955fb64f6cd2a4a4015374
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
<<<<<<< HEAD
                        brand: { 
                            red: '#dc2626', 
                            dark: '#111827', 
                            light: '#f9fafb' 
                        }
=======
                        brand: { red: '#dc2626', dark: '#111827', light: '#f9fafb' }
>>>>>>> 3b05a1277d1ccccd91955fb64f6cd2a4a4015374
                    }
                }
            }
        }
    </script>
<<<<<<< HEAD
    <style> 
        body { font-family: 'Inter', sans-serif; }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
=======
    <style> body { font-family: 'Inter', sans-serif; } </style>
>>>>>>> 3b05a1277d1ccccd91955fb64f6cd2a4a4015374
    @livewireStyles
</head>
<body class="bg-brand-light text-gray-600 antialiased selection:bg-brand-red selection:text-white">

    <x-navbar />

    <main>
        {{ $slot }}
    </main>

    <x-footer />

    @livewireScripts
</body>
</html>