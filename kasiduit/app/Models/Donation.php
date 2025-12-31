<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{

    // Opsi lain (jika ingin lebih ketat, pakai $fillable):
    protected $fillable = [
        'campaign_id',
        'user_id',
        'order_id',
        'donor_name',
        'donor_email',
        'is_anonymous',
        'comment',
        'amount',
        'status',
        'snap_token',
        'payment_method',
    ];

    // Relasi ke Campaign
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}