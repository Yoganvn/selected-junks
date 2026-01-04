<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // PENTING: Untuk bikin slug otomatis

class ProductController extends Controller
{
    // Halaman Form Jual
    public function create()
    {
        return view('products.create');
    }

    // Proses Simpan Data
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'price' => 'required|numeric',
            'size' => 'required|numeric',
            'condition' => 'required|string',
            'image' => 'required|image|max:2048', // Max 2MB
        ]);

        try {
            // 2. Upload Gambar
            $path = null;
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('products', 'public');
            }

            // 3. Simpan ke Database
            Product::create([
                'name' => $request->name,
                // Slug WAJIB ADA karena di database kamu 'NOT NULL'
                'slug' => Str::slug($request->name) . '-' . Str::random(5),
                'brand' => $request->brand,
                'price' => $request->price,
                'size' => $request->size,
                'condition' => $request->condition,
                'description' => $request->description,
                'image' => $path,
                'status' => 'available',
                'is_fullset' => 1 // Default sesuai tabel
            ]);

            return redirect()->route('home')->with('success', 'Produk berhasil ditayangkan!');

        } catch (\Exception $e) {
            // Jika error, tampilkan di layar agar ketahuan penyebabnya
            dd("GAGAL SIMPAN DATABASE: " . $e->getMessage());
        }
    }
    
    // Fungsi Detail Produk (Show)
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
}