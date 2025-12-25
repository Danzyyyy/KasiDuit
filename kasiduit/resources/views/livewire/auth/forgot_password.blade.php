<div class="min-h-screen flex items-center justify-center bg-gray-50 p-4 font-sans">
    
    <div class="w-full max-w-md bg-white p-8 md:p-10 rounded-2xl shadow-sm border border-gray-100 text-center">
        
        <div class="mb-8">
            <div class="flex justify-center items-center gap-2 mb-4 group">
                <svg class="w-8 h-8 text-red-600 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                <span class="text-2xl font-bold text-gray-800 tracking-tight">KasiDuit</span>
            </div>
            
            <h2 class="text-xl font-medium text-gray-800">Reset Password</h2>
            <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                @if($step == 1)
                    Masukkan email Anda untuk menerima link reset password
                @else
                    Masukkan kode OTP dan password baru Anda
                @endif
            </p>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 text-sm text-left rounded-r shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($step == 1)
            <form wire:submit.prevent="sendOtp" class="space-y-5">
                <div class="text-left">
                    <label class="block text-sm text-gray-600 mb-1.5 ml-1">Email</label>
                    <input type="email" wire:model="email" required autofocus
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 focus:ring-opacity-50 transition duration-200 placeholder-gray-400 text-gray-800"
                        placeholder="nama@email.com">
                    @error('email') <span class="text-red-500 text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                <button type="submit" wire:loading.attr="disabled"
                    class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl shadow-lg shadow-red-200 transform hover:-translate-y-0.5 transition duration-200 flex justify-center items-center">
                    <span wire:loading.remove>Kirim Link Reset</span>
                    <span wire:loading>Mengirim...</span>
                </button>
            </form>
        @endif

        @if ($step == 2)
            <form wire:submit.prevent="resetPassword" class="space-y-5">
                
                <div class="text-left">
                    <label class="block text-sm text-gray-600 mb-1.5 ml-1">Kode OTP</label>
                    <input type="text" wire:model="otp" required placeholder="123456" maxlength="6"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 focus:ring-opacity-50 transition duration-200 placeholder-gray-400 text-center tracking-widest text-lg font-semibold text-gray-800">
                    @error('otp') <span class="text-red-500 text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="text-left">
                    <label class="block text-sm text-gray-600 mb-1.5 ml-1">Password Baru</label>
                    <input type="password" wire:model="password" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 focus:ring-opacity-50 transition duration-200 placeholder-gray-400 text-gray-800"
                        placeholder="Minimal 8 karakter">
                    @error('password') <span class="text-red-500 text-xs mt-1 block ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="text-left">
                    <label class="block text-sm text-gray-600 mb-1.5 ml-1">Konfirmasi Password</label>
                    <input type="password" wire:model="password_confirmation" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 focus:ring-opacity-50 transition duration-200 placeholder-gray-400 text-gray-800"
                        placeholder="Ulangi password baru">
                </div>

                <button type="submit"
                    class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl shadow-lg shadow-red-200 transform hover:-translate-y-0.5 transition duration-200">
                    Ubah Password
                </button>

                <button type="button" wire:click="$set('step', 1)" 
                    class="w-full text-sm text-gray-500 hover:text-red-600 transition underline decoration-gray-300 hover:decoration-red-600">
                    Salah email? Kirim ulang kode
                </button>
            </form>
        @endif

        <div class="mt-6 pt-6">
            <a href="{{ route('login') }}" 
               class="block w-full py-3 border border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 hover:border-gray-300 transition duration-200">
                Kembali ke Login
            </a>
        </div>

    </div>
</div>