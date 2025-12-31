<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // --- 1. DEFINISI ROLE (KONSTANTA) ---
    // Menggunakan konstanta menghindari typo saat coding
    const ROLE_MEMBER = 'member';
    const ROLE_VERIFIED = 'verified_member';
    const ROLE_ADMIN = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'role',
        'phone',      // <--- Data Profil
        'location',   // <--- Data Profil
        'bio',        // <--- Data Profil
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- 2. RELASI DATABASE (WAJIB ADA UNTUK DASHBOARD) ---

    /**
     * Relasi: User memiliki banyak Campaign (yang dibuatnya)
     * Digunakan untuk menghitung jumlah campaign per user di dashboard admin.
     */
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    /**
     * Relasi: User memiliki banyak Donasi (yang dikeluarkannya)
     * Digunakan untuk menghitung total donasi per user di dashboard admin.
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    // --- 3. HELPER METHODS (Logika Hak Akses) ---

    /**
     * Cek apakah user adalah Admin
     */
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Cek apakah user adalah Member Terverifikasi
     */
    public function isVerifiedMember()
    {
        return $this->role === self::ROLE_VERIFIED;
    }

    /**
     * Cek apakah user memiliki hak untuk membuat Galang Dana (Campaign).
     * Aturan: Hanya Verified Member dan Admin yang boleh.
     */
    public function canCreateCampaign()
    {
        return $this->role === self::ROLE_VERIFIED || $this->role === self::ROLE_ADMIN;
    }
}