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
        'email' => 'required|email:dns|unique:users,email',
        'password' => 'required|min:8', 
        'password_confirmation' => 'same:password', 
    ];

    protected $messages = [
        'name.required' => 'Nama Lengkap wajib diisi.',
        'email.unique' => 'Email sudah terdaftar.',
        'password_confirmation.same' => 'Konfirmasi password tidak cocok dengan password.',
    ];

    public function updated($propertyName)
    {
        if ($propertyName === 'password') {
            $this->validateOnly('password');
        } elseif ($propertyName === 'password_confirmation') {
            $this->validateOnly('password_confirmation');
        } else {
            $this->validateOnly($propertyName);
        }
    }

    public function register()
    {
        $this->validate();

        try {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role' => 'user',
            ]);

            session()->flash('success', 'Registrasi berhasil! Silakan login.');
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