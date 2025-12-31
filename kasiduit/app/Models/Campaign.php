<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'campaigns';

    // Pastikan 'full_description' ada di sini!
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'target_amount',
        'deadline',
        'full_description',
        'short_description',
        'image_path',
        'status',
        'organizer_name',
        'organizer_phone',
        
        // SIMPAN DATA LOKASI
        'province_code',
        'province_name',
        'regency_code',
        'regency_name',
        'district_code',
        'district_name',
        'village_code',
        'village_name',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}