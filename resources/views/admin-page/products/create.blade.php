@extends('admin-page.layout.main')

@section('title', 'Tambah Product - Admin')

@section('content')
<div class="d-flex align-items-end justify-content-between flex-wrap gap-2 mb-3">
    <div>
        <h1 class="h3 fw-bold mb-1">Tambah Product</h1>
        <p class="text-secondary mb-0">Tambah produk baru.</p>
    </div>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Kembali</a>
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
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Product</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select">
                        <option value="">- Pilih Kategori -</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Harga</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price') }}" min="0" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity') }}" min="0" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Gambar (opsional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <div class="form-text">JPG/PNG/WEBP, maks 2MB.</div>
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

