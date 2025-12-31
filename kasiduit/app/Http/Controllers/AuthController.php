<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // --- GOOGLE LOGIN ---

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Ambil data user dari Google
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->getId())->first();

            if (!$user) {
                $user = User::where('email', $googleUser->getEmail())->first();

                if ($user) {
                    // Kalo email nya ada, kita update google_id-nya
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(), // Update foto profil
                    ]);
                } else {
                    // Buat user baru
                    $user = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                        'role' => 'user', // Default role
                        'password' => Hash::make(Str::random(16)), 
                        'email_verified_at' => now(), // Otomatis verifikasi email
                    ]);
                }
            }

            // Login user 
            Auth::login($user);
            
            // session user
            session()->regenerate();

            return redirect()->intended('home');

        } catch (\Exception $e) {
            // Kondisi error
            return redirect('/login')->withErrors(['email' => 'Login Google gagal atau dibatalkan.']);
        }
    }

    public function logout() {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }
}