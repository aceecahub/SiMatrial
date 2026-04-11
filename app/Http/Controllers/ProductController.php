<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();
            
        $categories = \App\Models\Category::all();
        return view('pages.products.index', compact('products', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'unit' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'price_sell' => 'required|numeric|min:0',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $id,
            'category_id' => 'required|exists:categories,id',
            'unit' => 'required|string|max:50',
            'price_sell' => 'required|numeric|min:0',
        ]);

        $product->update($request->except('stock')); // Stock updated via separate modal usually

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function addStock(Request $request, string $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($id);
        $product->increment('stock', $request->qty);

        return redirect()->route('products.index')->with('success', "Stok {$product->name} berhasil ditambah.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
