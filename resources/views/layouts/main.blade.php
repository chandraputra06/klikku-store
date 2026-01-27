<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Klikku Store</title>
    <link rel="icon" type="image/png" href="images/klikku-logo.png">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-body">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/">
            <img
                src="images/klikku-logo.png"
                alt="Klikku Store"
                class="brand-logo"
            >
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain"
            aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="#home">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#products">Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="#why">Tentang Kami</a></li>
            </ul>

            <form class="d-flex gap-2" role="search" action="#" method="GET">
                <input class="form-control" type="search" name="q" placeholder="Cari produk..." aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>

            <div class="d-flex gap-2 ms-lg-3 mt-3 mt-lg-0">
                <a href="#" class="btn btn-outline-secondary">Masuk</a>
                <a href="#" class="btn btn-primary">Daftar</a>
            </div>
        </div>
    </div>
</nav>

<!-- Hero -->
<header id="home" class="py-5">
    <div class="container py-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-sm">
                    Belanja cepat, aman, dan hemat di <span class="text-primary">KlikkuStore</span>
                </h1>
                <p class="lead text-secondary mt-3">
                    Temukan kebutuhan harian sampai gadget terbaru. Pengiriman cepat dan harga bersaing.
                </p>
                <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
                    <a href="#products" class="btn btn-primary btn-lg">Lihat Produk</a>
                    <a href="#why" class="btn btn-outline-secondary btn-lg">Kenapa Klikku?</a>
                </div>

                <div class="d-flex gap-4 mt-4 text-secondary">
                    <div>
                        <div class="fw-bold text-dark">{{ $products->count() }}</div>
                        <div class="small">Produk ditampilkan</div>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">24/7</div>
                        <div class="small">Support</div>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">Aman</div>
                        <div class="small">Pembayaran</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="p-4 bg-body-tertiary">
                        <img
                            src="images/logo-klikku.png"
                            alt="Hero Image"
                            class="hero-img img-fluid"
                        >
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-6">
                        <div class="p-3 bg-white border rounded-3 h-100">
                            <div class="fw-semibold">Pengiriman Cepat</div>
                            <div class="small text-secondary">Estimasi 1–3 hari</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-white border rounded-3 h-100">
                            <div class="fw-semibold">Gratis Ongkir</div>
                            <div class="small text-secondary">S&K berlaku</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>

<!-- Why -->
<section id="why" class="py-5 bg-light border-top border-bottom">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Kenapa belanja di KlikkuStore?</h2>
            <p class="text-secondary mb-0">Fitur penting yang bikin belanja lebih nyaman.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text">
                        <div class="badge text-bg-primary mb-3">Cepat</div>
                        <h5 class="fw-bold">Checkout Simpel</h5>
                        <p class="text-secondary mb-0">Proses belanja ringkas dan mudah untuk dipahami.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="badge text-bg-success mb-3">Aman</div>
                        <h5 class="fw-bold">Transaksi aman</h5>
                        <p class="text-secondary mb-0">Pembayaran aman dengan banyak metode.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="badge text-bg-warning mb-3">Hemat</div>
                        <h5 class="fw-bold">Promo rutin</h5>
                        <p class="text-secondary mb-0">Diskon dan voucher untuk produk tertentu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products -->
<section id="products" class="py-5">
    <div class="container">
        <div class="d-flex align-items-end justify-content-between flex-wrap gap-2 mb-4">
            <div>
                <h2 class="fw-bold mb-1">Produk Terbaru</h2>
                <p class="text-secondary mb-0">Berikut beberapa produk terbaru dari toko kami.</p>
            </div>
            <a href="#" class="btn btn-outline-secondary">Lihat Semua</a>
        </div>

        @if($products->isEmpty())
            <div class="alert alert-warning mb-0">
                Belum ada produk. Coba tambahkan produk dulu lewat seeder atau endpoint API.
            </div>
        @else
            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-sm-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="ratio ratio-1x1 bg-secondary-subtle rounded-top"></div>

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start gap-2">
                                    <h6 class="fw-bold mb-1">{{ $product->name }}</h6>

                                    @if($product->stock_quantity <= 0)
                                        <span class="badge text-bg-danger">Habis</span>
                                    @else
                                        <span class="badge text-bg-success">Ready</span>
                                    @endif
                                </div>

                                <div class="text-primary fw-semibold mt-2">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>

                                <div class="small text-secondary mt-1">
                                    Stok: {{ $product->stock_quantity }}
                                </div>
                            </div>

                            <div class="card-footer bg-white border-0 pt-0 pb-3 px-3">
                                <button class="btn btn-primary w-100" {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- CTA -->
<section class="py-5">
    <div class="container">
        <div class="p-5 rounded-4 bg-primary text-white">
            <div class="row align-items-center g-3">
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-1">Siap belanja lebih mudah?</h3>
                    <p class="mb-0 opacity-75">Daftar sekarang dan dapatkan voucher untuk pengguna baru.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="#" class="btn btn-light btn-lg">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="border-top bg-white">
    <div class="container py-4">
        <div class="row g-3 align-items-center">
            <div class="col-md-6 text-secondary">
                <div class="fw-semibold text-dark">KlikkuStore</div>
                <div class="small">Belanja cepat, aman, dan hemat.</div>
            </div>
            <div class="col-md-6 text-md-end small text-secondary">
                &copy; 2026 KlikkuStore. All rights reserved.
            </div>
        </div>
    </div>
</footer>
</body>
</html>
