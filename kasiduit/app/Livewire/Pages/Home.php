<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Campaign;
use App\Models\Category;
use Livewire\Attributes\Layout;

class Home extends Component
{
    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.pages.home', [
            'stats' => $this->getStats(),
            'categories' => $this->getCategories(),
            'campaigns' => $this->getCampaigns(),
            'urgentCampaigns' => $this->getUrgentCampaigns(),
            'features' => $this->getFeatures(),
        ]);
    }

    private function getCategories()
    {
        return Category::withCount(['campaigns' => function ($query) {
            // Hanya hitung jika status = active
            $query->where('status', 'active');
        }])
        // Opsional: Gunakan whereHas jika ingin menyembunyikan kategori 
        // yang TIDAK punya campaign aktif sama sekali.
        ->whereHas('campaigns', function ($query) {
            $query->where('status', 'active');
        })
        ->get();
    }

    private function getCampaigns()
    {
        // Campaign Terbaru (Diubah jadi 6)
        return Campaign::with(['user', 'category'])
            ->where('status', 'active')
            ->latest()
            ->take(6) // <--- MENAMPILKAN 6 DATA
            ->get();
    }

    private function getUrgentCampaigns()
    {
        // Campaign Mendesak (Diubah jadi 6)
        return Campaign::with(['user', 'category'])
            ->where('status', 'active')
            ->whereDate('deadline', '>=', now())
            ->orderBy('deadline', 'asc')
            ->take(6) // <--- MENAMPILKAN 6 DATA
            ->get();
    }

    private function getStats()
    {
        return [
            ['value' => '12K+', 'label' => 'Campaign Aktif'],
            ['value' => '500K+', 'label' => 'Donatur'],
            ['value' => '50M+', 'label' => 'Dana Terkumpul'],
        ];
    }

    private function getFeatures()
    {
        return [
            [
                'title' => 'Keamanan Terjamin',
                'desc' => 'Data dan transaksi dilindungi enkripsi tingkat tinggi.',
                'icon' => 'shield-check'
            ],
            [
                'title' => 'Verifikasi Campaign',
                'desc' => 'Setiap penggalangan dana diverifikasi manual.',
                'icon' => 'badge-check'
            ],
            [
                'title' => 'Laporan Transparan',
                'desc' => 'Update penggunaan dana dilaporkan secara berkala.',
                'icon' => 'chart-bar'
            ],
        ];
    }
}