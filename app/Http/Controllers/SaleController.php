<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $sales = \App\Models\Sale::with('details.product')
            ->when($search, function ($query, $search) {
                return $query->where('type', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();
            
        $products = Product::where('stock', '>', 0)->get();
        return view('pages.sales.index', compact('sales', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:diambil,diantar',
            'shipping_cost' => 'nullable|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        return \DB::transaction(function () use ($request) {
            $total_price = 0;
            $sale_items = [];

            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);
                
                if ($product->stock < $item['qty']) {
                    throw new \Exception("Stok {$product->name} tidak cukup.");
                }

                $subtotal = $product->price_sell * $item['qty'];
                $total_price += $subtotal;

                $sale_items[] = [
                    'product_id' => $product->id,
                    'qty' => $item['qty'],
                    'price' => $product->price_sell,
                    'subtotal' => $subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $product->decrement('stock', $item['qty']);
            }

            $shipping_cost = $request->type === 'diantar' ? ($request->shipping_cost ?? 0) : 0;
            $total_price += $shipping_cost;

            $sale = \App\Models\Sale::create([
                'type' => $request->type,
                'shipping_cost' => $shipping_cost,
                'total_price' => $total_price,
            ]);

            foreach ($sale_items as &$item) {
                $item['sale_id'] = $sale->id;
            }

            \App\Models\SaleDetail::insert($sale_items);

            return redirect()->route('sales.index')->with('success', 'Transaksi berhasil disimpan.');
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return \DB::transaction(function () use ($id) {
            $sale = \App\Models\Sale::with('details')->findOrFail($id);

            foreach ($sale->details as $detail) {
                Product::findOrFail($detail->product_id)->increment('stock', $detail->qty);
            }

            $sale->delete();

            return redirect()->route('sales.index')->with('success', 'Transaksi berhasil dihapus dan stok dikembalikan.');
        });
    }
}
