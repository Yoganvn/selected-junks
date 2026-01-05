<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    // 1. Tampilkan Halaman Wishlist Saya
    public function index(Request $request)
    {
        // Ambil produk yang disukai user login
        $products = $request->user()->wishlists()->latest()->get();
        return view('wishlist.index', compact('products'));
    }

    // 2. Proses Like/Unlike (Toggle)
    public function toggle(Request $request, $id)
    {
        // Toggle (Kalau ada jadi hilang, kalau gak ada jadi muncul)
        $changes = $request->user()->wishlists()->toggle($id);

        if (count($changes['attached']) > 0) {
            return back()->with('success', 'Produk masuk ke Wishlist!');
        } else {
            return back()->with('success', 'Produk dihapus dari Wishlist.');
        }
    }
}