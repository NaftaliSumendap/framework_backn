<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        // Data lain bisa ditambahkan di sini
        return view('dashboard.dashboard', [
        'totalUsers' => User::count(),
        'recentOrders' => Order::with('user')
            ->orderByDesc('created_at')
            ->take(5)
            ->get(),
        'totalOrders' => Order::count(),
        ]);
    }
}