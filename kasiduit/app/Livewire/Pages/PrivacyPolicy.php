<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;

class PrivacyPolicy extends Component
{
    // Pastikan path ini sesuai dengan lokasi file app.blade.php Anda
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.privacy-policy');
    }
}