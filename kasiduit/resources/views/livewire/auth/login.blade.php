<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use function Livewire\Volt\{state, rules, layout};

layout('components.layouts.guest');

// 1. Tambahkan state 'name'
state([
    'name' => '', 
    'email' => '', 
    'password' => ''
]);

// 2. Tambahkan validasi untuk 'name'
rules([
    'name' => 'required|string',
    'email' => 'required|email',
    'password' => 'required'
]);

$login = function () {
    $this->validate();

    // 3. Modifikasi proses login
    // Kita kirimkan Name, Email, dan Password sekaligus.
    // Laravel akan mencari user yang Email-nya cocok, Password-nya cocok, DAN Namanya cocok.
    if (!Auth::attempt([
        'email' => $this->email, 
        'password' => $this->password, 
        'name' => $this->name // Tambahan pengecekan Nama
    ])) {
        throw ValidationException::withMessages([
            'email' => 'Data login (Nama, Email, atau Password) tidak sesuai.',
        ]);
    }

    session()->regenerate();

    return redirect()->intended('/dashboard');
};

?>

<div class="flex flex-col items-center justify-center min-h-screen bg-gray-900 text-white">
    <div class="w-full max-w-md p-8 bg-gray-800 rounded-lg shadow-lg border border-gray-700">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-red-500">Kasiduit</h2>
            <p class="text-gray-400 text-sm mt-2">Masuk dengan Nama & Email</p>
        </div>

        <form wire:submit="login" class="space-y-6">
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300">Nama Lengkap</label>
                <input wire:model="name" id="name" type="text" required autofocus
                    class="w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none text-white placeholder-gray-400"
                    placeholder="Nama sesuai saat daftar">
                @error('name') <span class="text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">Email Address</label>
                <input wire:model="email" id="email" type="email" required
                    class="w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none text-white placeholder-gray-400"
                    placeholder="nama@email.com">
                @error('email') <span class="text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <input wire:model="password" id="password" type="password" required
                    class="w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none text-white placeholder-gray-400">
                @error('password') <span class="text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" 
                class="w-full py-2 px-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition duration-200">
                <span wire:loading.remove>Masuk</span>
                <span wire:loading>Memproses...</span>
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-400">
            Belum punya akun? 
            <a href="/register" class="text-red-400 hover:underline">Daftar sekarang</a>
        </div>
    </div>
</div>