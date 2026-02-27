@extends('layouts.main')

@section('title', 'Checkout - KlikkuStore')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h1 class="h3 fw-bold mb-1">Checkout</h1>
        <p class="text-secondary mb-0">Isi data penerima dan konfirmasi pesanan.</p>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM NYA DIKELILINGI SEMUA (kiri + kanan) --}}
    <form method="POST" action="{{ route('checkout.store') }}">
        @csrf

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Data Penerima</h5>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control"
                                value="{{ old('name', auth()->user()->name) }}"
                                name="name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control"
                                value="{{ old('email', auth()->user()->email) }}"
                                name="email" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No. WhatsApp</label>
                            <input type="text" class="form-control"
                                value="{{ old('phone', auth()->user()->phone) }}"
                                name="phone" placeholder="08xxxxxxxxxx" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" rows="4" name="address" required
                                placeholder="Masukkan alamat lengkap...">{{ old('address', auth()->user()->address) }}</textarea>
                        </div>

                        <div class="alert alert-light border mb-0">
                            Data ini akan disimpan ke profile supaya checkout berikutnya otomatis terisi.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm sticky-top" style="top: 90px;">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>

                        <div class="mb-3">
                            @foreach ($cart as $item)
                                @php
                                    $qty = (int) ($item['qty'] ?? ($item['quantity'] ?? 1));
                                    $price = (float) ($item['price'] ?? 0);
                                @endphp
                                <div class="d-flex justify-content-between small mb-2">
                                    <div>
                                        {{ $item['name'] }}
                                        <span class="text-secondary">x{{ $qty }}</span>
                                    </div>
                                    <div>Rp {{ number_format($price * $qty, 0, ',', '.') }}</div>
                                </div>
                            @endforeach
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total</span>
                            <span class="text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3">
                            Buat Pesanan
                        </button>

                        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                            Kembali ke Keranjang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection