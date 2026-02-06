<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('auth.login-page');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register-page');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('auth.logout');

Route::get('/', function () {
    $products = Product::latest()->take(8)->get();
    return view('pages.home', ['products' => $products]); 
    // return view('layouts.main', ['products' => $products]);
})->name('homepage');

Route::get('/products', [ShopController::class, 'index'])->name('shop.products.index');
Route::get('/products/{product}', [ShopController::class, 'show'])->name('shop.products.show');

Route::view('/about', 'pages.about')->name('about');

// Admin page (hanya role 1 = Admin)
Route::middleware(['auth', 'role:1'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
        $totalProducts = Product::count();
        $outOfStock = Product::where('stock_quantity', '<=', 0)->count();
        $totalUsers = User::count();
        $totalCategories = Category::count();

        $latestProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        $lowStockProducts = Product::with('category')
            ->where('stock_quantity', '>', 0)
            ->where('stock_quantity', '<=', 5) // alert untuk stok menipis
            ->orderBy('stock_quantity')
            ->take(5)
            ->get();

        return view('admin-page.dashboard.index', compact(
            'totalProducts',
            'outOfStock',
            'totalUsers',
            'totalCategories',
            'latestProducts',
            'lowStockProducts'
        ));
    })->name('dashboard');

        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('products', ProductController::class)->except(['show']);
        Route::resource('users', UserController::class)->except(['show']);
    });