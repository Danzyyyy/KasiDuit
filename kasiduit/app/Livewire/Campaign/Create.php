<?php

namespace App\Livewire\Campaign;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http; // PASTIKAN INI ADA
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Create extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $isSuccess = false;
    public $createdCampaignId; 

    // Form Properties
    public $title, $category_id, $target_amount, $deadline, $description, $image;
    
    // --- DATA LOKASI ---
    public $selectedProvinceName;

    // --- DROPDOWN API 4 LEVEL ---
    public $provinces = [];
    public $selectedProvince = null;
    
    public $regencies = [];
    public $selectedRegency = null; 
    public $selectedRegencyName = null; 

    public $districts = [];
    public $selectedDistrict = null;
    public $selectedDistrictName = null;

    public $villages = [];
    public $selectedVillage = null;
    public $selectedVillageName = null;

    // Organizer Info
    public $organizer_name, $phone_number, $email, $agree = false;

    public function mount()
    {
        $this->email = Auth::user()->email;
        $this->organizer_name = Auth::user()->name;
        
        // Load Provinsi Pertama Kali
        $this->fetchData('https://wilayah.id/api/provinces.json', 'provinces');
    }

    // --- HELPER FUNCTION UNTUK FETCH API ---
    private function fetchData($url, $targetProperty)
    {
        try {
            // Menggunakan Facade Http yang sudah di-use di atas
            $response = Http::withoutVerifying()->timeout(5)->get($url);
            
            if ($response->successful()) {
                $this->$targetProperty = $response->json()['data'] ?? [];
            } else {
                $this->$targetProperty = []; // Kosongkan jika gagal
            }
        } catch (\Exception $e) {
            $this->$targetProperty = []; // Kosongkan jika timeout/error
        }
    }

    // LISTENER DROPDOWN
    public function updatedSelectedProvince($value)
    {
        $this->reset(['selectedRegency', 'regencies', 'selectedDistrict', 'districts', 'selectedVillage', 'villages']);
        if ($value) $this->fetchData("https://wilayah.id/api/regencies/{$value}.json", 'regencies');
    }

    public function updatedSelectedRegency($value)
    {
        $this->reset(['selectedDistrict', 'districts', 'selectedVillage', 'villages']);
        if ($value) $this->fetchData("https://wilayah.id/api/districts/{$value}.json", 'districts');
    }

    public function updatedSelectedDistrict($value)
    {
        $this->reset(['selectedVillage', 'villages']);
        if ($value) $this->fetchData("https://wilayah.id/api/villages/{$value}.json", 'villages');
    }

    public function render()
    {
        return view('livewire.campaign.create', [
            'categoriesList' => Category::all()
        ]);
    }

    // VALIDASI STEP 1
    public function validateStep1()
    {
        $this->validate([
            'category_id' => 'required',
            'title' => 'required|min:10|max:50',
            'target_amount' => 'required|numeric|min:100000',
            'deadline' => 'required|date|after:today',
        ]);
        $this->currentStep = 2;
    }

    // VALIDASI STEP 2
    public function validateStep2()
    {
        $this->validate([
            'description' => 'required|min:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // Validasi file gambar maks 5MB
            
            // Validasi Wilayah & Alamat
            'selectedProvince' => 'required',
            'selectedRegency' => 'required',
            'selectedDistrict' => 'required',
            'selectedVillage' => 'required',
        ]);

        // Simpan Nama Wilayah untuk keperluan DB dan Tampilan
        $this->selectedProvinceName = collect($this->provinces)->firstWhere('code', $this->selectedProvince)['name'] ?? '';
        $this->selectedRegencyName = collect($this->regencies)->firstWhere('code', $this->selectedRegency)['name'] ?? '';
        $this->selectedDistrictName = collect($this->districts)->firstWhere('code', $this->selectedDistrict)['name'] ?? '';
        $this->selectedVillageName = collect($this->villages)->firstWhere('code', $this->selectedVillage)['name'] ?? '';

        $this->currentStep = 3;
    }

    // SUBMIT
    public function submit()
    {
        $this->validate([
            'organizer_name' => 'required|min:3',
            'phone_number' => 'required|numeric',
            'agree' => 'accepted',
        ]);

        // Simpan Gambar ke Storage Public
        $imagePath = $this->image->store('campaigns', 'public');

        $campaign = Campaign::create([
            'user_id' => Auth::id(),
            'category_id' => $this->category_id,
            'title' => $this->title,
            'slug' => Str::slug($this->title) . '-' . Str::random(5),
            'target_amount' => $this->target_amount,
            'deadline' => $this->deadline,
            'full_description' => $this->description,
            'short_description' => Str::limit($this->description, 150),
            'image_path' => $imagePath,
            'status' => 'pending',
            'organizer_name' => $this->organizer_name,
            'organizer_phone' => $this->phone_number,
            
            // SIMPAN DATA LOKASI
            'province_code' => $this->selectedProvince,
            'province_name' => $this->selectedProvinceName,
            'regency_code' => $this->selectedRegency,
            'regency_name' => $this->selectedRegencyName,
            'district_code' => $this->selectedDistrict,
            'district_name' => $this->selectedDistrictName,
            'village_code' => $this->selectedVillage,
            'village_name' => $this->selectedVillageName,
        ]);

        $this->createdCampaignId = $campaign->id;
        $this->isSuccess = true; 
        session()->flash('message', 'Campaign berhasil dibuat!');
    }

    public function previousStep()
    {
        $this->currentStep--;
    }
}