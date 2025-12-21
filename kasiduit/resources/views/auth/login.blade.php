<x-layouts.guest>
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-red-500">Kasiduit</h2>
        <p class="text-gray-400 text-sm mt-2">Masuk dengan Nama & Email</p>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-600 text-white rounded-lg shadow-md text-sm text-center">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('login') }}" method="POST" class="space-y-6">
    
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-900 text-white">
        <div class="w-full max-w-md p-8 bg-gray-800 rounded-lg shadow-lg border border-gray-700">
            
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-red-500">Kasiduit</h2>
                <p class="text-gray-400 text-sm mt-2">Masuk dengan Nama & Email</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf <div>
                    <label for="name" class="block text-sm font-medium text-gray-300">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-red-500 focus:outline-none">
                    @error('name') <span class="text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-red-500 focus:outline-none">
                    @error('email') <span class="text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-red-500 focus:outline-none">
                    @error('password') <span class="text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <button type="submit" 
                    class="w-full py-2 px-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition duration-200">
                    Masuk
                </button>
            </form>

            <div class="mt-4">
                <a href="{{ route('google.login') }}" 
                class="flex items-center justify-center w-full px-4 py-2 text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200">
                    
                    <svg class="w-5 h-5 mr-2 bg-white rounded-full p-0.5" viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    
                    Masuk dengan Google
                </a>
            </div>

            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-600"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-gray-800 text-gray-400">Atau</span>
                </div>
            </div>

            <div class="mt-6 text-center text-sm text-gray-400">
                Belum punya akun? <a href="{{ route('register') }}" class="text-red-400 hover:underline">Daftar sekarang</a>
            </div>
        </div>
    </div>
</x-layouts.guest>