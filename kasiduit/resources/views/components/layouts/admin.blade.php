<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - KasiDuit</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="android-chrome-icon" sizes="192x192" href="{{ asset('img/android-chrome-192x192.png') }}">
    <link rel="android-chrome-icon2" sizes="512x512" href="{{ asset('img/android-chrome-512x512.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/site.webmanifest') }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style> 
        body { font-family: 'Inter', sans-serif; } 
        [x-cloak] { display: none !important; }
        /* Custom Scrollbar untuk Sidebar */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #e5e7eb; border-radius: 20px; }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-600 font-medium" x-data="{ sidebarOpen: false, sidebarCollapsed: false }">

    {{-- 1. OVERLAY MOBILE --}}
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-900/50 z-40 lg:hidden backdrop-blur-sm"
         x-cloak>
    </div>

    {{-- 2. SIDEBAR --}}
    <aside class="fixed inset-y-0 left-0 z-50 bg-white border-r border-gray-200 transition-all duration-300 transform flex flex-col"
           :class="{
               '-translate-x-full': !sidebarOpen, 
               'translate-x-0': sidebarOpen,
               'lg:translate-x-0': true,
               'w-64': !sidebarCollapsed,
               'w-20': sidebarCollapsed
           }">
        
        {{-- A. HEADER SIDEBAR --}}
        {{-- px-6 (24px) agar sejajar dengan ikon menu --}}
        <div class="h-16 flex items-center justify-between px-6 border-b border-gray-100 shrink-0">
            <a href="{{ route('home') }}" class="flex items-center gap-3 overflow-hidden whitespace-nowrap">
                {{-- Container Logo --}}
                <div class="w-8 h-8 flex items-center justify-center shrink-0">
                    <img src="https://i.ibb.co.com/VpL5Nk6j/Desain-tanpa-judul-20.png" alt="Logo" class="w-full h-full rounded-full object-cover">
                </div>
                {{-- Teks Logo --}}
                <span x-show="!sidebarCollapsed" 
                      class="text-lg font-bold text-gray-900 tracking-tight transition-opacity duration-300"
                      style="transition-delay: 100ms;">
                    KasiDuit
                </span>
            </a>
            
            {{-- Tombol Close Mobile --}}
            <button @click="sidebarOpen = false" class="lg:hidden -mr-2 p-2 text-gray-400 hover:text-red-600 rounded-lg hover:bg-gray-50 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- B. MENU NAVIGASI --}}
        {{-- Padding Container: px-3 --}}
        <div class="flex-1 overflow-y-auto px-3 py-4 space-y-1 overflow-x-hidden custom-scrollbar">
            
            {{-- Item Padding: px-3 --}}
            {{-- Total Padding Kiri: 12px (Container) + 12px (Item) = 24px (Sama dengan Header px-6) --}}

            {{-- 1. Dashboard --}}
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group relative
               {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-red-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                
                {{-- Ikon Wrapper --}}
                <div class="w-6 h-6 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                </div>
                
                <span x-show="!sidebarCollapsed" class="whitespace-nowrap font-medium text-sm transition-opacity duration-300">Dashboard</span>
                
                {{-- Tooltip Collapsed --}}
                <div x-show="sidebarCollapsed" class="hidden lg:block absolute left-14 ml-1 bg-gray-900 text-white text-xs px-2 py-1.5 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-50 pointer-events-none">Dashboard</div>
            </a>

            {{-- 2. Kelola Kategori --}}
            <a href="{{ route('admin.categories') }}" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group relative
               {{ request()->routeIs('admin.categories') ? 'bg-red-50 text-red-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <div class="w-6 h-6 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                </div>
                <span x-show="!sidebarCollapsed" class="whitespace-nowrap font-medium text-sm transition-opacity duration-300">Kelola Kategori</span>
                <div x-show="sidebarCollapsed" class="hidden lg:block absolute left-14 ml-1 bg-gray-900 text-white text-xs px-2 py-1.5 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-50 pointer-events-none">Kategori</div>
            </a>

            {{-- 3. Kelola Campaign --}}
            <a href="{{ route('admin.campaigns') }}" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group relative
               {{ request()->routeIs('admin.campaigns') ? 'bg-red-50 text-red-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <div class="w-6 h-6 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                </div>
                <span x-show="!sidebarCollapsed" class="whitespace-nowrap font-medium text-sm transition-opacity duration-300">Kelola Campaign</span>
                <div x-show="sidebarCollapsed" class="hidden lg:block absolute left-14 ml-1 bg-gray-900 text-white text-xs px-2 py-1.5 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-50 pointer-events-none">Campaign</div>
            </a>
        </div>

        {{-- C. FOOTER SIDEBAR --}}
        <div class="p-3 border-t border-gray-100 shrink-0 space-y-1">
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-xl transition group relative">
                <div class="w-6 h-6 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                </div>
                <span x-show="!sidebarCollapsed" class="whitespace-nowrap font-medium text-sm transition-opacity duration-300">Beranda</span>
                <div x-show="sidebarCollapsed" class="hidden lg:block absolute left-14 ml-1 bg-gray-900 text-white text-xs px-2 py-1.5 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-50 pointer-events-none">Beranda</div>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-red-600 hover:bg-red-50 rounded-xl transition font-bold group relative">
                    <div class="w-6 h-6 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    </div>
                    <span x-show="!sidebarCollapsed" class="whitespace-nowrap text-sm transition-opacity duration-300">Keluar</span>
                    <div x-show="sidebarCollapsed" class="hidden lg:block absolute left-14 ml-1 bg-gray-900 text-white text-xs px-2 py-1.5 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-50 pointer-events-none">Keluar</div>
                </button>
            </form>
        </div>
    </aside>

    {{-- 3. MAIN CONTENT WRAPPER --}}
    <div class="min-h-screen transition-all duration-300 bg-gray-50 flex flex-col"
         :class="{
             'lg:ml-64': !sidebarCollapsed,
             'lg:ml-20': sidebarCollapsed
         }">
        
        {{-- TOPBAR --}}
        <header class="sticky top-0 z-30 bg-white border-b border-gray-200 h-16 flex items-center justify-between px-4 lg:px-8 shadow-sm">
            <div class="flex items-center gap-4">
                {{-- Toggle Mobile --}}
                <button @click="sidebarOpen = true" class="lg:hidden text-gray-500 hover:text-gray-900 p-2 -ml-2 rounded-lg hover:bg-gray-100 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
                {{-- Toggle Desktop --}}
                <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden lg:block text-gray-400 hover:text-gray-900 p-2 rounded-lg hover:bg-gray-100 transition focus:outline-none">
                    <svg x-show="!sidebarCollapsed" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" /></svg>
                    <svg x-show="sidebarCollapsed" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" /></svg>
                </button>
            </div>

            {{-- User Profile --}}
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
                <img src="{{ Auth::user()->avatar ? (Str::startsWith(Auth::user()->avatar, 'http') ? Auth::user()->avatar : asset('storage/' . Auth::user()->avatar)) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=fee2e2&color=dc2626' }}" 
                     alt="Admin" class="w-9 h-9 rounded-full border border-gray-200 object-cover shadow-sm">
            </div>
        </header>

        {{-- CONTENT --}}
        <main class="flex-1 p-4 lg:p-8">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>