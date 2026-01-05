<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    // 1. LIHAT DAFTAR WISHLIST SAYA
    public function index(Request $request)
    {
        // Ambil produk yang disukai oleh user yang sedang login
        $products = $request->user()->wishlists()->latest()->get();

        return response()->json([
            'message' => 'My Wishlist',
            'data' => $products
        ], 200);
    }

    // 2. TOGGLE (LIKE / UNLIKE)
    // Kalau belum ada -> Jadi Ada (Like)
    // Kalau sudah ada -> Jadi Hilang (Unlike)
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $user = $request->user();
        $productId = $request->product_id;

        // Fungsi ajaib Laravel: toggle()
        // Otomatis detach kalau ada, attach kalau belum ada.
        $changes = $user->wishlists()->toggle($productId);

        // Cek hasilnya: Apakah barusan di-attach (like) atau di-detach (unlike)?
        if (count($changes['attached']) > 0) {
            $status = 'Added to wishlist';
        } else {
            $status = 'Removed from wishlist';
        }

        return response()->json([
            'message' => $status,
            'data' => $user->wishlists // Kirim balik list terbaru (opsional)
        ], 200);
    }
}