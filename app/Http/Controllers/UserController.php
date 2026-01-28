<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $users = User::query()
            ->when($q, function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin-page.users.index', compact('users', 'q'));
    }

    public function create()
    {
        return view('admin-page.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'role' => ['required', 'in:1,2'],
        ]);

        DB::beginTransaction();
        try {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
            ]);

            DB::commit();
            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('admin.users.create')
                ->with('error', 'Gagal menambahkan user: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function edit(User $user)
    {
        return view('admin-page.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:1,2'],
            // password optional saat edit
            'password' => ['nullable', 'min:6', 'confirmed'],
        ]);

        DB::beginTransaction();
        try {
            $updateData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => $data['role'],
            ];

            if (!empty($data['password'])) {
                $updateData['password'] = Hash::make($data['password']);
            }

            $user->update($updateData);

            DB::commit();
            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('admin.users.edit', $user->id)
                ->with('error', 'Gagal update user: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            // safety: jangan hapus diri sendiri
            if (Auth::id() === $user->id) {
                return redirect()
                    ->route('admin.users.index')
                    ->with('error', 'Tidak bisa menghapus akun yang sedang login.');
            }

            $user->delete();

            DB::commit();
            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Gagal menghapus user: ' . $th->getMessage());
        }
    }
}
