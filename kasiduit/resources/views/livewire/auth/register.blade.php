<div class="min-h-screen flex flex-col md:flex-row font-sans">
    
    {{-- BAGIAN KIRI (FORM) --}}
    <div class="w-full md:w-1/2 bg-white flex flex-col justify-center items-center p-8 md:p-12 order-2 md:order-1">
        <div class="w-full max-w-md">
            
            <div class="mb-8 text-center md:text-left">
                <a href="/" class="inline-flex items-center gap-2 mb-6 group">
                     <svg class="w-8 h-8 text-red-600 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    <span class="text-2xl font-bold text-gray-800 tracking-tight">KasiDuit</span>
                </a>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Buat Akun Baru</h1>
                <p class="text-gray-500">Mulai langkah kebaikanmu hari ini</p>
            </div>

            <form wire:submit="register" class="space-y-5">
                
                {{-- NAMA --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" wire:model.live="name" 
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 focus:ring-opacity-50 transition duration-200 placeholder-gray-400"
                        placeholder="Nama lengkap Anda sesuai KTP">
                    @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" wire:model.live="email" 
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 focus:ring-opacity-50 transition duration-200 placeholder-gray-400"
                        placeholder="nama@email.com">
                    @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- PASSWORD UTAMA --}}
                <div x-data="{ show: false }">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" wire:model.live="password"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 focus:ring-opacity-50 transition duration-200 placeholder-gray-400 pr-12"
                            placeholder="Minimal 8 karakter">
                        
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            
                            {{-- Icon Lucide: Eye Off (Password Sembunyi) --}}
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-off w-5 h-5">
                                <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                                <line x1="2" x2="22" y1="2" y2="22"/>
                            </svg>

                            {{-- Icon Lucide: Eye (Password Terlihat) --}}
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye w-5 h-5" style="display:none;">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            
                        </button>
                    </div>
                    @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- KONFIRMASI PASSWORD --}}
                <div x-data="{ show: false }">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" wire:model.live="password_confirmation"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 focus:ring-opacity-50 transition duration-200 placeholder-gray-400 pr-12"
                            placeholder="Ulangi password">
                        
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            
                            {{-- Icon Lucide: Eye Off --}}
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-off w-5 h-5">
                                <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                                <line x1="2" x2="22" y1="2" y2="22"/>
                            </svg>

                            {{-- Icon Lucide: Eye --}}
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye w-5 h-5" style="display:none;">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            
                        </button>
                    </div>
                    @error('password_confirmation') 
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <button type="submit" 
                    class="w-full py-3.5 px-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-full shadow-lg shadow-red-200 transform hover:-translate-y-0.5 transition duration-200 flex justify-center items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="register">Daftar Sekarang</span>
                    <span wire:loading wire:target="register">Memproses...</span>
                </button>
            </form>

            <p class="mt-8 text-center text-gray-600">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-bold text-red-600 hover:text-red-700 hover:underline">Masuk Disini</a>
            </p>
        </div>
    </div>

    {{-- BAGIAN KANAN (GAMBAR/ILUSTRASI) --}}
    <div class="hidden md:flex w-full md:w-1/2 bg-red-50 justify-center items-center p-8 relative overflow-hidden order-1 md:order-2">
        <div class="absolute top-1/4 left-1/4 w-40 h-40 bg-red-100 rounded-full mix-blend-multiply filter blur-2xl opacity-60 animate-blob"></div>
        <div class="absolute bottom-1/4 right-1/4 w-40 h-40 bg-orange-100 rounded-full mix-blend-multiply filter blur-2xl opacity-60 animate-blob animation-delay-2000"></div>

        <div class="text-center relative z-10 max-w-md">
            <img src="https://i.ibb.co.com/fGChKx9f/bccc34bb-e216-4b0d-a0b8-e1976c45c5ad.png" alt="Ilustrasi Donasi" class="w-full h-auto mb-8 drop-shadow-xl mx-auto object-contain max-h-[400px]">
            
            <h2 class="text-2xl font-bold text-red-900 mb-3">Satu Koin Sejuta Kebaikan</h2>
            <p class="text-red-800/70 leading-relaxed">Kontribusi kecil Anda adalah awal dari perubahan besar bagi mereka yang membutuhkan.</p>
        </div>
    </div>
</div>