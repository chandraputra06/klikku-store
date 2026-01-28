<form class="mb-3" method="GET" action="{{ route('admin.products.index') }}">
    <div class="row g-2 align-items-center">
        <div class="col-md-6 col-lg-4">
            <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control" placeholder="Cari produk...">
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </div>
        <div class="col-auto">
            <a class="btn btn-outline-secondary" href="{{ route('admin.products.index') }}">Reset</a>
        </div>
    </div>
</form>

