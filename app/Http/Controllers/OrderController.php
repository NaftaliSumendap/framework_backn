<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Import DB facade for transactions

class OrderController extends Controller
{
    /**
     * Menampilkan halaman ringkasan transaksi (checkout).
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showCheckoutForm()
    {
        $user = Auth::user();
        // Ambil item keranjang pengguna yang sedang login
        $carts = Cart::where('user_id', $user->id)->with('product')->get();

        // Jika keranjang kosong, alihkan kembali ke halaman keranjang dengan pesan error
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        // Hitung total jumlah dari semua item di keranjang
        $totalAmount = $carts->sum(function ($cart) {
            return $cart->product->discount_price * $cart->quantity;
        });

        // Kirim data ke view
        return view('transaksi', compact('carts', 'totalAmount', 'user'));
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
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'shipping_method' => 'required|string|in:JNE,POS,TIKI', // Sesuaikan metode pengiriman yang Anda dukung
            'payment_method' => 'required|string|in:Transfer Bank,Kartu Kredit,E-Wallet', // Sesuaikan metode pembayaran
        ]);

        // Ambil item keranjang pengguna
        $carts = Cart::where('user_id', $user->id)->with('product')->get();

            foreach ($carts as $cart) {
        if ($cart->quantity > $cart->product->stock) {
            return back()->with('error', 'Stok produk ' . $cart->product->name . ' tidak mencukupi.');
        }
    }

        // Jika keranjang kosong, kembalikan dengan error
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong, tidak dapat memproses pesanan.');
        }

        // Gunakan transaksi database untuk memastikan semua operasi berhasil atau tidak sama sekali
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
            return redirect()->route('status.order', ['order' => $order->id])->with('success', 'Pesanan Anda berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan transaksi jika terjadi kesalahan
            // Log error untuk debugging
            Log::error('Gagal memproses pesanan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan Anda. Silakan coba lagi.');
        }
    }

    public function update(Request $request, $id)
    {
    $order = Order::findOrFail($id);
    $order->status = $request->status;
    $order->payment_status = $request->payment_status;
    $order->save();

    return redirect()->back()->with('success', 'Status pesanan berhasil diubah!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->back()->with('success', 'Pesanan berhasil dihapus!');
    }

    public function showStatus()
{
    $orders = Order::with('orderItems.product')->where('user_id', Auth::id())->latest()->get();
    return view('status', compact('orders'));
}

public function uploadScreenshot(Request $request, $orderId)
{
    $request->validate([
        'screenshot' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $order = Order::findOrFail($orderId);

    // Simpan file ke storage/app/public/screenshots
if ($request->hasFile('screenshot')) {
    $file = $request->file('screenshot');
    $filename = $file->getClientOriginalName();
    $result = $file->storeAs('public/screenshots', $filename);
    if (!$result) {
        dd('Gagal upload file!');
    }
    $order->screenshot = $filename;
}

    $order->save();

    return back()->with('success', 'Bukti pembayaran berhasil diupload!');
}
}
