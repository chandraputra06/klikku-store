@extends('admin-page.layout.main')

@section('title', 'Tambah User - Admin')

@section('content')
<div class="d-flex align-items-end justify-content-between flex-wrap gap-2 mb-3">
    <div>
        <h1 class="h3 fw-bold mb-1">Tambah User</h1>
        <p class="text-secondary mb-0">Buat akun admin atau customer.</p>
    </div>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Kembali</a>
</div>

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

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="2" {{ old('role', '2') === '2' ? 'selected' : '' }}>Customer</option>
                        <option value="1" {{ old('role') === '1' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <div class="form-text">Role 1 = Admin, Role 2 = Customer.</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
