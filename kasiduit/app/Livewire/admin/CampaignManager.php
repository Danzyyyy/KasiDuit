<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
<<<<<<< HEAD
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Kelola Campaign - Admin')]
=======

#[Layout('components.layouts.admin')]
>>>>>>> a113509b5397ce55bfb33aabe8fee3824c88211d
class CampaignManager extends Component
{
    use WithFileUploads, WithPagination;

<<<<<<< HEAD
    // --- PROPERTY ---
    public $title, $category_id, $short_description, $full_description;
    public $target_amount, $deadline, $status;
    public $image, $old_image, $campaign_id;
    
    public $isEditMode = false;
    public $showForm = false; // Toggle antara Tabel dan Form
    
    public $search = '';

    // Reset pagination saat search berubah
    public function updatedSearch() { $this->resetPage(); }

    // --- RENDER ---
=======
    // Properti Form
    public $title;
    public $category_id;
    public $target_amount;
    public $deadline;
    public $full_description;
    public $status = 'pending';
    public $image;
    public $old_image; 

    // Properti State
    public $campaignId = null;
    public $isEditMode = false;
    public $showForm = false; 
    public $showDetail = false; // Mode Detail
    public $search = '';
    
    // Data Campaign Aktif
    public $campaign; 

    // --- FUNGSI MOUNT (BARU: Untuk menangkap ID dari Dashboard) ---
    public function mount()
    {
        // Jika di URL ada ?id=1, otomatis buka detailnya
        if (request()->has('id')) {
            $id = request()->query('id');
            // Cek apakah data ada
            if(Campaign::find($id)) {
                $this->viewDetail($id);
            }
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

>>>>>>> a113509b5397ce55bfb33aabe8fee3824c88211d
    public function render()
    {
        $campaigns = Campaign::with(['user', 'category'])
            ->where('title', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.campaign-manager', [
            'campaigns' => $campaigns,
<<<<<<< HEAD
            'categories' => Category::all() // Data untuk dropdown di form
        ]);
    }

    // --- VERIFIKASI & MODERASI ---
    public function verify($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->update(['status' => 'active']);
        session()->flash('message', "Campaign '{$campaign->title}' berhasil disetujui.");
    }

    public function reject($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->update(['status' => 'rejected']);
        session()->flash('message', "Campaign '{$campaign->title}' ditolak.");
    }

    // --- CRUD: CREATE, UPDATE, DELETE ---
    
    protected function rules()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'full_description' => 'required|string',
            'target_amount' => 'required|numeric|min:1000',
            'deadline' => 'required|date',
            'status' => 'required|in:pending,active,rejected,finished',
        ];

        if ($this->isEditMode) {
            $rules['image'] = 'nullable|image|max:2048';
        } else {
            $rules['image'] = 'required|image|max:2048';
        }

        return $rules;
    }

    public function create() 
    { 
        $this->resetInputAndClose(); 
        $this->showForm = true; 
        $this->isEditMode = false; 
=======
            'categories' => Category::all()
        ]);
    }

    // --- FUNGSI DETAIL ---
    public function viewDetail($id)
    {
        $this->campaign = Campaign::with('user', 'category')->findOrFail($id);
        
        // Isi variabel untuk tampilan detail
        $this->campaignId = $this->campaign->id;
        $this->title = $this->campaign->title;
        $this->category_id = $this->campaign->category_id;
        $this->target_amount = $this->campaign->target_amount;
        $this->deadline = $this->campaign->deadline;
        $this->full_description = $this->campaign->full_description;
        $this->status = $this->campaign->status;
        $this->old_image = $this->campaign->image_path;

        $this->showDetail = true; 
        $this->showForm = false;  
        $this->isEditMode = false;
    }

    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->isEditMode = false;
        $this->showDetail = false;
