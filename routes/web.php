<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Models\Product;
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
    return view('layouts.main', ['products' => $products]);
})->name('homepage');

// Admin Panel (hanya role 1 = Admin)
Route::middleware(['auth', 'role:1'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin-page.dashboard.index');
        })->name('dashboard');

        Route::resource('categories', CategoryController::class)->except(['show']);
        // nanti kita isi:
        // Route::resource('products', ProductAdminController::class);
        // Route::resource('categories', CategoryAdminController::class);
        // Route::resource('users', UserAdminController::class)->except(['show']);
    });