@extends('admin-page.layout.main')

@section('title', 'Products - Admin')

@section('content')
<div class="d-flex align-items-end justify-content-between flex-wrap gap-2 mb-3">
    <div>
        <h1 class="h3 fw-bold mb-1">Products</h1>
        <p class="text-secondary mb-0">Kelola produk toko.</p>
    </div>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        + Tambah Product
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@include('admin-page.products.partials.filter')

<div class="card border-0 shadow-sm">
    <div class="card-body">
        @include('admin-page.products.partials.table')
    </div>
</div>

<div class="mt-3">
    {{ $products->links() }}
</div>
@endsection

