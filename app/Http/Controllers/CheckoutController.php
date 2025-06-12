<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
public function process(Request $request)
{
    // Validasi input
    $request->validate([
        'shipping_method' => 'required',
        'payment_method' => 'required',
    ]);

    // Ambil semua cart user
    $carts = Cart::with('product')->where('user_id', Auth::id())->get();

    // Hitung total
    $total = $carts->sum(function($cart) {
        return $cart->product->discount_price * $cart->quantity;
    });

    // Buat order baru
    $order = Order::create([
        'user_id' => Auth::id(),
        'shipping_method' => $request->shipping_method,
        'payment_method' => $request->payment_method,
        'status' => 'Menunggu',
        'order_number' => 'ORD-' . strtoupper(uniqid()),
        'total_amount' => $total,
        'shipping_address' => Auth::user()->address,
    ]);

    // Simpan semua item ke order_items
foreach ($carts as $cart) {
    OrderItem::create([
        'order_id' => $order->id,
        'product_id' => $cart->product_id,
        'quantity' => $cart->quantity,
        'price' => $cart->product->discount_price,
    ]);

    // Kurangi stok produk
    $product = Product::find($cart->product_id);
    if ($product) {
        $product->stock -= $cart->quantity;
        $product->save();
    }
}

    // (Opsional) Kosongkan cart user setelah checkout
    Cart::where('user_id', Auth::id())->delete();

return redirect()->route('status.order')
    ->with('success', 'Pesanan berhasil dibuat!')
    ->with('order_id', $order->id);
}
}