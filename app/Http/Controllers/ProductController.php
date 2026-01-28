<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->query('q');

        $products = Product::with('category')
            ->when($q, fn($query) => $query->where('name', 'like', "%{$q}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin-page.products.index', compact('products', 'q'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin-page.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $storeProductRequest)
    {
        DB::beginTransaction();
        try {
            $data = $storeProductRequest->validated();

            if ($storeProductRequest->hasFile('image')) {
                $data['image'] = $storeProductRequest->file('image')->store('products', 'public');
            }

            Product::create($data);

            DB::commit();
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('admin.products.create')
                ->with('error', 'Gagal menambahkan product: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin-page.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $updateProductRequest, Product $product)
    {
        DB::beginTransaction();
        try {
            $data = $updateProductRequest->validated();

            if ($updateProductRequest->hasFile('image')) {
                // hapus gambar lama (jika ada)
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $data['image'] = $updateProductRequest->file('image')->store('products', 'public');
            }

            $product->update($data);

            DB::commit();
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('admin.products.edit', $product->id)
                ->with('error', 'Gagal update product: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();

            DB::commit();
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('admin.products.index')
                ->with('error', 'Gagal menghapus product: ' . $th->getMessage());
        }
    }
}
