@extends('admin-page.layout.main')

@section('title', 'Users - Admin')

@section('content')
<div class="d-flex align-items-end justify-content-between flex-wrap gap-2 mb-3">
    <div>
        <h1 class="h3 fw-bold mb-1">Users</h1>
        <p class="text-secondary mb-0">Kelola user/customer & admin.</p>
    </div>

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        + Tambah User
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form class="mb-3" method="GET" action="{{ route('admin.users.index') }}">
    <div class="row g-2 align-items-center">
        <div class="col-md-6 col-lg-4">
            <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control" placeholder="Cari user...">
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </div>
        <div class="col-auto">
            <a class="btn btn-outline-secondary" href="{{ route('admin.users.index') }}">Reset</a>
        </div>
    </div>
</form>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width:80px;">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="width:120px;">Role</th>
                        <th style="width:180px;" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td class="text-secondary">{{ $user->email }}</td>
                            <td>
                                @if((string)$user->role === '1')
                                    <span class="badge text-bg-primary">Admin</span>
                                @else
                                    <span class="badge text-bg-secondary">Customer</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">
                                    Edit
                                </a>

                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Yakin hapus user ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary py-4">
                                Belum ada user.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $users->links() }}
</div>
@endsection
