<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Tambahkan ini untuk Slug
use App\Models\Campaign;
use App\Models\Category; // 1. Import Model Category

#[Layout('components.layouts.app')]
#[Title('Buat Galang Dana - KasiDuit')]
class CreateCampaign extends Component
{
    use WithFileUploads;

    public $currentStep = 1;

    // Data Master (Untuk Dropdown)
    public $categoriesList; // Variabel penampung data kategori

    // --- STEP 1: Info Campaign ---
    public $category_id = ''; // Ubah nama variabel dari $category jadi $category_id biar jelas
    public $title = '';
    public $target_amount = '';
    public $deadline = '';

    // --- STEP 2: Detail & Media ---
    public $description = '';
    public $image;

    // --- STEP 3: Verifikasi & Data Diri ---
    public $organizer_name = '';
    public $phone_number = '';
    public $email = '';
    public $agree = false;

    public function mount()
    {
        // 2. Ambil semua kategori dari database saat halaman dimuat
        $this->categoriesList = Category::all();

        if (Auth::check()) {
            $this->organizer_name = Auth::user()->name;
            $this->email = Auth::user()->email;
        }
    }

    // Validasi Langkah 1
    public function validateStep1()
    {
        $this->validate([
            // 3. Ubah validasi: wajib pilih id yang ada di tabel categories
            'category_id' => 'required|exists:categories,id', 
            'title' => 'required|min:10|max:100',
            'target_amount' => 'required|numeric|min:100000',
            'deadline' => 'required|date|after:today',
        ], [
            'category_id.required' => 'Silakan pilih kategori donasi.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'title.required' => 'Judul campaign wajib diisi.',
            'target_amount.min' => 'Target dana minimal Rp 100.000.',
            'deadline.after' => 'Batas waktu harus lebih dari hari ini.'
        ]);

        $this->currentStep = 2;
    }

    public function validateStep2()
    {
        $this->validate([
            'description' => 'required|min:50',
            'image' => 'required|image|max:5120',
        ], [
            'description.min' => 'Ceritakan detail campaign minimal 50 karakter.',
            'image.required' => 'Wajib upload foto utama campaign.',
            'image.max' => 'Ukuran foto maksimal 5MB.',
        ]);

        $this->currentStep = 3;
    }

    public function submit()
    {
        $this->validate([
            'organizer_name' => 'required|string',
            'phone_number' => 'required|numeric|min_digits:10',
            'agree' => 'accepted'
        ]);

        // Simpan Gambar
        $imagePath = $this->image->store('campaigns', 'public');

        // 4. Simpan ke Database
        Campaign::create([
            'user_id' => Auth::id(),
            'category_id' => $this->category_id, // Simpan ID kategori
            'title' => $this->title,
            'slug' => Str::slug($this->title) . '-' . Str::random(5),
            'short_description' => Str::limit($this->description, 100),
            'full_description' => $this->description,
            'image_path' => $imagePath, // Sesuaikan nama kolom di DB (image atau image_path)
            'target_amount' => $this->target_amount,
            'deadline' => $this->deadline,
            'status' => 'pending', 
            'collected_amount' => 0
        ]);

        session()->flash('success', 'Campaign berhasil dibuat! Tim kami akan segera memverifikasinya.');
        return redirect()->route('dashboard'); 
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function render()
    {
        return view('livewire.create-campaign');
    }
}