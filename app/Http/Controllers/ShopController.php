<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $products = Product::with('category')
            ->when($q, fn($query) => $query->where('name', 'like', "%{$q}%"))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('shop.products.index', compact('products', 'q'));
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view('shop.products.show', compact('product'));
    }
}
