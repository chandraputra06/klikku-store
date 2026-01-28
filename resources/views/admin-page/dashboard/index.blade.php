@extends('admin-page.layout.main')

@section('title', 'Dashboard - Admin KlikkuStore')

@section('content')
@php
    use App\Models\Product;
    use App\Models\User;
    use App\Models\Category;

    $totalProducts = Product::count();
    $outOfStock = Product::where('stock_quantity', '<=', 0)->count();
    $totalUsers = User::count();
    $totalCategories = Category::count();
@endphp

<div class="d-flex align-items-end justify-content-between flex-wrap gap-2 mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Dashboard</h1>
        <p class="text-secondary mb-0">Ringkasan data KlikkuStore.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="text-secondary small">Total Products</div>
                <div class="h3 fw-bold mb-0">{{ $totalProducts }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="text-secondary small">Out of Stock</div>
                <div class="h3 fw-bold mb-0">{{ $outOfStock }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="text-secondary small">Categories</div>
                <div class="h3 fw-bold mb-0">{{ $totalCategories }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="text-secondary small">Users</div>
                <div class="h3 fw-bold mb-0">{{ $totalUsers }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mt-4">
    <div class="card-body">
        <div class="fw-semibold mb-1">Next step</div>
        <div class="text-secondary">
            Lanjut bikin ringkasan produk terbaru & stok menipis + shortcut ke menu Products/Categories/Users.
        </div>
    </div>
</div>
@endsection
