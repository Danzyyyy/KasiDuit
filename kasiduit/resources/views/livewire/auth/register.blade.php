<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use function Livewire\Volt\{state, rules, layout};

// Menggunakan layout Guest yang benar
layout('components.layouts.guest');

state([
    'name' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'name' => 'required|string|max:255',
    'email' => 'required|string|email|max:255|unique:users',
    'password' => 'required|string|min:8|confirmed',
]);

$register = function () {
    $this->validate();

    // Simpan ke Database
    $user = User::create([
        'name' => $this->name,
        'email' => $this->email,
        'password' => Hash::make($this->password),
        'role' => 'user' // Default role user biasa
    ]);

    // Langsung login setelah daftar
    Auth::login($user);

    session()->regenerate();

    return redirect()->intended('/dashboard');
};

?>

<div class="flex flex-col items-center justify-center min-h-screen bg-gray-900 text-white">
    <div class="w-full max-w-md p-8 bg-gray-800 rounded-lg shadow-lg border border-gray-700">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-red-500">Buat Akun</h2>
            <p class="text-gray-400 text-sm mt-2">Daftar untuk mulai donasi</p>
        </div>

        <form wire:submit="register" class="space-y-4">
            
            <div>
                <label class="block text-sm font-medium text-gray-300">Nama Lengkap</label>
                <input wire:model="name" type="text" required autofocus
                    class="w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none text-white placeholder-gray-400"
                    placeholder="Nama Anda">
                @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300">Email Address</label>
                <input wire:model="email" type="email" required
                    class="w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none text-white placeholder-gray-400"
                    placeholder="nama@email.com">
                @error('email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300">Password</label>
                <input wire:model="password" type="password" required
                    class="w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none text-white placeholder-gray-400"
                    placeholder="Minimal 8 karakter">
                @error('password') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300">Ulangi Password</label>
                <input wire:model="password_confirmation" type="password" required
                    class="w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none text-white placeholder-gray-400"
                    placeholder="Ketik ulang password">
            </div>

            <button type="submit" 
                class="w-full py-2 px-4 mt-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition duration-200">
                <span wire:loading.remove>Daftar Sekarang</span>
                <span wire:loading>Memproses...</span>
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-400">
            Sudah punya akun? 
            <a href="/login" class="text-red-400 hover:underline">Masuk di sini</a>
        </div>
    </div>
</div>