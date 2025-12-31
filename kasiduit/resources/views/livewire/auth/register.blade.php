<div class="min-h-screen flex flex-col md:flex-row font-sans">
    
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
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" wire:model.live="name" 
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 focus:ring-opacity-50 transition duration-200 placeholder-gray-400"
                        placeholder="Nama lengkap Anda sesuai KTP">
                    @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" wire:model.live="email" 
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 focus:ring-opacity-50 transition duration-200 placeholder-gray-400"
                        placeholder="nama@email.com">
                    @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div x-data="{ show: false }">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" wire:model.live="password"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 focus:ring-opacity-50 transition duration-200 placeholder-gray-400 pr-12"
                            placeholder="Minimal 8 karakter">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display:none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.574-2.59M5.22 5.22a3 3 0 014.24 0M9.88 9.88a3 3 0 014.24 0M12 12.75l-4-4m0 0l4 4m-4-4l4 4" /></svg>
                        </button>
                    </div>
                    @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div x-data="{ show: false }">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" wire:model.live="password_confirmation"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 focus:ring-opacity-50 transition duration-200 placeholder-gray-400 pr-12"
                            placeholder="Ulangi password">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                             <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                             <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display:none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.574-2.59M5.22 5.22a3 3 0 014.24 0M9.88 9.88a3 3 0 014.24 0M12 12.75l-4-4m0 0l4 4m-4-4l4 4" /></svg>
                        </button>
                    </div>
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

    <div class="hidden md:flex w-full md:w-1/2 bg-red-50 justify-center items-center p-8 relative overflow-hidden order-1 md:order-2">
        <div class="absolute top-1/4 left-1/4 w-40 h-40 bg-red-100 rounded-full mix-blend-multiply filter blur-2xl opacity-60 animate-blob"></div>
        <div class="absolute bottom-1/4 right-1/4 w-40 h-40 bg-orange-100 rounded-full mix-blend-multiply filter blur-2xl opacity-60 animate-blob animation-delay-2000"></div>

        <div class="text-center relative z-10 max-w-md">
            <img src="https://cdni.iconscout.com/illustration/premium/thumb/donation-3486121-2914619.png" alt="Ilustrasi Donasi" class="w-full h-auto mb-8 drop-shadow-xl mx-auto object-contain max-h-[400px]">
            
            <h2 class="text-2xl font-bold text-red-900 mb-3">Satu Koin Sejuta Kebaikan</h2>
            <p class="text-red-800/70 leading-relaxed">Kontribusi kecil Anda adalah awal dari perubahan besar bagi mereka yang membutuhkan.</p>
        </div>
    </div>
</div>