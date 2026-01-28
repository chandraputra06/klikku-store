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

<nav class="navbar navbar-expand-lg bg-white border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/klikku-logo.png') }}" alt="Klikku" style="height:28px;width:auto;">
            <span>Admin KlikkuStore</span>
        </a>

        <div class="d-flex align-items-center gap-2">
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

<div class="container-fluid">
    <div class="row">
        {{-- Sidebar --}}
        <aside class="col-lg-2 d-none d-lg-block bg-white border-end min-vh-100 p-0">
            @php
                $is = fn($name) => request()->routeIs($name) ? 'active' : '';
            @endphp

            <div class="p-3">
                <div class="text-uppercase small text-secondary mb-2">Menu</div>

                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action {{ $is('admin.dashboard') }}"
                       href="{{ route('admin.dashboard') }}">
                        Dashboard
                    </a>

                    {{-- nanti kita sambungkan ke route bener --}}
                    <a class="list-group-item list-group-item-action {{ $is('admin.products.*') }}" href="#">
                        Products
                    </a>
                    <a class="list-group-item list-group-item-action {{ $is('admin.categories.*') }}" href="#">
                        Categories
                    </a>
                    <a class="list-group-item list-group-item-action {{ $is('admin.users.*') }}" href="#">
                        Users
                    </a>
                </div>
            </div>
        </aside>

        {{-- Content --}}
        <main class="col-12 col-lg-10 p-4">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
