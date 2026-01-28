@extends('admin-page.layouts.main')

@section('title', 'Dashboard - Admin KlikkuStore')

@section('content')
@php
    use App\Models\Product;
    use App\Models\User;
    use App\Models\Category;

    $totalProducts = class_exists(Product::class) ? Product::count() : 0;
    $outOfStock = class_exists(Product::class) ? Product::where('stock_quantity', '<=', 0)->count() : 0;
    $totalUsers = class_exists(User::class) ? User::count() : 0;
    $totalCategories = class_exists(Category::class) ? Category::count() : 0;
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
            Setelah ini kita sambungkan menu sidebar dan bikin CRUD Categories → Products → Users.
        </div>
    </div>
</div>
@endsection
