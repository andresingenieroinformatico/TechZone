<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_sales' => Order::where('status', 'paid')->sum('total'),
            'orders_count' => Order::count(),
            'products_count' => Product::count(),
            'users_count' => User::count(),
            'low_stock' => Product::where('stock', '<', 5)->count(),
        ];

        // Sales for Chart.js (Last 6 months)
        $salesData = Order::select(
            DB::raw('sum(total) as aggregate'),
            DB::raw("strftime('%Y-%m', created_at) as month") // SQLite month format
        )
        ->where('status', 'paid')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->take(6)
        ->get();

        // Top Selling Products
        $topProducts = Product::withCount('seller') // Placeholder for actual sales count if I had an order_items count
            ->orderBy('stock', 'asc') // Placeholder
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'salesData', 'topProducts'));
    }
}
