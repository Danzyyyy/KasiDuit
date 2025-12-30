<?php

namespace App\Livewire\Donation;

use Livewire\Component;
use App\Models\Donation;
use Illuminate\Support\Facades\Route;

class CheckStatus extends Component
{
    public $orderId;
    public $donation;

    public function mount($order_id = null)
    {
        // Ambil order_id dari parameter URL (jika route pakai parameter)
        // atau dari query string (?order_id=...)
        $this->orderId = $order_id ?? request()->query('order_id');

        $this->loadDonation();
    }

    public function loadDonation()
    {
        // Ambil data terbaru dari database
        $this->donation = Donation::with('campaign')
            ->where('order_id', $this->orderId)
            ->firstOrFail();
    }

    public function render()
    {
        // Pastikan data selalu segar setiap kali render (polling berjalan)
        $this->loadDonation();

        return view('livewire.donation.check-status', [
            'donation' => $this->donation
        ])->layout('components.layouts.app'); // Sesuaikan layout kamu
    }
}