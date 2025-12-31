<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Daftar Akun - KasiDuit')]
class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ];

    protected $messages = [
        // ... (pesan error tetap sama)
        'name.required' => 'Nama Lengkap wajib diisi.',
        'email.unique' => 'Email sudah terdaftar.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function register()
    {
        $this->validate();

        try {
            // 1. Simpan User Baru
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role' => 'user',
            ]);

            // 2. JANGAN Login Otomatis (Hapus atau Komentar baris ini)
            // Auth::login($user); 

            // 3. Kirim Flash Message Sukses
            session()->flash('success', 'Registrasi berhasil! Silakan login dengan akun baru Anda.');

            // 4. Redirect ke Halaman Login
            return redirect()->route('login');

        } catch (\Exception $e) {
            $this->addError('email', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}