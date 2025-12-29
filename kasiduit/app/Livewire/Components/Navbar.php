<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        // Memanggil file view yang sudah Anda buat sebelumnya
        return view('components.navbar');
    }
}