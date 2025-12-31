<?php

namespace App\Livewire\Campaign;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Campaign;
use App\Models\Category;

#[Layout('layouts.app')] 
#[Title('Daftar Campaign - KasiDuit')]
class Index extends Component
{
    use WithPagination;

    public $category = 'Semua Kategori';
    
    // Default sorting TERBARU sesuai permintaan
    public $sort = 'Terbaru'; 

    public function updatedCategory() { $this->resetPage(); }
    public function updatedSort() { $this->resetPage(); }

    public function setCategory($catName)
    {
        $this->category = $catName;
        $this->resetPage();
    }

    public function render()
    {
        $query = Campaign::with(['category', 'user'])->where('status', 'active');

        // Filter Kategori
        if ($this->category !== 'Semua Kategori') {
            $query->whereHas('category', function ($q) {
                $q->where('name', $this->category);
            });
        }

        // Sorting
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
            default:
                $query->latest(); 
                break;
        }

        // PERUBAHAN PENTING DI SINI:
        // Kita ambil semua data sebagai OBJEK, bukan array string.
        $categoriesList = Category::all(); 

        return view('livewire.campaign.index', [
            'campaigns' => $query->paginate(6),
            'categoriesList' => $categoriesList
        ]);
    }
}