<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Livewire\Home; // Panggil Controller baru

Route::get('/', Home::class);

// --- GANTI VOLT DENGAN INI ---

// Route Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login google
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Route Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// -----------------------------

Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/home', function () {
    // Ini akan memanggil file di resources/views/livewire/home.blade.php
    return view('livewire.home'); });