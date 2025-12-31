<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Campaign; // Pastikan import ini ada

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug', 
    ];

    /**
     * Relasi: Satu Kategori memiliki banyak Campaign.
     * Fungsi inilah yang dicari oleh withCount('campaigns').
     */
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
}