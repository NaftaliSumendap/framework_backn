<?php

namespace App\Http\Controllers;
use App\Models\Cart;

abstract class Controller
{
    public function index()
    {
        $carts = Cart::with(['user', 'product'])->get(); // eager loading relasi
        return view('carts.index', compact('carts'));
    }
}
