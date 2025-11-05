<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $products = auth()->user()->products()->latest()->get();
        return view('seller.dashboard', compact('products'));
    }
}
