<div x-data="{ mobileMenuOpen: false, searchOpen: false }">
    
    {{-- ============================================================== --}}
    {{--                        TAMPILAN DESKTOP                        --}}
    {{-- ============================================================== --}}
    <nav class="hidden md:block bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                
                {{-- LOGO & MENU KIRI --}}
                <div class="flex items-center gap-4">
                    
                    {{-- Logo --}}
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group mr-2">
                        <div class="relative w-10 h-10 overflow-hidden rounded-full shadow-sm border border-red-50 group-hover:scale-110 transition-transform duration-300">
                            <img src="https://i.ibb.co.com/VpL5Nk6j/Desain-tanpa-judul-20.png" 
                                 onerror="this.src='https://ui-avatars.com/api/?name=KD&background=dc2626&color=fff'"
                                 alt="KasiDuit" class="w-full h-full object-cover">
                        </div>
                        <span class="text-xl font-bold text-gray-800 tracking-tight group-hover:text-red-600 transition-colors">KasiDuit</span>
                    </a>

                    {{-- Menu Navigasi --}}
                    <div class="flex space-x-4 items-center h-20">
                        {{-- Menu Beranda --}}
                        <a href="{{ route('home') }}" 
                           class="relative h-full flex items-center px-2 text-sm font-bold transition duration-200
                           {{ request()->routeIs('home') ? 'text-red-600' : 'text-gray-600 hover:text-red-600' }}">
                            Beranda
                            @if(request()->routeIs('home'))
                                <span class="absolute bottom-6 left-0 w-full h-[3px] bg-red-600 rounded-full"></span>
                            @endif
                        </a>

                        {{-- Menu Donasi --}}
                        <a href="{{ route('campaigns.index') }}" 
                           class="relative h-full flex items-center px-2 text-sm font-bold transition duration-200
                           {{ request()->routeIs('campaigns.*') ? 'text-red-600' : 'text-gray-600 hover:text-red-600' }}">
                            Donasi
                            @if(request()->routeIs('campaigns.*'))
                                <span class="absolute bottom-6 left-0 w-full h-[3px] bg-red-600 rounded-full"></span>
                            @endif
                        </a>
                        
                        {{-- Dropdown Tentang Kami --}}
                        <div class="relative h-full flex items-center px-2 group cursor-pointer" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="text-sm font-bold flex items-center gap-1 transition focus:outline-none 
                                {{ request()->routeIs('about') || request()->routeIs('faq') || request()->routeIs('contact') ? 'text-red-600' : 'text-gray-600 hover:text-red-600' }}">
                                Tentang Kami <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            
                            @if(request()->routeIs('about') || request()->routeIs('faq') || request()->routeIs('contact'))
                                <span class="absolute bottom-6 left-0 w-full h-[3px] bg-red-600 rounded-full"></span>
                            @endif

                            <div x-show="open" x-transition class="absolute top-full left-0 w-48 bg-white rounded-b-xl shadow-xl border-t-2 border-red-600 py-2 z-50" style="display: none;">
                                <a href="{{ route('about') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 font-medium">Tentang Kami</a>
                                <a href="{{ route('faq') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 font-medium">FAQ</a>
                                <a href="{{ route('contact') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 font-medium">Kontak</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SEARCH BAR DESKTOP --}}
                <div class="flex-1 max-w-lg mx-6 relative">
                    <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input wire:model.live.debounce.300ms="search" type="text" class="block w-full pl-11 pr-4 py-2.5 border border-gray-200 rounded-full bg-gray-50 focus:bg-white focus:ring-1 focus:ring-red-500 focus:border-red-500 text-sm transition placeholder-gray-400" placeholder="Cari campaign..." autocomplete="off">
                    </div>
                    
                    {{-- Hasil Pencarian Desktop --}}
                    @if(strlen($search) > 0)
                        <div class="absolute top-full left-0 w-full mt-2 bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden z-50 py-2">
                            @if(count($results) > 0)
                                @foreach($results as $result)
                                    <a href="{{ route('campaign.detail', $result['id']) }}" class="flex items-center gap-4 px-4 py-3 hover:bg-red-50 transition border-b border-gray-50 last:border-0 group">
                                        <img src="{{ $result['image'] }}" class="w-10 h-10 rounded object-cover group-hover:scale-105 transition-transform">
                                        <div class="flex-1 min-w-0"><h4 class="text-sm font-bold text-gray-800 truncate group-hover:text-red-600">{{ $result['title'] }}</h4></div>
                                    </a>
                                @endforeach
                            @else
                                <div class="p-4 text-center text-sm text-gray-500">Tidak ada hasil.</div>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- TOMBOL AUTH DESKTOP --}}
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('campaigns.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-red-50 text-red-600 rounded-full hover:bg-red-100 transition font-bold text-sm">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            Buat Campaign
                        </a>
                        
                        {{-- User Profile Dropdown --}}
                        <div class="relative ml-2" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" class="flex items-center gap-3 focus:outline-none p-1 rounded-full hover:bg-gray-50 transition border border-transparent hover:border-gray-200">
                                <div class="text-right hidden xl:block">
                                    <p class="text-sm font-bold text-gray-800 leading-tight">{{ Auth::user()->name }}</p>
                                    <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'User' }}</p>
                                </div>
                                <img class="h-9 w-9 rounded-full border border-gray-200 object-cover" 
                                     src="{{ Auth::user()->avatar ? (Str::startsWith(Auth::user()->avatar, 'http') ? Auth::user()->avatar : asset('storage/' . Auth::user()->avatar)) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=fee2e2&color=dc2626' }}">
                            </button>
                            <div x-show="open" x-transition class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl py-2 border border-gray-100 z-50" style="display: none;">
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 text-sm font-bold text-red-600 hover:bg-red-50">Dashboard Admin</a>
                                    <div class="border-t border-gray-100 my-1"></div>
                                @endif
                                <a href="{{ route('profile') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-red-600 font-medium">Profil Saya</a>
                                
                                <div class="border-t border-gray-100 my-1"></div>
                                
                                {{-- FORM LOGOUT YANG BENAR (POST METHOD) --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-red-600 font-medium">Keluar</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-red-600 font-bold text-sm transition px-3">Masuk</a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-red-600 text-white font-bold text-sm rounded-full hover:bg-red-700 transition shadow-lg shadow-red-100">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- ============================================================== --}}
    {{--                         TAMPILAN MOBILE                        --}}
    {{-- ============================================================== --}}
    
    {{-- 1. TOP HEADER MOBILE (Logo + Search + Menu Hamburger) --}}
    <nav class="md:hidden bg-white border-b border-gray-200 sticky top-0 z-40 h-16 flex items-center px-4 justify-between shadow-sm">
        {{-- LOGO DAN TEKS --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="https://i.ibb.co.com/VpL5Nk6j/Desain-tanpa-judul-20.png" alt="Logo" class="h-10 w-10 object-cover rounded-full shadow-sm border border-red-50">
            <span class="text-xl font-bold text-gray-900 tracking-tight">KasiDuit</span>
        </a>
        
        <div class="flex items-center gap-1">
            {{-- Tombol Search --}}
            <button @click="searchOpen = !searchOpen" class="p-2 text-gray-500 hover:text-red-600">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </button>
            {{-- Tombol Menu Samping --}}
            <button @click="mobileMenuOpen = true" class="p-2 text-gray-500 hover:text-red-600">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </nav>

    {{-- 2. BOTTOM NAVIGATION BAR (Sticky di Bawah) --}}
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50 flex justify-around items-center h-16 pb-safe safe-area-inset-bottom shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
        
        {{-- Home --}}
        <a href="{{ route('home') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('home') ? 'text-red-600' : 'text-gray-400 hover:text-gray-600' }}">
            <svg class="h-6 w-6 mb-0.5" fill="{{ request()->routeIs('home') ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span class="text-[10px] font-medium">Beranda</span>
        </a>

        {{-- Program --}}
        <a href="{{ route('campaigns.index') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('campaigns.index') || request()->routeIs('campaign.detail') ? 'text-red-600' : 'text-gray-400 hover:text-gray-600' }}">
            <svg class="h-6 w-6 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <span class="text-[10px] font-medium">Donasi</span>
        </a>

        {{-- FLOATING BUTTON (Buat Aksi) --}}
        <div class="relative -top-6">
            <a href="{{ route('campaigns.create') }}" class="flex items-center justify-center w-14 h-14 bg-red-600 rounded-full shadow-lg text-white border-4 border-gray-100 hover:bg-red-700 transition active:scale-90">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </a>
            <span class="absolute -bottom-5 left-1/2 transform -translate-x-1/2 text-[10px] font-medium text-gray-500 whitespace-nowrap">Buat Aksi</span>
        </div>

        {{-- Riwayat --}}
        {{-- Route Riwayat Donasi yang benar --}}
        <a href="{{ route('my-donations') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('my-donations') ? 'text-red-600' : 'text-gray-400 hover:text-gray-600' }}">
            <svg class="h-6 w-6 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
            </svg>
            <span class="text-[10px] font-medium">Riwayat</span>
        </a>

        {{-- Akun --}}
        <a href="{{ route('profile') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('profile') ? 'text-red-600' : 'text-gray-400 hover:text-gray-600' }}">
            @auth
                @if(Auth::user()->avatar)
                    <img src="{{ Str::startsWith(Auth::user()->avatar, 'http') ? Auth::user()->avatar : asset('storage/' . Auth::user()->avatar) }}" class="h-6 w-6 rounded-full object-cover mb-0.5 border border-gray-200">
                @else
                    <svg class="h-6 w-6 mb-0.5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                @endif
            @else
                <svg class="h-6 w-6 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            @endauth
            <span class="text-[10px] font-medium">Akun</span>
        </a>
    </div>

    {{-- 3. SEARCH OVERLAY MOBILE --}}
    <div x-show="searchOpen" x-transition class="md:hidden fixed top-16 left-0 w-full bg-white z-40 border-b border-gray-200 p-4 shadow-lg" style="display: none;">
        <input wire:model.live.debounce.300ms="search" type="text" class="w-full pl-4 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Cari program donasi..." autofocus>
        
        @if(strlen($search) > 0)
            <div class="mt-2 max-h-60 overflow-y-auto border-t border-gray-100">
                @if(count($results) > 0)
                    @foreach($results as $result)
                        <a href="{{ route('campaign.detail', $result['id']) }}" class="flex items-center gap-3 px-2 py-3 hover:bg-gray-50 border-b border-gray-50">
                            <img src="{{ $result['image'] }}" class="w-10 h-10 rounded object-cover">
                            <div class="flex-1 min-w-0"><h4 class="text-xs font-bold text-gray-800 truncate">{{ $result['title'] }}</h4></div>
                        </a>
                    @endforeach
                @else
                    <div class="p-3 text-center text-xs text-gray-500">Tidak ditemukan.</div>
                @endif
            </div>
        @endif
    </div>

    {{-- 4. SIDEBAR MENU KANAN (MOBILE) --}}
    <div x-show="mobileMenuOpen" class="md:hidden fixed inset-0 z-[60]" style="display: none;">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="mobileMenuOpen = false"></div>
        <div class="fixed inset-y-0 right-0 w-64 bg-white shadow-xl transform transition-transform duration-300 flex flex-col"
             x-transition:enter="translate-x-full" x-transition:enter-end="translate-x-0"
             x-transition:leave="translate-x-0" x-transition:leave-end="translate-x-full">
            
            <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-red-600 text-white">
                <span class="font-bold text-lg">Menu Lainnya</span>
                <button @click="mobileMenuOpen = false" class="focus:outline-none"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
            </div>

            <div class="p-4 space-y-1 overflow-y-auto flex-1">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-red-600 font-bold bg-red-50 hover:bg-red-100 rounded-lg mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2z"/></svg> 
                            Dashboard Admin
                        </a>
                    @endif

                    {{-- LINK RIWAYAT DONASI (MOBILE SIDEBAR) --}}
                    <a href="{{ route('my-donations') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg transition">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg> 
                        Riwayat Donasi
                    </a>

                    <div class="border-t border-gray-100 my-2"></div>
                @endauth

                <a href="{{ route('about') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg transition">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Tentang Kami
                </a>
                <a href="{{ route('faq') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg transition">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> FAQ
                </a>
                <a href="{{ route('contact') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg transition">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 00-2-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg> Hubungi Kami
                </a>
                
                @auth
                    <div class="border-t border-gray-100 my-2 pt-2">
                        {{-- LOGOUT FORM (MOBILE SIDEBAR) --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg font-bold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg> Keluar
                            </button>
                        </form>
                    </div>
                @else
                    <div class="border-t border-gray-100 my-2 pt-4">
                        <a href="{{ route('login') }}" class="block w-full py-2.5 text-center border border-gray-300 rounded-lg font-bold text-gray-700 mb-2">Masuk</a>
                        <a href="{{ route('register') }}" class="block w-full py-2.5 text-center bg-red-600 text-white rounded-lg font-bold">Daftar</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>