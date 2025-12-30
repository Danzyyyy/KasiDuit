<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

class CampaignIndex extends Component
{
    // Pastikan semua properti ini ada untuk menghindari error $step
    public $showModal = false;
    public $step = 1; 
    public $amount = 0;
    public $paymentMethod = '';
    public $selectedCampaign = null;
    public $activeCategory = 'Semua';

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.campaign-index', [
            'campaigns' => $this->getCampaigns(),
            'categories' => $this->getCategories()
        ]);
    }

    #[On('openDonationModal')]
    public function loadCampaign($campaignId)
    {
        $this->selectedCampaign = collect($this->getCampaigns())->firstWhere('id', $campaignId);
        $this->step = 1; // Reset ke detail saat buka modal
        $this->amount = 0;
        $this->paymentMethod = '';
        $this->showModal = true;
    }

    public function goToPayment()
    {
        if ($this->amount >= 10000) {
            $this->step = 2;
        }
    }

    public function confirmPayment()
    {
        if ($this->paymentMethod) {
            $this->step = 3;
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->step = 1;
    }

    private function getCategories()
    {
        return [
            ['name' => 'Semua', 'icon' => '🌟', 'image' => 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb8?q=80&w=400'],
            ['name' => 'Kesehatan', 'icon' => '❤️', 'image' => 'https://images.unsplash.com/photo-1505751172107-573225a92701?q=80&w=400'],
            ['name' => 'Pendidikan', 'icon' => '🎓', 'image' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?q=80&w=400'],
            ['name' => 'Bencana', 'icon' => '🌋', 'image' => 'https://images.unsplash.com/photo-1544724569-5f546fd6f2b5?q=80&w=400'],
            ['name' => 'Zakat', 'icon' => '🕌', 'image' => 'https://images.unsplash.com/photo-1564121211835-e88c852648ab?q=80&w=400'],
            ['name' => 'Kemanusiaan', 'icon' => '🤝', 'image' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?q=80&w=400'],
        ];
    }

    private function getCampaigns()
    {
        return [
            // KESEHATAN
            ['id' => 1, 'title' => 'Bantu Pengobatan Adik Rizky: Kanker Tulang', 'organizer' => 'Yayasan Peduli Sehat', 'verified' => true, 'image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?q=80&w=800', 'category' => 'Kesehatan', 'collected' => 75000000, 'target' => 100000000, 'description' => 'Adik Rizky membutuhkan biaya besar untuk kemoterapi tulang stadium 3.'],
            ['id' => 2, 'title' => 'Operasi Jantung Bayi Azzam', 'organizer' => 'Orang Tua Asuh', 'verified' => true, 'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?q=80&w=800', 'category' => 'Kesehatan', 'collected' => 95000000, 'target' => 100000000, 'description' => 'Segera butuh tindakan medis untuk kelainan katup jantung bawaan Azzam.'],
            ['id' => 3, 'title' => 'Operasi Katarak Lansia Dhuafa', 'organizer' => 'KasiDuit Care', 'verified' => true, 'image' => 'https://images.unsplash.com/photo-1581594693702-fbdc51b2ad49?q=80&w=800', 'category' => 'Kesehatan', 'collected' => 45000000, 'target' => 60000000, 'description' => 'Membantu lansia pra-sejahtera melihat kembali dengan normal lewat operasi gratis.'],
            
            // PENDIDIKAN
            ['id' => 4, 'title' => 'Bangun Sekolah Pelosok Papua', 'organizer' => 'Indonesia Mengajar', 'verified' => true, 'image' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?q=80&w=800', 'category' => 'Pendidikan', 'collected' => 45000000, 'target' => 150000000, 'description' => 'Mari bangun ruang kelas layak untuk anak-anak di ufuk timur Indonesia.'],
            ['id' => 5, 'title' => 'Beasiswa Santri Penghafal Quran', 'organizer' => 'Rumah Zakat', 'verified' => true, 'image' => 'https://images.unsplash.com/photo-1609599006353-e629aaabfeae?q=80&w=800', 'category' => 'Pendidikan', 'collected' => 20000000, 'target' => 50000000, 'description' => 'Mendukung biaya pendidikan santri yatim penghafal Quran hingga lulus.'],
            
            // BENCANA
            ['id' => 6, 'title' => 'Darurat Banjir Bandang Sumatera', 'organizer' => 'ACT Padang', 'verified' => true, 'image' => 'https://images.unsplash.com/photo-1547496502-ffa2264a36b5?q=80&w=800', 'category' => 'Bencana', 'collected' => 180000000, 'target' => 200000000, 'description' => 'Ratusan rumah hanyut, warga membutuhkan pangan dan pakaian segera.'],
            
            // ZAKAT
            ['id' => 7, 'title' => 'Zakat Mal Berdayakan UMKM', 'organizer' => 'Baznas Kota', 'verified' => true, 'image' => 'https://images.unsplash.com/photo-1556742044-3c52d6e88c62?q=80&w=800', 'category' => 'Zakat', 'collected' => 30000000, 'target' => 100000000, 'description' => 'Modal usaha untuk pedagang kecil agar mereka bisa mandiri secara ekonomi.'],
            
            // KEMANUSIAAN
            ['id' => 8, 'title' => 'Sembako Lansia Sebatang Kara', 'organizer' => 'Relawan Kemanusiaan', 'verified' => true, 'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=800', 'category' => 'Kemanusiaan', 'collected' => 15000000, 'target' => 30000000, 'description' => 'Bantuan pangan harian untuk kakek nenek yang hidup sendirian.'],
            ['id' => 9, 'title' => 'Air Bersih Untuk Desa Kekeringan', 'organizer' => 'Aksi Cepat', 'verified' => true, 'image' => 'https://images.unsplash.com/photo-1518173946687-a4c8892bbd9f?q=80&w=800', 'category' => 'Kemanusiaan', 'collected' => 10000000, 'target' => 40000000, 'description' => 'Pembuatan sumur bor di wilayah terdampak kekeringan panjang.'],
        ];
    }
}