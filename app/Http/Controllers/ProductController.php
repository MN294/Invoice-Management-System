<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET /products
    public function index()
    {
        $products = Product::all(); // later we can paginate
        return view('products.index', compact('products'));
    }

    // GET /products/create
    public function create()
    {
        return view('products.create');
    }

    // POST /products
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'sku'   => 'required|string|max:100|unique:products,sku',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'stock_qty' => 'required|integer|min:0',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully!');
    }

    // GET /products/{product}/edit
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // PUT/PATCH /products/{product}
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'sku'   => 'required|string|max:100|unique:products,sku,' . $product->id,
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'stock_qty' => 'required|integer|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    // DELETE /products/{product}
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted.');
    }
}
