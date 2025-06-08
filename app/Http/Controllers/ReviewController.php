<?php

namespace App\Http\Controllers;
use App\Models\Review;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'product'])->get(); // eager loading relasi
        return view('reviews.index', compact('reviews'));
    }

public function store(Request $request, $productId)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'title' => 'nullable|string|max:255',
        'comment' => 'required|string|max:1000',
    ]);

    // Cek apakah user sudah pernah review produk ini
    $existing = \App\Models\Review::where('user_id', Auth::id())
        ->where('product_id', $productId)
        ->first();

    if ($existing) {
        return back()->with('error', 'Anda sudah pernah memberikan ulasan untuk produk ini.');
    }

    \App\Models\Review::create([
        'user_id' => Auth::id(),
        'product_id' => $productId,
        'rating' => $request->rating,
        'title' => $request->title,
        'comment' => $request->comment,
    ]);

    return back()->with('success', 'Ulasan berhasil ditambahkan!');
}

public function destroy($id)
{
    $review = \App\Models\Review::findOrFail($id);
    $review->delete();

    return back()->with('success', 'Review berhasil dihapus.');
}

}
