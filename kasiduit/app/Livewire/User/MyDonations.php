<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class MyDonations extends Component
{
    public function render()
    {
        $donations = Donation::where('user_id', Auth::id())
            ->with('campaign')
            ->latest()
            ->paginate(10); // Ubah get() jadi paginate()

        return view('livewire.profile.my-donations', [
            'donations' => $donations
        ]);
    }
}