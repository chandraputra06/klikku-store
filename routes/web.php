<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Product::latest()->take(8)->get();
    return view('layouts.main', compact('products'));
});
