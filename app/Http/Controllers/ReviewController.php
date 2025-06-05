<?php

namespace App\Http\Controllers;
use App\Models\Review;

abstract class Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'product'])->get(); // eager loading relasi
        return view('reviews.index', compact('reviews'));
    }

    
}
