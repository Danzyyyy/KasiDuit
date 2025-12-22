<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- LOGIN ---
    
    public function showLoginForm()
    {
        return view('auth.login'); // Kita akan pindahkan view ke folder auth biasa
    }

    public function login(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Coba Login (Nama + Email + Password)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // 3. Jika Gagal
        return back()->withErrors([
            'email' => 'Data login (Nama, Email, atau Password) tidak sesuai.',
        ])->onlyInput('email', 'name');
    }

    // --- REGISTER ---

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user'
        ]);

        Auth::login($user);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // --- LOGOUT ---
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

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

            return redirect()->intended('dashboard');

        } catch (\Exception $e) {
            // Kondisi error
            return redirect('/login')->withErrors(['email' => 'Login Google gagal atau dibatalkan.']);
        }
    }
}