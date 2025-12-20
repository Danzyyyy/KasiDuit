<?php

namespace App\Http\Controllers;

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
}