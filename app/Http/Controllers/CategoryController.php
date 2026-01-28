<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $categories = Category::query()
            ->when($q, fn($query) => $query->where('name', 'like', "%{$q}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin-page.categories.index', compact('categories', 'q'));
    }

    public function create()
    {
        return view('admin-page.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            Category::create($request->validated());

            DB::commit();
            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Category berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('admin.categories.create')
                ->with('error', 'Gagal menambahkan category: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function edit(Category $category)
    {
        return view('admin-page.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        DB::beginTransaction();
        try {
            $category->update($request->validated());

            DB::commit();
            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Category berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('admin.categories.edit', $category->id)
                ->with('error', 'Gagal update category: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function destroy(Category $category)
    {
        DB::beginTransaction();
        try {
            $category->delete(); // soft delete

            DB::commit();
            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Category berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'Gagal menghapus category: ' . $th->getMessage());
        }
    }
}
