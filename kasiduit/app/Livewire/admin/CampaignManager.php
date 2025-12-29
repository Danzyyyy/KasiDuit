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

#[Layout('components.layouts.admin')]
class CampaignManager extends Component
{
    use WithFileUploads, WithPagination;

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

    public function render()
    {
        $campaigns = Campaign::with(['user', 'category'])
            ->where('title', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.campaign-manager', [
            'campaigns' => $campaigns,
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
    }

    public function store()
    {
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
    }

    public function edit($id)
    {
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
    }

    public function update()
    {
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
    }

    public function delete($id)
    {
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
    }
}