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
        'comment' => 'nullable|string|max:1000',
    ]);

    $product = Product::findOrFail($productId);

    // Cek apakah user sudah pernah review produk ini
    $alreadyReviewed = Review::where('user_id', auth()->id())
        ->where('product_id', $productId)
        ->exists();

    if ($alreadyReviewed) {
        return back()->with('error', 'Anda sudah pernah memberikan ulasan untuk produk ini.');
    }

    // Simpan review
    Review::create([
        'user_id' => auth()->id(),
        'product_id' => $productId,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    // Tambahkan jumlah terjual (sold) +1
    $product->increment('sold');

    return back()->with('success', 'Ulasan berhasil dikirim dan jumlah terjual terupdate!');
}

public function destroy($id)
{
    $review = \App\Models\Review::findOrFail($id);
    $review->delete();

    return back()->with('success', 'Review berhasil dihapus.');
}

}
