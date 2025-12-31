<?php

use App\Livewire\Donation\Donate;

// --- 1. Import Controllers ---
use App\Livewire\Pages\Faq;
use App\Livewire\Auth\Login;
use App\Livewire\Pages\Home;

// --- 2. Import Livewire Components (Publik) ---
use App\Livewire\Pages\About;
use App\Livewire\Auth\Register;
use App\Livewire\Pages\Contact;
use App\Livewire\User\MyDonations;
use App\Livewire\Admin\CategoryIndex;
use App\Livewire\Auth\ForgotPassword;

// --- 3. Import Livewire Components (Auth & User) ---
use App\Livewire\Pages\PrivacyPolicy;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\CampaignManager;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController; 

// --- 4. Import Livewire Components (Admin) ---
use App\Livewire\User\Profile as UserProfile;
use App\Livewire\Campaign\Index as CampaignList;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Campaign\Create as CreateCampaign;
use App\Livewire\Campaign\Detail as CampaignDetail;
use App\Livewire\Donation\CheckStatus; // <--- TAMBAHAN: Import komponen CheckStatus

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- HALAMAN PUBLIK (Bisa diakses siapa saja) ---
Route::get('/', Home::class)->name('home');
Route::get('/home', Home::class);
Route::get('/about', About::class)->name('about');
Route::get('/faq', Faq::class)->name('faq');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/privacy-policy', PrivacyPolicy::class)->name('privacy-policy'); 

// Campaign Routes
Route::get('/campaigns', CampaignList::class)->name('campaigns.index');
Route::get('/campaign/{id}', CampaignDetail::class)->name('campaign.detail');

// --- INTEGRASI PAYMENT (Midtrans Webhook) ---
// Note: Route ini harus di-exclude dari CSRF Protection di bootstrap/app.php
Route::post('/midtrans/callback', [PaymentController::class, 'callback'])->name('midtrans.callback');


// --- AREA TAMU (Hanya untuk yang BELUM Login) ---
Route::middleware('guest')->group(function () {
    
    // Login & Register
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    
    // Lupa Password
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');

    // Social Login (Google)
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
});


// --- AREA MEMBER & ADMIN (Harus Login) ---
Route::middleware(['auth'])->group(function () {
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profil User
    Route::get('/profile', UserProfile::class)->name('profile');

    // Dashboard User Biasa
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Download Invoice
    Route::get('/invoice/{id}', [InvoiceController::class, 'download'])->name('invoice.download');

    // --- TAMBAHAN: Cek Status Pembayaran (PENTING untuk Redirect setelah donasi) ---
    // Parameter order_id dibuat opsional (?) agar fleksibel
    Route::get('/donation/status/{order_id?}', CheckStatus::class)->name('donation.check');

    // --- AREA KHUSUS ADMIN (Prefix /admin) ---
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // Dashboard Admin
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');

        // Kelola Kategori
        Route::get('/categories', CategoryIndex::class)->name('categories');

        // Kelola Campaign
        Route::get('/campaigns', CampaignManager::class)->name('campaigns');
    });
});


// --- AREA MEMBER TERVERIFIKASI (Verified Email) ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Membuat Galang Dana Baru
    Route::get('/campaigns/create', CreateCampaign::class)->name('campaigns.create');
    
    // Donasi ke Campaign
    Route::get('/campaign/{id}/donate', Donate::class)->name('campaign.donate');
});

// Riwayat Donasi (Opsional: bisa dimasukkan ke group auth di atas agar lebih rapi)
Route::get('/riwayat-donasi', MyDonations::class)->name('my-donations');