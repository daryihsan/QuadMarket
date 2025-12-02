<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class CategoryController extends Controller
{
    /**
     * [cite_start]Menampilkan daftar kategori (SRS-MartPlace-07)[cite: 16].
     */
    public function index()
    {
        // Mendapatkan semua kategori, diurutkan berdasarkan nama
        $categories = Category::orderBy('name')->paginate(10);
        return view('platform.categories', compact('categories'));
    }
    
    /**
     * [cite_start]Menyimpan kategori baru. [cite: 18]
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name|max:255',
            'icon' => 'nullable|image|max:2048', // Tambah validasi ikon
        ]);

        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('category_icons', 'public');
            $iconPath = Storage::url($iconPath); // Simpan sebagai URL publik
        }

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'icon_path' => $iconPath, // Simpan path ikon
        ]);
        
        return redirect()->route('platform.categories.index')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    /**
     * [cite_start]Memperbarui kategori yang sudah ada. [cite: 22]
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
            'icon' => 'nullable|image|max:2048', // Tambah validasi ikon
        ]);
        
        $data = ['name' => $validated['name'], 'slug' => Str::slug($validated['name'])];

        if ($request->hasFile('icon')) {
            // Hapus ikon lama jika ada
            if ($category->icon_path) {
                $pathToDelete = str_replace('/storage/', '', $category->icon_path);
                Storage::disk('public')->delete($pathToDelete);
            }
            // Upload ikon baru
            $iconPath = $request->file('icon')->store('category_icons', 'public');
            $data['icon_path'] = Storage::url($iconPath);
        } else {
            // Jaga ikon lama jika tidak ada upload baru
            $data['icon_path'] = $category->icon_path;
        }

        $category->update($data);
        return redirect()->route('platform.categories.index')->with('success', 'Kategori berhasil diperbarui!'); // Rute diubah dari platform.categories ke index
    }

    /**
     * [cite_start]Menghapus kategori. [cite: 26]
     */
    public function destroy(Category $category)
    {
        // Hapus ikon dari storage
        if ($category->icon_path) {
            $pathToDelete = str_replace('/storage/', '', $category->icon_path);
            Storage::disk('public')->delete($pathToDelete);
        }
        
        $category->delete();
        return redirect()->route('platform.categories.index')->with('success', 'Kategori berhasil dihapus.'); // Rute diubah dari platform.categories ke index
    }
}