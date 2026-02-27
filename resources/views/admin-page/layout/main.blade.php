<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin - KlikkuStore')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/klikku-logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

@php
    $is = fn($name) => request()->routeIs($name) ? 'active' : '';
@endphp

<div class="d-flex">
    {{-- Sidebar --}}
    <aside class="bg-white border-end d-flex flex-column"
           style="width: 260px; min-height: 100vh;">
        
        {{-- Top: Logo + user --}}
        <div class="p-3 border-bottom">
            <div class="d-flex align-items-center gap-2 mb-2">
                <img src="{{ asset('images/klikku-logo.png') }}" alt="Klikku" style="height:32px;width:auto;">
                <div class="fw-bold">KlikkuStore</div>
            </div>
            <div class="small text-secondary">Login sebagai</div>
            <div class="fw-semibold">{{ auth()->user()->name }}</div>
        </div>

        {{-- Menu --}}
        <div class="p-3 flex-grow-1">
            <div class="small text-uppercase text-secondary mb-2">Menu</div>

            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action {{ $is('admin.dashboard') }}"
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>

                <a class="list-group-item list-group-item-action {{ $is('admin.products.*') }}"
                   href="{{ route('admin.products.index') }}">
                    <i class="bi bi-box-seam me-2"></i> Products
                </a>

                <a class="list-group-item list-group-item-action {{ $is('admin.categories.*') }}"
                   href="{{ route('admin.categories.index') }}">
                    <i class="bi bi-tags me-2"></i> Categories
                </a>

                <a class="list-group-item list-group-item-action {{ $is('admin.users.*') }}"
                   href="{{ route('admin.users.index') }}">
                    <i class="bi bi-people me-2"></i> Users
                </a>
            </div>
        </div>

        {{-- Bottom actions --}}
        <div class="p-3 border-top d-grid gap-2">
            <a href="{{ route('homepage') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-house-door me-1"></i> Beranda
            </a>

            <form method="POST" action="{{ route('auth.logout') }}">
                @csrf
                <button class="btn btn-outline-danger btn-sm w-100">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Content --}}
    <main class="flex-grow-1 p-4" style="min-width: 0;">
        @yield('content')
    </main>
</div>

</body>
</html>