<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Campaign;
use App\Models\Donation;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')] 
class CampaignDetail extends Component
{
    public $campaign;
    public $activeTab = 'cerita';
    public $days_left;
    public $percentage;

    public $donations = [];

    public function mount($id)
    {
        // 1. Ambil data
        $this->campaign = Campaign::with(['user', 'category'])->findOrFail($id);
        $this->js("document.title = '{$this->campaign->title} - KasiDuit'");

        // --- PERBAIKAN LOGIKA WAKTU DI SINI ---
        
        // a. Set deadline ke akhir hari (jam 23:59:59)
        $deadline = Carbon::parse($this->campaign->deadline)->endOfDay();
        
        // b. Cek apakah sudah lewat?
        if ($deadline->isPast()) {
            $this->days_left = 0;
        } else {
            // c. Hitung selisih float, bulatkan ke atas, ubah jadi integer
            $this->days_left = (int) ceil(now()->floatDiffInDays($deadline));
        }

        
        // --- END PERBAIKAN ---
        
        // 3. Hitung Persentase
        if ($this->campaign->target_amount > 0) {
            $this->percentage = ($this->campaign->collected_amount / $this->campaign->target_amount) * 100;
        } else {
            $this->percentage = 0;
        }
        
        $this->donations = Donation::where('campaign_id', $id)
            ->where('status', 'paid')
            ->latest()
            ->get();
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.campaign-detail');
    }
}