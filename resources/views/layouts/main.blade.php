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



</body>
</html>
