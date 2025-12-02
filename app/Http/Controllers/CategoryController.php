<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori (SRS-MartPlace-07).
     */
    public function index()
    {
        // Mendapatkan semua kategori, diurutkan berdasarkan nama
        $categories = Category::orderBy('name')->paginate(10);
        return view('platform.categories', compact('categories'));
    }

    /**
     * Menyimpan kategori baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name|max:255',
        ]);

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->route('platform.categories.index')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    /**
     * Memperbarui kategori yang sudah ada.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
        ]);
        
        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->route('platform.categories')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Menghapus kategori.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('platform.categories')->with('success', 'Kategori berhasil dihapus.');
    }
}