<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Livewire\Home;
use App\Models\Category;
use App\Livewire\Auth\ForgotPassword;

Route::get('/', Home::class);

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

// Route lupa password
Route::get('/forgot-password', ForgotPassword::class)->name('password.request');

// Route reset password
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// -----------------------------

Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/home', function () {
    // Ini akan memanggil file di resources/views/livewire/home.blade.php
    return view('livewire.home'); });
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {$categories = Category::latest()->get();
    return view('dashboard', compact('categories'));
    })->name('dashboard');

    Route::resource('categories', \App\Http\Controllers\CategoryController::class)->except(['index', 'show', 'create', 'edit']);
});
