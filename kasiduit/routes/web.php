<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\CampaignIndex; // Pastikan ini benar

Route::get('/', Home::class);
Route::get('/campaigns', CampaignIndex::class)->name('campaigns');