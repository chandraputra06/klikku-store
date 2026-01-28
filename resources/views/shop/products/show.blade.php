@extends('layouts.main')

@section('title', $product->name.' - KlikkuStore')

@section('content')
<div class="container py-5">
    <a href="{{ route('shop.products.index') }}" class="text-decoration-none">&larr; Kembali</a>

    <div class="row g-4 mt-2 align-items-start">
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="ratio ratio-1x1 bg-secondary-subtle">
                    @if($product->image)
                        <img
                            src="{{ asset('storage/'.$product->image) }}"
                            alt="{{ $product->name }}"
                            class="w-100 h-100 object-fit-cover"
                        >
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <h1 class="h3 fw-bold mb-1">{{ $product->name }}</h1>

            <div class="text-secondary">
                @if($product->category)
                    Kategori: <span class="fw-semibold">{{ $product->category->name }}</span>
                @else
                    <span class="small">Tanpa kategori</span>
                @endif
            </div>

            <div class="h4 text-primary fw-bold mt-3">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>

            <div class="text-secondary mt-2">
                Stok tersedia: <span class="fw-semibold">{{ $product->stock_quantity }}</span>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-primary" {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                    Tambah ke Keranjang
                </button>
                <a href="{{ route('shop.products.index') }}" class="btn btn-outline-secondary">
                    Lanjut Belanja
                </a>
            </div>

            <hr class="my-4">

            <div class="fw-semibold">Info</div>
            <div class="text-secondary">
                Deskripsi produk bisa kamu tambahkan nanti (misal kolom <code>description</code>).
            </div>
        </div>
    </div>
</div>
@endsection
