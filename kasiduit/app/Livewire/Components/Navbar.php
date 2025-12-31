<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Campaign; 
use Illuminate\Support\Str;

class Navbar extends Component
{
    public $search = '';
    public $results = [];

    public function updatedSearch()
    {
        // 1. Reset jika input terlalu pendek
        if (strlen($this->search) < 2) {
            $this->results = [];
            return;
        }

        try {
            // 2. Query Pencarian (Judul ATAU Kategori)
            $campaigns = Campaign::query()
                ->with('category') // Load relasi kategori
                ->where('status', 'active') // Hanya cari yang statusnya aktif
                ->where(function ($query) {
                    // Logic: (Judul mengandung kata kunci) ATAU (Nama Kategori mengandung kata kunci)
                    $query->where('title', 'like', '%' . $this->search . '%')
                          ->orWhereHas('category', function ($q) {
                              $q->where('name', 'like', '%' . $this->search . '%');
                          });
                })
                ->latest()
                ->take(5) // Batasi 5 hasil
                ->get();

            // 3. Format hasil untuk View
            if ($campaigns->count() > 0) {
                $this->results = $campaigns->map(function ($c) {
                    return [
                        'id' => $c->id,
                        'title' => $c->title,
                        'category' => $c->category ? $c->category->name : 'Umum',
                        // Cek apakah gambar URL eksternal atau storage lokal
                        'image' => $c->image_path && Str::startsWith($c->image_path, 'http') 
                                    ? $c->image_path 
                                    : asset('storage/' . $c->image_path)
                    ];
                })->toArray();
            } else {
                $this->results = []; 
            }

        } catch (\Exception $e) {
            // Jika terjadi error (misal tabel belum ada), kosongkan hasil
            $this->results = [];
        }
    }

    public function render()
    {
        return view('components.navbar');
    }
}