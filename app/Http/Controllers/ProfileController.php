<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.profile.index');
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $request->user()->id],
                'phone' => ['nullable', 'string', 'max:30'],
                'address' => ['nullable', 'string'],
            ]);

            $request->user()->update($data);

            DB::commit();
            return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('profile.index')
                ->with('error', 'Gagal update profil: ' . $th->getMessage())
                ->withInput();
        }
    }
}
