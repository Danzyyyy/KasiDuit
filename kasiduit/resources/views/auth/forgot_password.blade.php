<div class="flex flex-col items-center justify-center min-h-screen bg-gray-900 text-white p-5">
    <div class="w-full max-w-md p-8 bg-gray-800 rounded-lg shadow-lg border border-gray-700">
        
        <h2 class="text-2xl font-bold text-red-500 mb-2 text-center">Reset Password</h2>
        
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-600 text-white rounded-lg text-sm text-center shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- STEP 1: Form Email --}}
        @if ($step == 1)
            <p class="text-gray-400 text-sm mb-6 text-center">
                Masukkan alamat email yang terdaftar untuk menerima kode OTP.
            </p>
            
            <form wire:submit.prevent="sendOtp">
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                    <input type="email" wire:model="email" required autofocus
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-red-500 focus:outline-none transition-all"
                        placeholder="nama@email.com">
                    @error('email') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <button type="submit" wire:loading.attr="disabled"
                    class="w-full py-2 px-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition duration-200 flex justify-center items-center shadow-md">
                    <span wire:loading.remove>Kirim Kode OTP</span>
                    <span wire:loading>Mengirim...</span>
                </button>
            </form>
        @endif

        {{-- STEP 2: Form OTP & Password Baru --}}
        @if ($step == 2)
            <div class="text-center mb-6">
                <p class="text-gray-400 text-sm">Kode OTP telah dikirim ke:</p>
                <p class="text-white font-medium">{{ $email }}</p>
            </div>

            <form wire:submit.prevent="resetPassword">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Kode OTP</label>
                    <input type="text" wire:model="otp" required placeholder="123456" maxlength="6"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white text-center tracking-[0.5em] text-xl font-bold focus:ring-2 focus:ring-red-500 focus:outline-none">
                    @error('otp') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Password Baru</label>
                    <input type="password" wire:model="password" required
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                    @error('password') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Konfirmasi Password</label>
                    <input type="password" wire:model="password_confirmation" required
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>

                <button type="submit"
                    class="w-full py-2 px-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition duration-200 shadow-md">
                    Ubah Password
                </button>
                
                <button type="button" wire:click="$set('step', 1)" 
                    class="w-full mt-4 text-sm text-gray-500 hover:text-gray-300 transition-colors">
                    Salah email? Kirim ulang
                </button>
            </form>
        @endif

        <div class="mt-8 pt-6 border-t border-gray-700 text-center">
            <a href="{{ route('login') }}" class="text-gray-400 hover:text-white text-sm transition-colors flex items-center justify-center gap-2">
                Kembali ke Login
            </a>
        </div>
    </div>
</div>