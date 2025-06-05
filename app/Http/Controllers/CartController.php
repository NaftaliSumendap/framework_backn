<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Menampilkan semua item di keranjang belanja pengguna yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua item keranjang untuk pengguna yang sedang login,
        // dengan eager loading relasi 'product' untuk menghindari N+1 query problem.
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('cart', compact('carts'));
    }

    /**
     * Menambahkan produk ke keranjang belanja.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product  (Route Model Binding)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request, Product $product)
    {
        // Pastikan pengguna sudah login sebelum menambahkan ke keranjang.
        // Meskipun rute sudah dilindungi middleware 'auth', ini adalah lapisan keamanan tambahan
        // dan memberikan pesan yang lebih spesifik jika diakses tanpa login.
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menambahkan produk ke keranjang.');
        }

        $user_id = Auth::id(); // Mendapatkan ID pengguna yang sedang login

        // Validasi input kuantitas (jika ada)
        $request->validate([
            'quantity' => 'nullable|integer|min:1', // Kuantiitas bisa null (default 1) atau angka positif
        ]);

        // Cari apakah produk sudah ada di keranjang pengguna ini
        $cartItem = Cart::where('user_id', $user_id)
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            // Jika produk sudah ada di keranjang, tambahkan kuantitasnya.
            // Gunakan kuantitas dari request jika ada, jika tidak, tambahkan 1.
            $cartItem->quantity += $request->quantity ?? 1;
            $cartItem->save();
            $message = 'Jumlah produk di keranjang berhasil diperbarui!';
        } else {
            // Jika produk belum ada di keranjang, buat item keranjang baru.
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product->id,
                'quantity' => $request->quantity ?? 1, // Gunakan kuantitas dari request jika ada, jika tidak, default 1.
            ]);
            $message = 'Produk berhasil ditambahkan ke keranjang!';
        }

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', $message);
    }

    /**
     * Memperbarui jumlah produk di keranjang.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart  (Route Model Binding)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Cart $cart)
    {
        // Pengecekan keamanan: Pastikan item keranjang ini milik pengguna yang sedang login.
        // Jika tidak, alihkan dengan pesan error.
        if ($cart->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak diizinkan mengubah item keranjang ini.');
        }

        // Validasi input kuantitas
        $request->validate([
            'quantity' => 'required|integer|min:1', // Kuantitas wajib diisi, harus angka, dan minimal 1
        ]);

        // Perbarui kuantitas item keranjang
        $cart->quantity = $request->quantity;
        $cart->save();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Jumlah produk di keranjang berhasil diperbarui!');
    }

    /**
     * Menghapus produk dari keranjang.
     *
     * @param  \App\Models\Cart  $cart  (Route Model Binding)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Cart $cart)
    {
        // Pengecekan keamanan: Pastikan item keranjang ini milik pengguna yang sedang login.
        // Jika tidak, alihkan dengan pesan error.
        if ($cart->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak diizinkan menghapus item keranjang ini.');
        }

        // Hapus item keranjang dari database
        $cart->delete();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
