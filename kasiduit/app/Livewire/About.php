<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout; // 1. Import ini wajib

// 2. Pasang Attribute ini
#[Layout('layouts.app')] 
class About extends Component
{
    public function render()
    {
        return view('about');
    }
}