<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage; // Digunakan untuk upload file

class ProductController extends Controller
{
    /**
     * Tampilkan form Tambah Produk Baru.
     * Route: seller.products.create
     */
    public function create()
    {
        $categories = Category::all();
        // Asumsi file view Add Product ada di 'seller.product.add'
        return view('seller.product.add', compact('categories')); 
    }

    /**
     * Simpan data produk baru ke database.
     * Route: seller.products.store (POST)
     */
    public function store(Request $request)
    {
        // 1. Validasi Data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'condition' => 'required|in:baru,bekas',
            'min_order' => 'required|integer|min:1',
            // Asumsi input file diberi nama 'foto_produk'
            'foto_produk' => 'nullable|image|max:5120', // Maks 5MB
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = 'Aktif'; // Default status produk baru
        
        // 2. Upload Foto Produk
        if ($request->hasFile('foto_produk')) {
            $fotoPath = $request->file('foto_produk')->store('public/product_images');
            $data['image_path'] = Storage::url($fotoPath); // Simpan URL yang dapat diakses publik
        } else {
             $data['image_path'] = null;
        }

        // Hapus 'foto_produk' dari array data karena tidak ada di tabel products
        unset($data['foto_produk']); 

        // 3. Simpan ke Database
        Product::create($data); 

        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }
}