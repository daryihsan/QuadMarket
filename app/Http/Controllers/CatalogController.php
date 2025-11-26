<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('kategori');
        $location = $request->get('lokasi');
        $minPrice = $request->get('harga_min', 0);
        $maxPrice = $request->get('harga_max', 50000000);
        $rating = $request->get('rating');

        $query = Product::query();

        if ($category) {
            $query->where('category', $category);
        }

        if ($location) {
            $query->where('location', $location);
        }

        $query->whereBetween('price', [$minPrice, $maxPrice]);

        if ($rating) {
            $query->where('rating', '>=', $rating);
        }

        $products = $query->paginate(12);
        $totalProducts = $query->count();

        return view('katalog', [
            'products' => $products,
            'totalProducts' => $totalProducts,
            'currentCategory' => $category ?: 'Semua Produk',
            'filters' => $request->all(),
        ]);
    }
}
