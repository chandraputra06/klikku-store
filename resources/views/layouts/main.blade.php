<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'KlikkuStore')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/klikku-logo.png') }}">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-body">

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('homepage') }}">
            <img src="{{ asset('images/klikku-logo.png') }}" alt="Klikku Store" class="brand-logo">
            <span class="fs-5">Klikku<span class="text-primary">Store</span></span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain"
            aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('homepage') ? 'active' : '' }}"
                       href="{{ request()->routeIs('homepage') ? '#home' : route('homepage').'#home' }}">
                        Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('shop.products.*') ? 'active' : '' }}"
                       href="{{ route('shop.products.index') }}">
                        Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ request()->routeIs('homepage') ? '#why' : route('homepage').'#why' }}">
                        Tentang Kami
                    </a>
                </li>
            </ul>

            <form class="d-flex gap-2" role="search" method="GET" action="{{ route('shop.products.index') }}">
                <input class="form-control" type="search" name="q" value="{{ request('q') }}"
                       placeholder="Cari produk..." aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>

            <div class="d-flex gap-2 ms-lg-3 mt-3 mt-lg-0 align-items-center">
                @auth
                    @if((string) auth()->user()->role === '1')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">Admin</a>
                    @endif

                    <span class="text-secondary small d-none d-lg-inline">
                        Hi, <span class="fw-semibold">{{ auth()->user()->name }}</span>
                    </span>

                    <form method="POST" action="{{ route('auth.logout') }}" class="mb-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                @else
                    <a href="{{ route('auth.login-page') }}" class="btn btn-outline-secondary">Masuk</a>
                    <a href="{{ route('auth.register-page') }}" class="btn btn-primary">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

{{-- Content --}}
@yield('content')

{{-- Footer --}}
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
