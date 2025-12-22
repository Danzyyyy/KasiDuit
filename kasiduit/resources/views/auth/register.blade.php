<x-layouts.guest>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-900 text-white">
        <div class="w-full max-w-md p-8 bg-gray-800 rounded-lg shadow-lg border border-gray-700">
            
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-red-500">Daftar Akun</h2>
                <p class="text-gray-400 text-sm mt-2">Buat akun baru</p>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-300">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                    @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                    @error('email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                    @error('password') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300">Ulangi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>

                <button type="submit" 
                    class="w-full py-2 px-4 mt-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg">
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-400">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-red-400 hover:underline">Masuk di sini</a>
            </div>
        </div>
    </div>
</x-layouts.guest>