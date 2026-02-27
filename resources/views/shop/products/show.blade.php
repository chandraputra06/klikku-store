@extends('layouts.main')

@section('title', $product->name . ' - KlikkuStore')

@section('content')
    <div class="container py-5">
        <a href="{{ route('shop.products.index') }}" class="text-decoration-none">&larr; Kembali</a>

        <div class="row g-4 mt-2 align-items-start">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="ratio ratio-1x1 bg-secondary-subtle">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-100 h-100 object-fit-cover">
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <h1 class="h3 fw-bold mb-1">{{ $product->name }}</h1>

                <div class="text-secondary">
                    @if ($product->category)
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

                <div class="mt-3">
                    <form method="POST" action="{{ route('cart.store', $product) }}">
                        @csrf

                        <div class="d-flex align-items-center gap-2 mb-3" style="max-width: 220px;">
                            <button type="button" class="btn btn-outline-secondary px-3" onclick="decreaseQty()">-</button>

                            <input type="number" id="qtyInput" name="quantity" value="1" min="1"
                                max="{{ $product->stock_quantity }}" class="form-control text-center">

                            <button type="button" class="btn btn-outline-secondary px-3"
                                onclick="increaseQty({{ $product->stock_quantity }})">+</button>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary"
                                {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                                Tambah ke Keranjang
                            </button>

                            <a href="{{ route('shop.products.index') }}" class="btn btn-outline-secondary">
                                Lanjut Belanja
                            </a>
                        </div>
                    </form>
                </div>

                <script>
                    function decreaseQty() {
                        const input = document.getElementById('qtyInput');
                        let val = parseInt(input.value || 1);
                        if (val > 1) input.value = val - 1;
                    }

                    function increaseQty(maxStock) {
                        const input = document.getElementById('qtyInput');
                        let val = parseInt(input.value || 1);
                        if (val < maxStock) input.value = val + 1;
                    }
                </script>

                <hr class="my-4">

                <div class="fw-semibold">Info</div>
                <div class="text-secondary">
                    TAMBAHIN NANTIII AAAJAJAA
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('qty-minus')) {
                const wrapper = e.target.closest('form');
                const input = wrapper.querySelector('.qty-input');
                let value = parseInt(input.value || 1, 10);
                const min = parseInt(input.min || 1, 10);

                if (value > min) {
                    input.value = value - 1;
                }
            }

            if (e.target.classList.contains('qty-plus')) {
                const wrapper = e.target.closest('form');
                const input = wrapper.querySelector('.qty-input');
                let value = parseInt(input.value || 1, 10);
                const max = parseInt(input.max || 9999, 10);

                if (value < max) {
                    input.value = value + 1;
                }
            }
        });
    </script>
@endsection
