<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Pastikan ini di-import

class OrderController extends Controller
{
    /**
     * Menampilkan halaman ringkasan transaksi (checkout).
     * Akan menampilkan item keranjang atau pesanan pending.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showCheckoutForm()
    {
        $user = Auth::user();

        // Ambil item keranjang pengguna yang sedang login
        $carts = Cart::where('user_id', $user->id)->with('product')->get();

        // Ambil pesanan yang sedang menunggu pembayaran untuk pengguna ini
        $pendingOrders = Order::where('user_id', $user->id)
                                ->where('status', 'pending')
                                ->with('orderItems.product') // Eager load order items dan produknya
                                ->get();

        // Kirim data ke view. View akan memutuskan apa yang ditampilkan.
        return view('transaksi', compact('carts', 'pendingOrders', 'user'));
    }

    /**
     * Memproses pesanan dari keranjang belanja.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processOrder(Request $request)
    {
        $user = Auth::user();

        // Validasi input dari form checkout
        // Laravel secara otomatis akan mengalihkan kembali (redirect back)
        // dengan error validasi ke halaman form jika validasi gagal.
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'shipping_method' => 'required|string|in:JNE,POS,TIKI', // Sesuaikan metode pengiriman yang Anda dukung
            'payment_method' => 'required|string|in:Transfer Bank,Kartu Kredit,E-Wallet', // Sesuaikan metode pembayaran
        ]);

        // Ambil item keranjang pengguna
        $carts = Cart::where('user_id', $user->id)->with('product')->get();

        // Jika keranjang kosong, kembalikan dengan error (redirect)
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong, tidak dapat memproses pesanan.');
        }

        DB::beginTransaction();
        try {
            // Hitung total jumlah pesanan
            $totalAmount = $carts->sum(function ($cart) {
                return $cart->product->discount_price * $cart->quantity;
            });

            // Buat nomor pesanan unik (contoh sederhana, bisa lebih kompleks)
            $orderNumber = 'ORD-' . time() . '-' . $user->id;

            // Buat entri pesanan baru di tabel 'orders'
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => $orderNumber,
                'total_amount' => $totalAmount,
                'status' => 'pending', // Status awal pesanan
                'shipping_address' => $request->shipping_address,
                'shipping_method' => $request->shipping_method,
                'payment_method' => $request->payment_method,
                'payment_status' => false, // Status pembayaran awal
            ]);

            // Tambahkan setiap item dari keranjang ke tabel 'order_items'
            foreach ($carts as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->discount_price, // Harga saat pesanan dibuat
                ]);

                // Kurangi stok produk
                $product = Product::find($cartItem->product_id);
                if ($product) {
                    $product->stock -= $cartItem->quantity;
                    $product->sold += $cartItem->quantity; // Tambahkan ke jumlah terjual
                    $product->save();
                }
            }

            // Hapus semua item dari keranjang setelah pesanan berhasil dibuat
            Cart::where('user_id', $user->id)->delete();

            DB::commit(); // Konfirmasi transaksi

            // Redirect ke halaman status pesanan dengan ID pesanan
            // Menggunakan with('order_id') agar JS bisa membaca dan memicu modal
            return redirect()->route('status.order', ['order' => $order->id])->with('success', 'Pesanan Anda berhasil dibuat!')->with('order_id', $order->id);

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan transaksi jika terjadi kesalahan
            // Log error untuk debugging
            Log::error('Gagal memproses pesanan: ' . $e->getMessage());
            // Redirect kembali dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan Anda. Silakan coba lagi.');
        }
    }

    /**
     * Menampilkan daftar semua pesanan pengguna yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function myOrders()
    {
        $user = Auth::user();
        // Ambil semua pesanan untuk pengguna yang sedang login, diurutkan dari terbaru
        // Eager load orderItems dan product agar bisa ditampilkan di view
        $orders = Order::where('user_id', $user->id)
                       ->with('orderItems.product')
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('my_orders', compact('orders')); // Akan menampilkan di file my_orders.blade.php
    }
}
