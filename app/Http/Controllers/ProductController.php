<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('seller.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
            'description'=>'nullable',
            'price'=>'required|numeric|min:0',
            'stock'=>'required|integer|min:1',
            'category_id'=>'nullable|exists:categories,id'
        ]);

        $data['user_id'] = auth()->id();
        Product::create($data);

        return redirect()->route('seller.dashboard')->with('success','Produk berhasil ditambahkan!');
    }
}
