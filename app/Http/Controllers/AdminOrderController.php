<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import Log Facade

class AdminOrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan untuk admin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua pesanan dari database, diurutkan dari yang terbaru
        // Eager load relasi user dan orderItems (dengan produknya)
        $orders = Order::with(['user', 'orderItems.product'])
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('dashboard.orders', compact('orders'));
    }

    /**
     * Memperbarui status pesanan tertentu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:pending,processing,shipped,delivered,cancelled', // Sesuaikan status yang diizinkan
        ]);

        try {
            $order->status = $request->status;
            // Jika status menjadi 'delivered', otomatis set payment_status ke true
            if ($request->status === 'delivered') {
                $order->payment_status = true;
            }
            // Jika status menjadi 'cancelled', otomatis set payment_status ke false (jika belum dibayar)
            if ($request->status === 'cancelled') {
                 $order->payment_status = false;
            }
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Status pesanan berhasil diperbarui.',
                'order' => $order->fresh(['user', 'orderItems.product']) // Mengambil data terbaru termasuk relasi
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating order status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status pesanan.'
            ], 500);
        }
    }

    /**
     * Menghapus pesanan tertentu.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Order $order)
    {
        try {
            // Hapus item-item pesanan terlebih dahulu (jika ada cascade delete di DB tidak perlu)
            // orderItems()->delete() akan menghapus semua item terkait di tabel order_items
            $order->orderItems()->delete();

            $order->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting order: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus pesanan.'
            ], 500);
        }
    }
}
