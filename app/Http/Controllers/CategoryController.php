<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{public function index()
    {
        // Ambil semua kategori dari database
        $categories = Category::all();

        // Kirim data ke tampilan kategori
        return view('category', compact('categories'));
    }

    public function create()
    {
        // Tampilkan form untuk membuat kategori baru
        return view('create-category');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Buat kategori baru berdasarkan data yang divalidasi
        Category::create($validatedData);

        // Redirect ke halaman index kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        // Temukan kategori berdasarkan ID yang diberikan
        $category = Category::findOrFail($id);

        // Tampilkan form untuk mengedit kategori
        return view('edit-category', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Temukan kategori berdasarkan ID yang diberikan
        $category = Category::findOrFail($id);

        // Update kategori berdasarkan data yang divalidasi
        $category->update($validatedData);

        // Redirect ke halaman index kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        // Temukan kategori berdasarkan ID yang diberikan
        $category = Category::findOrFail($id);

        // Hapus kategori
        $category->delete();

        // Redirect ke halaman index kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
