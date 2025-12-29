<?php

namespace App\Livewire\Admin;

use Livewire\Component;
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
}