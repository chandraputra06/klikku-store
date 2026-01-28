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

// Admin Panel (hanya role 1 = Admin)
Route::middleware(['auth', 'role:1'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            $totalProducts = Product::count();
            $outOfStock = Product::where('stock_quantity', '<=', 0)->count();
            $totalUsers = User::count();
            $totalCategories = Category::count();

            return view('admin-page.dashboard.index', compact(
                'totalProducts',
                'outOfStock',
                'totalUsers',
                'totalCategories'
            ));
        })->name('dashboard');

        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('products', ProductController::class)->except(['show']);
        Route::resource('users', UserController::class)->except(['show']);
        // nanti kita isi:
        // Route::resource('products', ProductAdminController::class);
        // Route::resource('categories', CategoryAdminController::class);
        // Route::resource('users', UserAdminController::class)->except(['show']);
    });