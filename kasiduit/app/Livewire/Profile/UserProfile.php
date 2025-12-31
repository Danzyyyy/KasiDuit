<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Donation; // 1. IMPORT MODEL DONATION

#[Layout('components.layouts.app')]
#[Title('Profil Saya - KasiDuit')]
class UserProfile extends Component
{
    use WithFileUploads;

    public $activeTab = 'edit_profile'; // Tab default

    // Data Profil
    public $name, $email, $phone, $location, $bio;
    public $photo; // Untuk upload foto baru

    // Data Statistik & Riwayat Donasi (BARU)
    public $totalDonation = 0;
    public $supportedCampaigns = 0;
    public $myDonations = [];

    // Data Password
    public $current_password, $new_password, $new_password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        
        // Load data user
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->location = $user->location;
        $this->bio = $user->bio;

        // --- LOGIC STATISTIK DONASI (BARU) ---
        
        // 1. Hitung total uang yang didonasikan (hanya yang status 'paid')
        $this->totalDonation = Donation::where('user_id', $user->id)
            ->where('status', 'paid')
            ->sum('amount');

        // 2. Hitung jumlah campaign berbeda yang didukung
        $this->supportedCampaigns = Donation::where('user_id', $user->id)
            ->where('status', 'paid')
            ->distinct('campaign_id')
            ->count('campaign_id');

        // 3. Ambil list riwayat donasi beserta relasi campaign-nya
        $this->myDonations = Donation::with('campaign')
            ->where('user_id', $user->id)
            ->where('status', 'paid')
            ->latest()
            ->get();
    }

    // --- LOGIC GANTI TAB ---
    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    // --- LOGIC UPDATE FOTO ---
    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:2048', // Max 2MB
        ]);

        $user = Auth::user();
        
        // Hapus foto lama jika ada (dan bukan dari Google)
        if ($user->avatar && !str_contains($user->avatar, 'http')) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Simpan foto baru
        $path = $this->photo->store('avatars', 'public');
        
        $user->update(['avatar' => $path]);
        
        session()->flash('success', 'Foto profil berhasil diperbarui!');
    }

    // --- LOGIC UPDATE PROFIL ---
    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'location' => $this->location,
            'bio' => $this->bio,
        ]);

        session()->flash('success', 'Profil berhasil diperbarui.');
    }

    // --- LOGIC GANTI PASSWORD ---
    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|min:8|confirmed|different:current_password',
        ], [
            'current_password.current_password' => 'Password saat ini salah.',
            'new_password.different' => 'Password baru harus berbeda dengan password lama.'
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($this->new_password)
        ]);

        // Reset input form
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        session()->flash('success', 'Password berhasil diubah.');
    }

    public function render()
    {
        return view('livewire.profile.user-profile');
    }
}