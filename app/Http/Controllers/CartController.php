<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 1. Menampilkan isi keranjang
    public function index()
    {
        $user = Auth::user();
        $cart = $user->cart;

        $cartItems = $cart ? $cart->items()->with('product')->get() : collect([]);

        $total = $cartItems->sum(function($item) {
            return $item->product->price;
        });

        return view('cart', compact('cartItems', 'total'));
    }

    // 2. Tambah ke Keranjang
    public function addToCart(Request $request, $productId)
    {

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login dulu bosku!');
        }

        $user = Auth::user();
        $cart = $user->cart ?? Cart::create(['user_id' => $user->id]);

        $alreadyInCart = $cart->items()->where('product_id', $productId)->exists();

        if ($alreadyInCart) {
            return redirect()->back()->with('error', 'Sepatu ini sudah ada di keranjangmu!');
        }

        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $productId
        ]);

        return redirect()->back()->with('success', 'Berhasil masuk keranjang!');
    }

    // 3. Hapus Barang (TAMBAHAN BARU)
    public function removeItem($itemId)
    {
        $item = CartItem::find($itemId);

        if ($item) {
            $item->delete();
            return redirect()->back()->with('success', 'Barang berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Gagal menghapus barang.');
    }
}