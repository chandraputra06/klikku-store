<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - KlikkuStore</title>

    <link rel="icon" type="image/png" href="{{ asset('images/klikku-logo.png') }}">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-3">
                        <a href="{{ route('homepage') }}" class="text-decoration-none">
                            <img src="{{ asset('images/klikku-logo.png') }}" alt="KlikkuStore" style="height:56px;width:auto;">
                        </a>
                    </div>

                    <h1 class="h4 fw-bold text-center mb-1">Buat Akun</h1>
                    <p class="text-center text-secondary mb-4">Daftar untuk mulai belanja di KlikkuStore</p>

                    {{-- Error message --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <div class="fw-semibold mb-1">Ada yang perlu diperbaiki:</div>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('auth.register') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                required
                                autofocus
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                                minlength="6"
                            >
                            <div class="form-text">Minimal 6 karakter.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Konfirmasi Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                required
                                minlength="6"
                            >
                        </div>

                        <button class="btn btn-primary w-100" type="submit">
                            Daftar
                        </button>

                        <div class="text-center mt-3">
                            <span class="text-secondary">Sudah punya akun?</span>
                            <a href="{{ route('auth.login-page') }}" class="text-decoration-none">Login</a>
                        </div>

                        <div class="text-center mt-2">
                            <a href="{{ route('homepage') }}" class="text-decoration-none">← Kembali ke beranda</a>
                        </div>
                    </form>

                </div>
            </div>

            <p class="text-center text-secondary small mt-3 mb-0">
                &copy; {{ date('Y') }} KlikkuStore
            </p>
        </div>
    </div>
</div>

</body>
</html>
