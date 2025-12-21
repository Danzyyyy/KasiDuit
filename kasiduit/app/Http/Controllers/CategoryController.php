<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Tambahkan library ini untuk membuat slug

class CategoryController extends Controller
{
    // FUNGSI MENYIMPAN DATA (CREATE)
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Proses simpan ke database dengan Slug otomatis
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // Membuat slug: "Kesehatan Tubuh" -> "kesehatan-tubuh"
            'icon' => null // Default null sesuai migrasi
        ]);

        return redirect()->route('dashboard')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // FUNGSI UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required']);
        
        $category = Category::findOrFail($id);
        
        // Update data (update slug juga jika nama berubah)
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('dashboard')->with('success', 'Kategori berhasil diupdate!');
    }

    // FUNGSI HAPUS DATA (DELETE)
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('dashboard')->with('success', 'Kategori berhasil dihapus!');
    }
}