<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Donation; 
use App\Models\Campaign; // 1. IMPORT MODEL CAMPAIGN

#[Layout('components.layouts.app')]
#[Title('Profil Saya - KasiDuit')]
class Profile extends Component
{
    use WithFileUploads;

    public $activeTab = 'edit_profile'; 

    // Data Profil
    public $name, $email, $phone, $location, $bio;
    public $photo; 

    // Data Statistik & Riwayat Donasi
    public $totalDonation = 0;
    public $supportedCampaigns = 0;
    public $myDonations = [];
    
    // Data Campaign Saya (BARU)
    public $myCampaigns = [];

    // Data Password
    public $current_password, $new_password, $new_password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->location = $user->location;
        $this->bio = $user->bio;

        // --- STATISTIK ---
        $this->totalDonation = Donation::where('user_id', $user->id)
            ->where('status', 'paid')->sum('amount');

        $this->supportedCampaigns = Donation::where('user_id', $user->id)
            ->where('status', 'paid')->distinct('campaign_id')->count('campaign_id');

        $this->myDonations = Donation::with('campaign')
        ->where('user_id', $user->id)
        ->latest() // Urutkan dari yang terbaru
        ->get();

        // --- CAMPAIGN SAYA (BARU) ---
        // Mengambil semua campaign yang dibuat user ini
        $this->myCampaigns = Campaign::where('user_id', $user->id)
            ->latest()
            ->get();
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function updatedPhoto()
    {
        $this->validate(['photo' => 'image|max:2048']);

        $user = Auth::user();

        // Hapus foto lama jika ada dan bukan dari provider (Google)
        if ($user->avatar && !str_contains($user->avatar, 'http')) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Simpan foto baru
        $path = $this->photo->store('avatars', 'public');

        // Update database
        $user->update(['avatar' => $path]);

        // --- TAMBAHKAN BARIS INI ---
        // Reset variabel photo agar UI beralih dari mode "Preview" ke mode "Gambar Database"
        $this->reset('photo'); 
        
        session()->flash('success', 'Foto profil berhasil diperbarui!');
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:500',
        ]);
        Auth::user()->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'location' => $this->location,
            'bio' => $this->bio,
        ]);
        session()->flash('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|min:8|confirmed|different:current_password',
        ]);
        Auth::user()->update(['password' => Hash::make($this->new_password)]);
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        session()->flash('success', 'Password berhasil diubah.');
    }

    public function render()
    {
        return view('livewire.profile.user-profile');
    }
}