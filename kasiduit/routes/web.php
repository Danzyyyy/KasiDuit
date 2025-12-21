<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Category;

Route::get('/', function () {
    return view('welcome');
});

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

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {$categories = Category::latest()->get();
    return view('dashboard', compact('categories'));
    })->name('dashboard');

    Route::resource('categories', \App\Http\Controllers\CategoryController::class)->except(['index', 'show', 'create', 'edit']);
});