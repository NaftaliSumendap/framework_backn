<?php
namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        // Data lain bisa ditambahkan di sini
        return view('dashboard.dashboard', compact('totalUsers'));
    }
}