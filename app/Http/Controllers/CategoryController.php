<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        // diurutkan berdasarkan nama
        $categories = Category::orderBy('name')->paginate(10);
        return view('platform.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name|max:255',
            'icon' => 'nullable|image|max:2048',
        ]);

        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('category_icons', 'public');
            $iconPath = Storage::url($iconPath); // simpan sebagai URL publik
        }

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'icon_path' => $iconPath,
        ]);
        
        return redirect()->route('platform.categories.index')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
            'icon' => 'nullable|image|max:2048',
        ]);
        
        $data = ['name' => $validated['name'], 'slug' => Str::slug($validated['name'])];

        if ($request->hasFile('icon')) {
            // // Hapus ikon lama jika ada
            // if ($category->icon_path) {
            //     $pathToDelete = str_replace('/storage/', '', $category->icon_path);
            //     Storage::disk('public')->delete($pathToDelete);
            // }
            // upload ikon baru
            $iconPath = $request->file('icon')->store('category_icons', 'public');
            $data['icon_path'] = Storage::url($iconPath);
        } else {
            // jaga ikon lama jika tidak ada upload baru
            $data['icon_path'] = $category->icon_path;
        }

        $category->update($data);
        return redirect()->route('platform.categories.index')->with('success', 'Kategori berhasil diperbarui!'); // Rute diubah dari platform.categories ke index
    }

    // hapus
    public function destroy(Category $category)
    {
        // hapus ikon dari storage
        if ($category->icon_path) {
            $pathToDelete = str_replace('/storage/', '', $category->icon_path);
            Storage::disk('public')->delete($pathToDelete);
        }
        
        $category->delete();
        return redirect()->route('platform.categories.index')->with('success', 'Kategori berhasil dihapus.'); // Rute diubah dari platform.categories ke index
    }

    public function showProducts($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            abort(404, 'Kategori tidak ditemukan');
        }

        // ambil produk berdasarkan kategori
        $products = \App\Models\Product::where('category_id', $category->id)
            ->paginate(12);

        $totalProducts = $products->total();
        $currentCategory = $category->name;

        return view('katalog', compact('products', 'category', 'totalProducts', 'currentCategory'));
    }


}