>>>>>>> a113509b5397ce55bfb33aabe8fee3824c88211d
    }

    public function store()
    {
<<<<<<< HEAD
        $this->validate();

        $imagePath = $this->image->store('campaigns', 'public'); // Folder penyimpanan

        Campaign::create([
            'user_id' => Auth::id(), // Admin sebagai pembuat
            'category_id' => $this->category_id,
            'title' => $this->title,
            'slug' => Str::slug($this->title) . '-' . Str::random(5),
            'short_description' => Str::limit(strip_tags($this->full_description), 100),
            'full_description' => $this->full_description,
            'image_path' => $imagePath,
            'target_amount' => $this->target_amount,
            'deadline' => $this->deadline,
            'status' => $this->status ?? 'active',
            'collected_amount' => 0
        ]);

        session()->flash('message', 'Campaign baru berhasil dibuat!');
        $this->resetInputAndClose();
=======
        $this->validate([
            'title' => 'required|min:5',
            'category_id' => 'required',
            'target_amount' => 'required|numeric|min:10000',
            'deadline' => 'required|date|after:today',
            'full_description' => 'required',
            'image' => 'required|image|max:2048',
            'status' => 'required'
        ]);

        $imagePath = $this->image->store('campaigns', 'public');

        Campaign::create([
            'user_id' => Auth::id(),
            'category_id' => $this->category_id,
            'title' => $this->title,
            'slug' => Str::slug($this->title) . '-' . Str::random(5),
            'target_amount' => $this->target_amount,
            'deadline' => $this->deadline,
            'full_description' => $this->full_description,
            'image_path' => $imagePath,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Campaign berhasil dibuat.');
        $this->cancel();
>>>>>>> a113509b5397ce55bfb33aabe8fee3824c88211d
    }

    public function edit($id)
    {
<<<<<<< HEAD
        $campaign = Campaign::findOrFail($id);
        
        $this->campaign_id = $id;
        $this->title = $campaign->title;
        $this->category_id = $campaign->category_id;
        $this->full_description = $campaign->full_description;
        $this->target_amount = $campaign->target_amount;
        $this->deadline = $campaign->deadline;
        $this->status = $campaign->status;
        $this->old_image = $campaign->image_path;
        
        $this->isEditMode = true;
        $this->showForm = true;
=======
        $camp = Campaign::findOrFail($id);

        $this->campaignId = $camp->id;
        $this->title = $camp->title;
        $this->category_id = $camp->category_id;
        $this->target_amount = $camp->target_amount;
        $this->deadline = $camp->deadline ? \Carbon\Carbon::parse($camp->deadline)->format('Y-m-d') : null;
        $this->full_description = $camp->full_description;
        $this->status = $camp->status;
        $this->old_image = $camp->image_path; 
        
        $this->isEditMode = true;
        $this->showForm = true; 
        $this->showDetail = false; 
>>>>>>> a113509b5397ce55bfb33aabe8fee3824c88211d
    }

    public function update()
    {
<<<<<<< HEAD
        $this->validate();

        $campaign = Campaign::findOrFail($this->campaign_id);
        
        if ($this->image) {
            // Hapus gambar lama jika ada dan bukan URL
            if ($campaign->image_path && !Str::startsWith($campaign->image_path, 'http')) {
                Storage::disk('public')->delete($campaign->image_path);
            }
            $imagePath = $this->image->store('campaigns', 'public');
        } else {
            $imagePath = $campaign->image_path;
        }

        $campaign->update([
            'category_id' => $this->category_id,
            'title' => $this->title,
            'full_description' => $this->full_description,
            'image_path' => $imagePath,
            'target_amount' => $this->target_amount,
            'deadline' => $this->deadline,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Data campaign berhasil diperbarui!');
        $this->resetInputAndClose();
=======
        $this->validate([
            'title' => 'required|min:5',
            'category_id' => 'required',
            'target_amount' => 'required|numeric',
            'deadline' => 'required|date',
            'full_description' => 'required',
            'status' => 'required'
        ]);

        $camp = Campaign::findOrFail($this->campaignId);
        
        $data = [
            'title' => $this->title,
            'category_id' => $this->category_id,
            'target_amount' => $this->target_amount,
            'deadline' => $this->deadline,
            'full_description' => $this->full_description,
            'status' => $this->status,
        ];

        if ($this->image) {
            if ($camp->image_path && Storage::disk('public')->exists($camp->image_path)) {
                Storage::disk('public')->delete($camp->image_path);
            }
            $data['image_path'] = $this->image->store('campaigns', 'public');
        }

        $camp->update($data);

        session()->flash('message', 'Campaign berhasil diperbarui.');
        
        // Jika sedang mode detail, kembali ke detail yang sudah update
        if ($this->showDetail) {
            $this->viewDetail($this->campaignId);
        } else {
            $this->cancel();
        }
>>>>>>> a113509b5397ce55bfb33aabe8fee3824c88211d
    }

    public function delete($id)
    {
<<<<<<< HEAD
        $c = Campaign::find($id);
        if ($c->image_path && !Str::startsWith($c->image_path, 'http')) {
            Storage::disk('public')->delete($c->image_path);
        }
        $c->delete();
        session()->flash('message', 'Campaign berhasil dihapus.');
    }

    public function cancel() { $this->resetInputAndClose(); }
    
    private function resetInputAndClose() {
        $this->reset(['title', 'category_id', 'full_description', 'target_amount', 'deadline', 'image', 'campaign_id', 'isEditMode', 'showForm', 'status', 'old_image']);
=======
        $camp = Campaign::findOrFail($id);
        
        if ($camp->image_path && Storage::disk('public')->exists($camp->image_path)) {
            Storage::disk('public')->delete($camp->image_path);
        }
        
        $camp->delete();
        session()->flash('message', 'Campaign berhasil dihapus.');
        $this->cancel();
    }

    public function approve($id)
    {
        $camp = Campaign::findOrFail($id);
        $camp->update(['status' => 'active']);
        session()->flash('message', 'Campaign berhasil disetujui (Active).');
        
        // Refresh tampilan detail agar status berubah
        if($this->showDetail && $this->campaignId == $id) {
            $this->viewDetail($id);
        }
    }

    public function reject($id)
    {
        $camp = Campaign::findOrFail($id);
        $camp->update(['status' => 'rejected']);
        session()->flash('message', 'Campaign ditolak.');

        // Refresh tampilan detail agar status berubah
        if($this->showDetail && $this->campaignId == $id) {
            $this->viewDetail($id);
        }
    }

    public function cancel()
    {
        $this->resetForm();
        $this->showForm = false;
        $this->showDetail = false;
        // Hapus query parameter 'id' dari URL agar bersih (opsional tapi bagus UX-nya)
        $this->js("window.history.replaceState(null, null, window.location.pathname);");
    }

    private function resetForm()
    {
        $this->title = '';
        $this->category_id = '';
        $this->target_amount = '';
        $this->deadline = '';
        $this->full_description = '';
        $this->status = 'pending';
        $this->image = null;
        $this->old_image = null;
        $this->campaignId = null;
        $this->isEditMode = false;
        $this->campaign = null;
>>>>>>> a113509b5397ce55bfb33aabe8fee3824c88211d
    }
}