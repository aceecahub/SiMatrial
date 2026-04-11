<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->get('end_date', now()->toDateString());

        $sales = Sale::with('details.product')
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->latest()
            ->get();

        $expenses = Expense::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->latest()
            ->get();

        // Total Penjualan (Revenue)
        $labaKotor = SaleDetail::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->sum('subtotal') ?? 0;

        $totalExpenses = $expenses->sum('amount');
        $labaBersih = $labaKotor - $totalExpenses;

        return view('pages.reports.index', compact('sales', 'expenses', 'labaKotor', 'totalExpenses', 'labaBersih', 'startDate', 'endDate'));
    }
}
