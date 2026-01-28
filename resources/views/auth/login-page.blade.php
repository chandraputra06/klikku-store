<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - KlikkuStore</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <div class="text-center mb-3">
            <img src="{{ asset('images/klikku-logo.png') }}" alt="Klikku" style="height:48px;width:auto;">
          </div>

          <h1 class="h4 fw-bold text-center mb-4">Masuk</h1>

          <form method="POST" action="{{ route('auth.login') }}">
            @csrf

            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100" type="submit">Masuk</button>
          </form>

          <div class="text-center mt-3">
            <a href="{{ route('homepage') }}" class="text-decoration-none">← Kembali ke beranda</a>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
