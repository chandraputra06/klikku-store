<div class="table-responsive">
    <table class="table align-middle mb-0">
        <thead>
            <tr>
                <th style="width: 80px;">#</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th style="width: 180px;" class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td class="fw-semibold">{{ $category->name }}</td>
                    <td class="text-secondary">{{ $category->description ?: '-' }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">
                            Edit
                        </a>

                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Yakin hapus category ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-secondary py-4">
                        Belum ada kategori.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

