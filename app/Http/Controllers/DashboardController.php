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
    $totalOrders = Order::count();

    $totalTransaction = Order::sum('total_amount');

    return view('dashboard.dashboard', [
        'totalUsers' => $totalUsers,
        'recentOrders' => $recentOrders,
        'totalOrders' => $totalOrders,
        'totalTransaction' => $totalTransaction,
    ]);
}
}