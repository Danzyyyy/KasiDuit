<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination; // Tambahkan Pagination
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Campaign;
use App\Models\Category;

// PERBAIKAN: Gunakan 'layouts.app' agar konsisten dengan file About.php
#[Layout('layouts.app')] 
#[Title('Daftar Campaign - KasiDuit')]
class CampaignList extends Component
{
    use WithPagination; // Aktifkan fitur halaman 1, 2, dst

    public $category = 'Semua Kategori';
    public $sort = 'Paling Relevan';

    // Reset halaman ke 1 jika filter berubah
    public function updatedCategory() { $this->resetPage(); }
    public function updatedSort() { $this->resetPage(); }

    public function setCategory($catName)
    {
        $this->category = $catName;
        $this->resetPage();
    }

    public function render()
    {
        // 1. Mulai Query (Hanya ambil yang statusnya 'active')
        $query = Campaign::with(['category', 'user'])->where('status', 'active');
        // $query = Campaign::with(['category', 'user']);

        // 2. Filter Kategori
        if ($this->category !== 'Semua Kategori') {
            $query->whereHas('category', function ($q) {
                $q->where('name', $this->category);
            });
        }

        // 3. Sorting
        switch ($this->sort) {
            case 'Terbaru':
                $query->latest();
                break;
            case 'Dana Terkumpul Terbesar':
                $query->orderByDesc('collected_amount');
                break;
            case 'Mendesak (Sisa Waktu Sedikit)':
                $query->orderBy('deadline', 'asc')->whereDate('deadline', '>=', now());
                break;
            default: // Paling Relevan (Acak atau Terbaru)
                $query->inRandomOrder();
                break;
        }

        // 4. Ambil Data Kategori untuk Sidebar
        $categoriesList = Category::pluck('name')->prepend('Semua Kategori')->toArray();

        return view('livewire.campaign-list', [
            'campaigns' => $query->paginate(6), // Tampilkan 6 per halaman
            'categoriesList' => $categoriesList
        ]);
    }
}