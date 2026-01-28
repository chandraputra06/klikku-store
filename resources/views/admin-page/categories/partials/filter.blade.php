<form class="mb-3" method="GET" action="{{ route('admin.categories.index') }}">
    <div class="row g-2 align-items-center">
        <div class="col-md-6 col-lg-4">
            <input
                type="text"
                name="q"
                value="{{ $q ?? '' }}"
                class="form-control"
                placeholder="Cari kategori..."
            >
        </div>

        <div class="col-auto">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </div>

        <div class="col-auto">
            <a class="btn btn-outline-secondary" href="{{ route('admin.categories.index') }}">Reset</a>
        </div>
    </div>
</form>
