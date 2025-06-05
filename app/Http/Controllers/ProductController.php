<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $carts = Product::with(['category'])->get(); // eager loading relasi
        return view('products.index', compact('products'));
    }

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $product->name = $request->name;
    $product->discount_price = $request->discount_price;
    $product->stock = $request->stock;
    $product->category_id = $request->category_id; // langsung saja


    // Jika ada file gambar di-upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = $imagePath;
    }

    $product->save();

    return redirect()->back()->with('success', 'Produk berhasil diperbarui.');
}

    public function destroy($id)
    {
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
