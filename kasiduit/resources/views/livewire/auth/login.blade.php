<div class="min-h-screen flex flex-col md:flex-row font-sans">
    
    {{-- BAGIAN KIRI: FORM LOGIN --}}
    <div class="w-full md:w-1/2 bg-white flex flex-col justify-center items-center p-8 md:p-12 order-2 md:order-1">
        <div class="w-full max-w-md">
            
            <div class="mb-10 text-center md:text-left">
                <a href="/" class="inline-flex items-center gap-3 mb-6 group">
                    {{-- GANTI ICONS SVG DENGAN GAMBAR --}}
                    <div class="relative w-10 h-10 overflow-hidden rounded-full shadow-sm border border-red-50 group-hover:scale-110 transition-transform duration-300">
                        <img src="https://i.ibb.co.com/VpL5Nk6j/Desain-tanpa-judul-20.png" 
                             onerror="this.src='https://ui-avatars.com/api/?name=KD&background=dc2626&color=fff'"
                             alt="KasiDuit Logo" 
                             class="w-full h-full object-cover">
                    </div>
                    <span class="text-2xl font-bold text-gray-800 tracking-tight group-hover:text-red-600 transition-colors">KasiDuit</span>
                </a>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Masuk Akun</h1>
                <p class="text-gray-500">Selamat datang kembali di KasiDuit</p>
            </div>

            {{-- PESAN SUKSES --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r shadow-sm animate-fade-in-down">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- PESAN ERROR --}}
            @if (session()->has('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{-- FORM LOGIN --}}
            <form wire:submit="login" class="space-y-6">
                
                {{-- EMAIL INPUT --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" wire:model="email" 
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 focus:ring-opacity-50 transition duration-200 placeholder-gray-400"
                        placeholder="Contoh: nama@email.com">
                    @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- PASSWORD INPUT --}}
                <div x-data="{ show: false }">
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <a href="{{ route('password.request') }}" class="text-sm text-red-600 hover:text-red-700 font-medium hover:underline">
                            Lupa Password?
                        </a>
                    </div>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" id="password" wire:model="password"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 focus:ring-opacity-50 transition duration-200 placeholder-gray-400 pr-12"
                            placeholder="Masukkan password Anda">
                        
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.574-2.59M5.22 5.22a3 3 0 014.24 0M9.88 9.88a3 3 0 014.24 0M12 12.75l-4-4m0 0l4 4m-4-4l4 4" />
                            </svg>
                        </button>
                    </div>
                    @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- REMEMBER ME CHEKBOX --}}
                <div class="flex items-center">
                    <input id="remember" wire:model="remember" type="checkbox" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-600">
                        Ingat saya di perangkat ini
                    </label>
                </div>

                {{-- TOMBOL LOGIN --}}
                <button type="submit" 
                    class="w-full py-3.5 px-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-full shadow-lg shadow-red-200 transform hover:-translate-y-0.5 transition duration-200 flex justify-center items-center gap-2">
                    <span wire:loading.remove wire:target="login">Masuk Akun</span>
                    <span wire:loading wire:target="login">Memproses...</span>
                </button>
            </form>

            {{-- PEMBATAS ATAU --}}
            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500">Atau masuk dengan</span>
                </div>
            </div>

            {{-- TOMBOL GOOGLE --}}
            <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-3 px-4 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-200 transform hover:-translate-y-0.5">
                <svg class="h-5 w-5" viewBox="0 0 24 24">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Google
            </a>

            {{-- LINK DAFTAR --}}
            <p class="mt-8 text-center text-gray-600">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-bold text-red-600 hover:text-red-700 hover:underline">Daftar Sekarang</a>
            </p>
        </div>
    </div>

    {{-- BAGIAN KANAN: ILUSTRASI --}}
    <div class="hidden md:flex w-full md:w-1/2 bg-red-50 justify-center items-center p-8 relative overflow-hidden order-1 md:order-2">
        <div class="absolute top-10 right-10 w-32 h-32 bg-red-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        <div class="absolute bottom-10 left-10 w-32 h-32 bg-pink-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        
        <div class="text-center relative z-10 max-w-md">
            <img src="https://cdni.iconscout.com/illustration/premium/thumb/growing-business-4268339-3561001.png" alt="Ilustrasi Tumbuh" class="w-full h-auto mb-8 drop-shadow-xl mx-auto object-contain max-h-[400px]">
            
            <h2 class="text-2xl font-bold text-red-900 mb-3">Harapan yang Tumbuh</h2>
            <p class="text-red-800/70 leading-relaxed">Bergabunglah kembali untuk menyiram benih kebaikan dan melihatnya tumbuh menjadi harapan nyata.</p>
        </div>
    </div>
</div>