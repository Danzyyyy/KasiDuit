<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout; // 👈 Import ini wajib agar Layout terdeteksi

class Home extends Component
{
    // 👇 Baris ini memberi tahu Livewire untuk memakai file di resources/views/layouts/app.blade.php
    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.home', [
            'stats' => $this->getStats(),
            'categories' => $this->getCategories(),
            'campaigns' => $this->getCampaigns(),
            'features' => $this->getFeatures(),
        ]);
    }

    // --- DATA DUMMY (Biarkan codingan di bawah ini tetap sama) ---

    private function getStats()
    {
        return [
            ['value' => '12K+', 'label' => 'Campaign Aktif'],
            ['value' => '500K+', 'label' => 'Donatur'],
            ['value' => '50M+', 'label' => 'Dana Terkumpul'],
        ];
    }

    private function getCategories()
    {
        return [
            ['name' => 'Kesehatan', 'icon' => '❤️'],
            ['name' => 'Pendidikan', 'icon' => '🎓'],
            ['name' => 'Bencana', 'icon' => '🌋'],
            ['name' => 'Zakat', 'icon' => '🕌'],
            ['name' => 'Kemanusiaan', 'icon' => '🤝'],
            ['name' => 'Panti Asuhan', 'icon' => '🏠'],
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

    private function getCampaigns()
    {
        return [
            [
                'id' => 1,
                'title' => 'Bantu Pengobatan Adik Rizky Melawan Kanker Tulang',
                'organizer' => 'Yayasan Peduli Sehat',
                'verified' => true,
                'image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&q=80&w=800',
                'category' => 'Kesehatan',
                'collected' => 75000000,
                'target' => 100000000,
                'percentage' => 75,
                'donors_count' => 1520,
                'days_left' => 12
            ],
            [
                'id' => 2,
                'title' => 'Tanggap Darurat: Banjir Bandang di Sumatera',
                'organizer' => 'ACT Cabang Padang',
                'verified' => true,
                'image' => 'https://images.unsplash.com/photo-1547496502-ffa2264a36b5?auto=format&fit=crop&q=80&w=800',
                'category' => 'Bencana',
                'collected' => 180000000,
                'target' => 200000000,
                'percentage' => 90,
                'donors_count' => 3421,
                'days_left' => 5
            ],
            [
                'id' => 3,
                'title' => 'Bangun Sekolah Layak di Pelosok Papua',
                'organizer' => 'Indonesia Mengajar',
                'verified' => true,
                'image' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&q=80&w=800',
                'category' => 'Pendidikan',
                'collected' => 45000000,
                'target' => 150000000,
                'percentage' => 30,
                'donors_count' => 540,
                'days_left' => 45
            ],
             [
                'id' => 4,
                'title' => 'Sedekah Makanan Jum\'at Berkah untuk Dhuafa',
                'organizer' => 'Masjid Raya Bintaro',
                'verified' => false,
                'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&q=80&w=800',
                'category' => 'Sosial',
                'collected' => 12000000,
                'target' => 20000000,
                'percentage' => 60,
                'donors_count' => 200,
                'days_left' => 2
            ],
            [
                'id' => 5,
                'title' => 'Operasi Jantung Bayi Azzam',
                'organizer' => 'Orang Tua Asuh',
                'verified' => true,
                'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&q=80&w=800',
                'category' => 'Kesehatan',
                'collected' => 95000000,
                'target' => 100000000,
                'percentage' => 95,
                'donors_count' => 890,
                'days_left' => 1
            ],
             [
                'id' => 6,
                'title' => 'Wakaf Al-Quran untuk Santri Penghafal',
                'organizer' => 'Rumah Zakat',
                'verified' => true,
                'image' => 'https://images.unsplash.com/photo-1609599006353-e629aaabfeae?auto=format&fit=crop&q=80&w=800',
                'category' => 'Zakat',
                'collected' => 5000000,
                'target' => 50000000,
                'percentage' => 10,
                'donors_count' => 45,
                'days_left' => 60
            ],
        ];
    }
}