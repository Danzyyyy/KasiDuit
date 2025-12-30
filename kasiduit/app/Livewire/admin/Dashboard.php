<?php

namespace App\Livewire\Admin;

use Livewire\Component;
<<<<<<< HEAD
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Campaign;
use App\Models\User;
use App\Models\Category;

#[Layout('components.layouts.app')] // Nanti bisa diganti layout khusus admin jika ada
#[Title('Admin Dashboard - KasiDuit')]
class Dashboard extends Component
{
    public function render()
    {
        // 1. Ambil Statistik Utama
        $stats = [
            'total_donasi' => Campaign::sum('collected_amount'),
            'total_campaign' => Campaign::count(),
            'pending_campaign' => Campaign::where('status', 'pending')->count(), // Perlu approval
            'total_user' => User::count(),
        ];

        // 2. Ambil 5 Campaign Terbaru (Semua status) untuk tabel ringkasan
        $recentCampaigns = Campaign::with('user')
            ->latest()
            ->take(5)
            ->get();

        // 3. Ambil 5 User Terbaru
        $recentUsers = User::latest()->take(5)->get();

        return view('livewire.admin.dashboard', [
            'stats' => $stats,
            'recentCampaigns' => $recentCampaigns,
            'recentUsers' => $recentUsers
        ]);
    }

    public function approve($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->update(['status' => 'active']); // Ubah jadi Active
        
        session()->flash('success', "Campaign '{$campaign->title}' berhasil disetujui!");
    }

    public function reject($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->update(['status' => 'rejected']); // Ubah jadi Rejected
        
        session()->flash('success', "Campaign '{$campaign->title}' telah ditolak.");
    }
=======
use App\Models\User;
use App\Models\Campaign;
use App\Models\Donation;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class Dashboard extends Component
{
    // ... properti stats yang sudah ada ...
    public $stats = [];
    
    // Properti untuk Modal Detail User
    public $showUserModal = false;
    public $selectedUser = null;

    public function mount()
    {
        // ... (kode mount statistik yang sudah ada tetap sama) ...
        
        // Contoh data dummy/query statistik (sesuaikan dengan kode lama Anda)
        $this->stats = [
            'total_donasi' => Donation::where('status', 'paid')->sum('amount'),
            'pending_campaign' => Campaign::where('status', 'pending')->count(),
            'total_campaign' => Campaign::where('status', 'active')->count(),
            'total_user' => User::count(),
        ];
    }

    // --- FUNGSI BARU: BUKA MODAL DETAIL USER ---
    public function viewUser($id)
    {
        // Ambil data user beserta statistik donasi/campaign-nya
        $this->selectedUser = User::withCount(['campaigns', 'donations' => function ($query) {
            $query->where('status', 'paid');
        }])->find($id);

        $this->showUserModal = true;
    }

    // --- FUNGSI BARU: TUTUP MODAL ---
    public function closeUserModal()
    {
        $this->showUserModal = false;
        $this->selectedUser = null;
    }

    public function render()
    {
        return view('livewire.admin.dashboard', [
            'recentCampaigns' => Campaign::latest()->take(5)->get(),
            'recentUsers' => User::latest()->take(5)->get(),
        ]);
    }
>>>>>>> a113509b5397ce55bfb33aabe8fee3824c88211d
}