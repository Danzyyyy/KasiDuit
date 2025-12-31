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
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Kelola Campaign - Admin')]
class CampaignManager extends Component
{
    use WithFileUploads, WithPagination;

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
    public function render()
    {
        $campaigns = Campaign::with(['user', 'category'])
            ->where('title', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.campaign-manager', [
            'campaigns' => $campaigns,
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
    }

    public function store()
    {
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
    }

    public function edit($id)
    {
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
    }

    public function update()
    {
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
    }

    public function delete($id)
    {
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
    }
}