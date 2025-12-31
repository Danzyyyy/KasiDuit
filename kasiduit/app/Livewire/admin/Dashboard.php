<?php

namespace App\Livewire\Admin;

use Livewire\Component;
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
}