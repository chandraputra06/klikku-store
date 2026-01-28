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

{{-- Sidebar Offcanvas (PINDAHKAN KE ATAS NAVBAR) --}}
<div class="offcanvas offcanvas-start show border-end"
     data-bs-scroll="true"
     data-bs-backdrop="false"
     tabindex="-1"
     id="adminSidebar"
     aria-labelledby="adminSidebarLabel"
     style="width: 260px;">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold" id="adminSidebarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-0">
        <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action {{ $is('admin.dashboard') }}"
               href="{{ route('admin.dashboard') }}">Dashboard</a>

            <a class="list-group-item list-group-item-action {{ $is('admin.products.*') }}"
               href="{{ route('admin.products.index') }}">Products</a>

            <a class="list-group-item list-group-item-action {{ $is('admin.categories.*') }}"
               href="{{ route('admin.categories.index') }}">Categories</a>

            <a class="list-group-item list-group-item-action {{ $is('admin.users.*') }}"
               href="{{ route('admin.users.index') }}">Users</a>
        </div>
    </div>
</div>

{{-- Navbar (tetap pakai admin-shell) --}}
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top admin-shell">
    <div class="container-fluid">
        <button class="btn btn-outline-secondary me-2"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#adminSidebar"
                aria-controls="adminSidebar">
            ☰
        </button>

        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/klikku-logo.png') }}" alt="Klikku" style="height:28px;width:auto;">
            <span>Admin KlikkuStore</span>
        </a>

        <div class="d-flex align-items-center gap-2 ms-auto">
            <span class="text-secondary small d-none d-md-inline">
                Hi, <span class="fw-semibold">{{ auth()->user()->name }}</span>
            </span>

            <a href="{{ route('homepage') }}" class="btn btn-outline-secondary btn-sm">Ke Beranda</a>

            <form method="POST" action="{{ route('auth.logout') }}" class="mb-0">
                @csrf
                <button class="btn btn-outline-danger btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>

{{-- Content (TETAP ADMIN-CONTENT, tidak diubah) --}}
<div class="admin-content p-4">
    @yield('content')
</div>

</body>

</html>
