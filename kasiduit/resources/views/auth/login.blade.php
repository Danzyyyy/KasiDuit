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

            <div class="mt-6 text-center text-sm text-gray-400">
                Belum punya akun? <a href="{{ route('register') }}" class="text-red-400 hover:underline">Daftar sekarang</a>
            </div>
        </div>
    </div>
</x-layouts.guest>