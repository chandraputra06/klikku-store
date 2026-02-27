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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-body">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
        <div class="container">
            {{-- Brand --}}
            <a class="navbar-brand fw-semibold d-flex align-items-center gap-2" href="{{ route('homepage') }}">
                <img src="{{ asset('images/klikku-logo.png') }}" alt="Klikku Store" class="brand-logo">
                <span class="fs-5">Klikku<span class="text-primary">Store</span></span>
            </a>

            {{-- Toggle --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain"
                aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Menu --}}
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('homepage') ? 'active' : '' }}"
                            href="{{ request()->routeIs('homepage') ? '#home' : route('homepage') . '#home' }}">
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
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                            href="{{ route('about') }}">
                            Tentang Kami
                        </a>
                    </li>
                </ul>

                {{-- Right actions --}}
                <div class="d-flex flex-column flex-lg-row gap-2 ms-lg-3 mt-3 mt-lg-0 align-items-lg-center">

                    @php
                        $cartCount = collect(session('cart', []))->sum(function ($item) {
                            return (int) ($item['qty'] ?? ($item['quantity'] ?? 0));
                        });
                    @endphp

                    {{-- Cart button (guest diarahkan ke login) --}}
                    @auth
                        <a href="{{ route('cart.index') }}"
                            class="btn btn-outline-primary d-inline-flex align-items-center gap-2">
                            <i class="bi bi-cart3"></i>

                            @if ($cartCount > 0)
                                <span class="badge rounded-pill text-bg-primary">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    @else
                        <a href="{{ route('auth.login-page') }}"
                            class="btn btn-outline-primary d-inline-flex align-items-center gap-2">
                            <i class="bi bi-cart3"></i>
                        </a>
                    @endauth

                    @auth

                        <a href="{{ route('profile.index') }}"
                            class="text-decoration-none text-secondary small d-none d-lg-inline">
                            Hi, <span class="fw-semibold">{{ auth()->user()->name }}</span>
                        </a>
                        @if ((string) auth()->user()->role === '1')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark">Admin</a>
                        @endif

                        <form method="POST" action="{{ route('auth.logout') }}" class="mb-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100">
                                Logout
                            </button>
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
