<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Show admin dashboard with statistics
     */
    public function index()
    {
        // Total products
        $totalProducts = Product::count();

        // Total sellers (users with role 'seller')
        $totalSellers = User::where('role', 'seller')->count();

        // Total users
        $totalUsers = User::where('role', '!=', 'admin')->count();


        // Total visitors - dari session atau logs
        // Untuk sekarang menggunakan placeholder yang bisa diperluas
        $totalVisitors = 0; // Bisa diimplementasikan dengan tracking session/logs

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalSellers',
            'totalUsers',
            'totalVisitors'
        ));
    }
}
