<div class="table-responsive">
    <table class="table align-middle mb-0">
        <thead>
            <tr>
                <th style="width:70px;">#</th>
                <th style="width:90px;">Gambar</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th style="width:180px;" class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>

                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="rounded border"
                                 style="width:64px;height:64px;object-fit:cover;">
                        @else
                            <div class="rounded bg-secondary-subtle border d-flex align-items-center justify-content-center"
                                 style="width:64px;height:64px;">
                                <span class="text-secondary small">No Img</span>
                            </div>
                        @endif
                    </td>

                    <td class="fw-semibold">{{ $product->name }}</td>

                    <td class="text-secondary">
                        {{ $product->category?->name ?? '-' }}
                    </td>

                    <td class="text-primary fw-semibold">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>

                    <td>
                        @if($product->stock_quantity <= 0)
                            <span class="badge text-bg-danger">Habis</span>
                        @else
                            <span class="badge text-bg-success">Ready</span>
                        @endif
                        <div class="small text-secondary">({{ $product->stock_quantity }})</div>
                    </td>

                    <td class="text-end">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-primary">
                            Edit
                        </a>

                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Yakin hapus product ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-secondary py-4">
                        Belum ada produk.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
