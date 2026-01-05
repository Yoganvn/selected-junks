<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\WishlistController;

class ProductController extends Controller
{
    // --- FITUR JUAL PRODUK ---

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'price' => 'required|numeric',
            'size' => 'required|numeric',
            'condition' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'required|image|max:2048', // Cuma 1 Foto Wajib
        ]);

        try {
            // Upload 1 Gambar Saja
            $path = $request->file('image')->store('products', 'public');

            Product::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name) . '-' . Str::random(5),
                'brand' => $request->brand,
                'price' => $request->price,
                'size' => $request->size,
                'condition' => $request->condition,
                'description' => $request->description,
                'image' => $path, // Simpan path gambar utama
                'status' => 'available',
                'is_fullset' => 1
            ]);

            return redirect()->route('home')->with('success', 'Produk berhasil ditayangkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal upload: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // --- FITUR KELOLA PRODUK ---

    public function manage()
    {
        $products = Product::latest()->get();
        return view('products.manage', compact('products'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'price' => 'required|numeric',
            'size' => 'required|numeric',
            'condition' => 'required|string',
            'image' => 'nullable|image|max:2048', // Opsional saat edit
        ]);

        $data = $request->except(['image']);

        // Logic Ganti Gambar (Single)
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($product->image) Storage::disk('public')->delete($product->image);
            // Upload baru
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.manage')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus file gambar
        if ($product->image) Storage::disk('public')->delete($product->image);

        $product->delete();

        return redirect()->route('products.manage')->with('success', 'Produk berhasil dihapus!');
    }
}