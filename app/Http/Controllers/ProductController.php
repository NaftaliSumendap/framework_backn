<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

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
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }

    public function create()
    {
        return view('dashboard.store.create');
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|integer|min:0',
        'stock' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required|string',
        'brand' => 'nullable|string',
        'specifications' => 'nullable|string',
        'discount_price' => 'nullable|numeric|min:0',
        'is_featured' => 'boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Jika discount_price kosong/null, isi dengan price
    if (empty($validated['discount_price'])) {
        $validated['discount_price'] = $validated['price'];
    }

    // Generate unique slug
    $baseSlug = Str::slug($validated['name']);
    $slug = $baseSlug;
    $counter = 1;
    while (Product::where('slug', $slug)->exists()) {
        $slug = $baseSlug . '-' . $counter++;
    }
    $validated['slug'] = $slug;

    // Handle image upload
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $file->storeAs('products', $filename, 'public');
        $validated['image_path'] = $filename;
    }

    $validated['is_featured'] = $request->has('is_featured') ? $validated['is_featured'] : false;

    Product::create($validated);

    return redirect()->route('dashboard.store')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
}

public function search(Request $request)
{
    $query = $request->input('query');
    $sort = $request->input('sort', 'related');

    $products = Product::query()
        ->where('name', 'like', "%{$query}%")
        ->orWhere('description', 'like', "%{$query}%");

    // Sorting logic
    switch ($sort) {
        case 'newest':
            $products->orderByDesc('created_at');
            break;
        case 'bestseller':
            $products->orderByDesc('sold');
            break;
        case 'price':
            $products->orderBy('discount_price');
            break;
        default: // related
            // Bisa pakai relevansi atau biarkan default
            break;
    }

    $products = Product::where('name', 'like', "%$query%")->paginate(8);

    return view('search', compact('products', 'query'));
}

}
