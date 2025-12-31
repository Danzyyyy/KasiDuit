<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

// 👇 PERUBAHAN DI SINI
#[Layout('components.layouts.admin')] 
class CategoryIndex extends Component
{
    public $categories;
    public $name, $slug;
    public $categoryId = null;
    public $editMode = false; 

    public function render()
    {
        $this->categories = Category::withCount('campaigns')->latest()->get();
        return view('livewire.admin.category-index');
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|unique:categories,name',
            'slug' => 'required|unique:categories,slug',
        ]);

        Category::create([
            'name' => $this->name,
            'slug' => $this->slug,
        ]);

        $this->resetForm();
        session()->flash('message', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $cat = Category::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $cat->name;
        $this->slug = $cat->slug;        
        $this->editMode = true; 
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|unique:categories,name,' . $this->categoryId,
            'slug' => 'required|unique:categories,slug,' . $this->categoryId,
        ]);

        $cat = Category::findOrFail($this->categoryId);
        $cat->update([
            'name' => $this->name,
            'slug' => $this->slug,
        ]);

        $this->resetForm();
        session()->flash('message', 'Kategori berhasil diperbarui.');
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        session()->flash('message', 'Kategori berhasil dihapus.');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->slug = '';
        $this->categoryId = null;
        $this->editMode = false;
    }
}