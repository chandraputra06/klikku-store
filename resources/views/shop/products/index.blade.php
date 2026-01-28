@extends('layouts.main')

@section('title', 'Produk - KlikkuStore')

@section('content')
<div class="container py-5">
    <div class="d-flex align-items-end justify-content-between flex-wrap gap-2 mb-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Semua Produk</h1>
            <p class="text-secondary mb-0">Cari dan lihat semua produk KlikkuStore.</p>
        </div>

        <form class="d-flex gap-2" method="GET" action="{{ route('shop.products.index') }}">
            <input class="form-control" type="search" name="q" value="{{ $q ?? '' }}" placeholder="Cari produk...">
            <button class="btn btn-outline-primary">Search</button>
        </form>
    </div>

    @if($products->isEmpty())
        <div class="alert alert-warning mb-0">Belum ada produk.</div>
    @else
        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('shop.products.show', $product) }}" class="text-decoration-none">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="ratio ratio-1x1 bg-secondary-subtle rounded-top overflow-hidden">
                                @if($product->image)
                                    <img
                                        src="{{ asset('storage/'.$product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="w-100 h-100 object-fit-cover"
                                    >
                                @endif
                            </div>

                            <div class="card-body">
                                <div class="fw-bold text-dark">{{ $product->name }}</div>

                                <div class="text-primary fw-semibold mt-1">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>

                                <div class="small text-secondary mt-1">
                                    Stok: {{ $product->stock_quantity }}
                                    @if($product->category)
                                        • {{ $product->category->name }}
                                    @endif
                                </div>

                                <div class="mt-2">
                                    @if($product->stock_quantity <= 0)
                                        <span class="badge text-bg-danger">Habis</span>
                                    @else
                                        <span class="badge text-bg-success">Ready</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
