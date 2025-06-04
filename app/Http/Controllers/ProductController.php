<?php

namespace App\Http\Controllers;
use App\Models\Product;

abstract class Controller
{
    public function index()
    {
        $carts = Product::with(['category'])->get(); // eager loading relasi
        return view('products.index', compact('products'));
    }
}
