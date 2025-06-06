<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
{
    $totalUsers = User::count();
    $recentOrders = Order::with('user')
        ->orderByDesc('created_at')
        ->take(5)
        ->get();
    $totalOrders = Order::sum('total_amount');

    $totalTransaction = DB::table('orders')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->select(DB::raw('SUM(products.discount_price * orders.total_amount) as total'))
        ->value('total');

    return view('dashboard.dashboard', [
        'totalUsers' => $totalUsers,
        'recentOrders' => $recentOrders,
        'totalOrders' => $totalOrders,
        'totalTransaction' => $totalTransaction,
    ]);
}
}