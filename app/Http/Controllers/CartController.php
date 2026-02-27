<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);

        // Normalisasi format cart lama (quantity -> qty) + fallback stock
        foreach ($cart as $id => $item) {
            $cart[$id]['id'] = (int) ($item['id'] ?? $id);
            $cart[$id]['name'] = $item['name'] ?? 'Produk';
            $cart[$id]['price'] = (float) ($item['price'] ?? 0);
            $cart[$id]['image'] = $item['image'] ?? null;
            $cart[$id]['category'] = $item['category'] ?? '-';
            $cart[$id]['stock'] = (int) ($item['stock'] ?? 999);
            $cart[$id]['qty'] = (int) ($item['qty'] ?? ($item['quantity'] ?? 1));

            // bersihkan key lama kalau ada
            unset($cart[$id]['quantity']);
        }

        session()->put('cart', $cart);

        $total = collect($cart)->sum(function ($item) {
            return ((float) $item['price']) * ((int) $item['qty']);
        });

        return view('pages.cart.index', compact('cart', 'total'));
    }

    public function store(Request $request, Product $product)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'quantity' => ['required', 'integer', 'min:1'],
            ]);

            $qty = (int) $validated['quantity'];

            if ($product->stock_quantity <= 0) {
                return redirect()->back()->with('error', 'Produk sedang habis.');
            }

            if ($qty > (int) $product->stock_quantity) {
                return redirect()->back()->with('error', 'Quantity melebihi stok tersedia.');
            }

            $cart = session()->get('cart', []);

            // kalau sudah ada di cart, tambahkan qty
            if (isset($cart[$product->id])) {
                $currentQty = (int) ($cart[$product->id]['qty'] ?? ($cart[$product->id]['quantity'] ?? 0));
                $newQty = $currentQty + $qty;

                if ($newQty > (int) $product->stock_quantity) {
                    return redirect()->back()->with('error', 'Total quantity di keranjang melebihi stok tersedia.');
                }

                $cart[$product->id]['qty'] = $newQty;
                $cart[$product->id]['stock'] = (int) $product->stock_quantity;
                unset($cart[$product->id]['quantity']);
            } else {
                $cart[$product->id] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => (float) $product->price,
                    'image' => $product->image,
                    'category' => optional($product->category)->name ?? '-',
                    'stock' => (int) $product->stock_quantity,
                    'qty' => $qty,
                ];
            }

            session()->put('cart', $cart);

            DB::commit();
            return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Gagal menambahkan ke keranjang: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function update(Request $request, $productId)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'qty' => ['required', 'integer', 'min:1'],
            ]);

            $cart = session()->get('cart', []);

            if (!isset($cart[$productId])) {
                return redirect()->route('cart.index')->with('error', 'Item tidak ditemukan di keranjang.');
            }

            $stock = (int) ($cart[$productId]['stock'] ?? 999);
            $qty = (int) $validated['qty'];

            if ($qty > $stock) {
                return redirect()->route('cart.index')->with('error', 'Quantity melebihi stok tersedia.');
            }

            $cart[$productId]['qty'] = $qty;
            unset($cart[$productId]['quantity']);

            session()->put('cart', $cart);

            DB::commit();
            return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('cart.index')
                ->with('error', 'Gagal update keranjang: ' . $th->getMessage());
        }
    }

    public function destroy($productId)
    {
        DB::beginTransaction();
        try {
            $cart = session()->get('cart', []);

            if (!isset($cart[$productId])) {
                return redirect()->route('cart.index')->with('error', 'Item tidak ditemukan di keranjang.');
            }

            unset($cart[$productId]);

            session()->put('cart', $cart);

            DB::commit();
            return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('cart.index')
                ->with('error', 'Gagal menghapus item: ' . $th->getMessage());
        }
    }

    public function clear()
    {
        DB::beginTransaction();
        try {
            session()->forget('cart');

            DB::commit();
            return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('cart.index')
                ->with('error', 'Gagal mengosongkan keranjang: ' . $th->getMessage());
        }
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        $total = collect($cart)->sum(function ($item) {
            $qty = (int) ($item['qty'] ?? ($item['quantity'] ?? 1));
            $price = (float) ($item['price'] ?? 0);
            return $price * $qty;
        });

        return view('pages.checkout.index', compact('cart', 'total'));
    }

    public function checkoutStore(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'phone' => ['required', 'string', 'max:30'],
                'address' => ['required', 'string'],
            ]);

            // simpan ke profile user biar auto keisi next time
            $request->user()->update([
                'phone' => $data['phone'],
                'address' => $data['address'],
            ]);

            $cart = session()->get('cart', []);
            if (empty($cart)) {
                return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
            }

            $lines = [];
            $total = 0;

            foreach ($cart as $item) {
                $qty = (int) ($item['qty'] ?? ($item['quantity'] ?? 1));
                $price = (float) ($item['price'] ?? 0);
                $subtotal = $price * $qty;
                $total += $subtotal;

                $lines[] = "- {$item['name']} x{$qty} = Rp " . number_format($subtotal, 0, ',', '.');
            }

            $message = "Halo KlikkuStore, saya mau pesan:\n\n" . implode("\n", $lines) . "\n\n" . 'Total: Rp ' . number_format($total, 0, ',', '.') . "\n\n" . "Nama: {$data['name']}\n" . "Email: {$data['email']}\n" . "No WA: {$data['phone']}\n" . "Alamat: {$data['address']}\n\n" . 'Terima kasih.';

            // WA number: 0895637875901 => format internasional: 62895637875901
            $waNumber = '62895637875901';
            $waUrl = "https://wa.me/{$waNumber}?text=" . urlencode($message);

            // opsional: kosongkan cart setelah "buat pesanan"
            session()->forget('cart');

            DB::commit();
            return redirect()->away($waUrl);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('checkout.index')
                ->with('error', 'Checkout gagal: ' . $th->getMessage())
                ->withInput();
        }
    }
}
