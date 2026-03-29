<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryCount = \App\Models\Category::count();
        $productCount = \App\Models\Product::count();
        $totalStock = \App\Models\Product::sum('stock');
        
        $salesToday = \App\Models\Sale::whereDate('created_at', now())->sum('total_price');
        $expensesToday = \App\Models\Expense::whereDate('created_at', now())->sum('amount');

        // Recent Transactions
        $recentSales = \App\Models\Sale::with('details.product')->latest()->take(5)->get();

        return view('dashboard', compact(
            'categoryCount', 
            'productCount', 
            'totalStock', 
            'salesToday', 
            'expensesToday',
            'recentSales'
        ));
    }
}
