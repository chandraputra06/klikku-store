@extends('admin-page.layout.main')

@section('title', 'Dashboard - Admin KlikkuStore')

@section('content')
<div class="d-flex align-items-end justify-content-between flex-wrap gap-2 mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Dashboard</h1>
        <p class="text-secondary mb-0">Ringkasan data KlikkuStore.</p>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-sm">+ Product</a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">Categories</a>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">Users</a>
    </div>
</div>

{{-- Stat cards --}}
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

<div class="row g-4 mt-1">
    {{-- Latest Products --}}
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="fw-semibold">Produk Terbaru</div>
                    <a href="{{ route('admin.products.index') }}" class="small text-decoration-none">Lihat semua</a>
                </div>

                @if($latestProducts->isEmpty())
                    <div class="text-secondary small">Belum ada produk.</div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th class="text-end">Harga</th>
                                    <th class="text-end">Stok</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestProducts as $p)
                                    <tr>
                                        <td class="fw-semibold">{{ $p->name }}</td>
                                        <td class="text-secondary">
                                            {{ $p->category?->name ?? '-' }}
                                        </td>
                                        <td class="text-end">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                                        <td class="text-end">
                                            @if($p->stock_quantity <= 0)
                                                <span class="badge text-bg-danger">Habis</span>
                                            @elseif($p->stock_quantity <= 5)
                                                <span class="badge text-bg-warning">Menipis ({{ $p->stock_quantity }})</span>
                                            @else
                                                <span class="badge text-bg-success">{{ $p->stock_quantity }}</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.products.edit', $p->id) }}" class="btn btn-sm btn-outline-primary">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Low Stock --}}
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="fw-semibold">Stok Menipis</div>
                    <a href="{{ route('admin.products.index') }}?q=" class="small text-decoration-none">Kelola produk</a>
                </div>

                @if($lowStockProducts->isEmpty())
                    <div class="text-secondary small">Tidak ada stok menipis 🎉</div>
                @else
                    <div class="list-group list-group-flush">
                        @foreach($lowStockProducts as $p)
                            <div class="list-group-item px-0">
                                <div class="d-flex align-items-start justify-content-between gap-2">
                                    <div>
                                        <div class="fw-semibold">{{ $p->name }}</div>
                                        <div class="small text-secondary">
                                            {{ $p->category?->name ?? 'Tanpa kategori' }}
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <div class="badge text-bg-warning">Stok: {{ $p->stock_quantity }}</div>
                                        <div class="mt-2">
                                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.products.edit', $p->id) }}">
                                                Restock
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <hr class="my-4">

                <div class="row g-2">
                    <div class="col-12">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-primary w-100">
                            Buka Products
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary w-100">
                            Categories
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary w-100">
                            Users
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection