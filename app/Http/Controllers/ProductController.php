<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        // Cari produk berdasarkan ID, kalau gak ketemu tampilkan 404
        $product = Product::findOrFail($id);
        
        // Ambil produk lain untuk rekomendasi (random 4 biji)
        $relatedProducts = Product::where('id', '!=', $id)->inRandomOrder()->take(4)->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}