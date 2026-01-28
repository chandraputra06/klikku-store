<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1 class="h3 fw-bold mb-0">Dashboard Admin</h1>

      <form method="POST" action="{{ route('auth.logout') }}">
        @csrf
        <button class="btn btn-outline-danger">Logout</button>
      </form>
    </div>

    <div class="alert alert-success">
      Kamu berhasil masuk sebagai admin ✅
    </div>
  </div>
</body>
</html>
