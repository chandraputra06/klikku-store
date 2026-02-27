@extends('layouts.main')

@section('title', 'Keranjang - KlikkuStore')

@section('content')
    <div class="container py-4">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <div>
                <h1 class="h3 fw-bold mb-1 d-flex align-items-center gap-2">
                    <i class="bi bi-cart3 text-primary"></i>
                    Keranjang Belanja
                </h1>
                <p class="text-secondary mb-0">Cek dan atur produk sebelum checkout.</p>
            </div>

            <a href="{{ route('shop.products.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-1"></i> Lanjut Belanja
            </a>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <div class="fw-semibold mb-1">Terjadi kesalahan:</div>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Empty cart --}}
        @if (empty($cart))
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-cart-x fs-1 text-secondary"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Keranjang masih kosong</h5>
                    <p class="text-secondary mb-4">Yuk pilih produk favoritmu dulu.</p>
                    <a href="{{ route('shop.products.index') }}" class="btn btn-primary">
                        <i class="bi bi-bag me-1"></i> Lihat Produk
                    </a>
                </div>
            </div>
        @else
            <div class="row g-4">
                {{-- List cart items --}}
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <div class="fw-semibold">Item di Keranjang</div>
                        </div>

                        <div class="card-body p-0">
                            @foreach ($cart as $item)
                                <div class="p-3 p-md-4 border-top {{ $loop->first ? 'border-top-0' : '' }}">
                                    <div class="row g-3 align-items-center">
                                        {{-- Image --}}
                                        <div class="col-12 col-md-2">
                                            <div class="rounded border bg-light d-flex align-items-center justify-content-center"
                                                style="width: 100%; aspect-ratio: 1/1; overflow: hidden;">
                                                @if (!empty($item['image']))
                                                    <img src="{{ asset('storage/' . $item['image']) }}"
                                                        alt="{{ $item['name'] }}" class="img-fluid w-100 h-100"
                                                        style="object-fit: cover;">
                                                @else
                                                    <i class="bi bi-image text-secondary fs-4"></i>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Info --}}
                                        <div class="col-12 col-md-4">
                                            <div class="fw-semibold">{{ $item['name'] }}</div>
                                            <div class="small text-secondary mt-1">
                                                Stok tersedia: {{ $item['stock'] ?? '-' }}
                                            </div>
                                            <div class="small text-primary fw-semibold mt-1">
                                                Rp {{ number_format($item['price'], 0, ',', '.') }}
                                            </div>
                                        </div>

                                        {{-- Qty update --}}
                                        <div class="col-12 col-md-3">
                                            <form method="POST" action="{{ route('cart.update', $item['id']) }}">
                                                @csrf
                                                @method('PUT')

                                                <label class="form-label small text-secondary mb-1">Qty</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="number" name="qty" min="1"
                                                        max="{{ (int) ($item['stock'] ?? 999) }}"
                                                        value="{{ $item['qty'] ?? ($item['quantity'] ?? 1) }}"
                                                        class="form-control">
                                                    <button class="btn btn-outline-primary" type="submit">
                                                        Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>

                                        {{-- Subtotal --}}
                                        <div class="col-8 col-md-2">
                                            <div class="small text-secondary">Subtotal</div>
                                            <div class="fw-bold">
                                                @php
                                                    $itemQty = (int) ($item['qty'] ?? ($item['quantity'] ?? 1));
                                                @endphp
                                                Rp {{ number_format($item['price'] * $itemQty, 0, ',', '.') }}
                                            </div>
                                        </div>

                                        {{-- Remove --}}
                                        <div class="col-4 col-md-1 text-end">
                                            <form method="POST" action="{{ route('cart.destroy', $item['id']) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Summary --}}
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm sticky-top" style="top: 90px;">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Ringkasan Belanja</h5>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary">Total Item</span>
                                <span>{{ collect($cart)->sum('qty') }}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-secondary">Total Harga</span>
                                <span class="fw-bold text-primary">
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>

                            <hr>

                            <div class="d-grid gap-2">
                                {{-- sementara link checkout, nanti kita sambung --}}
                                <a href="{{ route('checkout.index') }}" class="btn btn-primary">
                                    <i class="bi bi-credit-card me-1"></i> Checkout
                                </a>

                                <form method="POST" action="{{ route('cart.clear') }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-secondary w-100">
                                        <i class="bi bi-x-circle me-1"></i> Kosongkan Keranjang
                                    </button>
                                </form>
                            </div>

                            <p class="small text-secondary mt-3 mb-0">
                                Pastikan jumlah item sudah sesuai sebelum checkout.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
