<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * 1. GET: TAMPILKAN SEMUA PRODUK
     */
    public function index()
    {
        $products = Product::latest()->get();

        return response()->json([
            'message' => 'List Data Produk',
            'data'    => $products
        ], 200);
    }

    /**
     * 2. POST: TAMBAH PRODUK BARU (Upload 3 Gambar)
     */
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'name'      => 'required',
            'brand'     => 'required',
            'price'     => 'required|numeric',
            'size'      => 'required',
            'condition' => 'required',
            'image'     => 'required|image|max:2048',   // Wajib
            'image_2'   => 'nullable|image|max:2048', // Opsional
            'image_3'   => 'nullable|image|max:2048', // Opsional
        ]);

        try {
            // Upload Gambar Utama
            $path1 = $request->file('image')->store('products', 'public');
            
            // Upload Gambar Tambahan (Jika ada)
            $path2 = $request->hasFile('image_2') ? $request->file('image_2')->store('products', 'public') : null;
            $path3 = $request->hasFile('image_3') ? $request->file('image_3')->store('products', 'public') : null;

            // Simpan ke Database
            $product = Product::create([
                'name'        => $request->name,
                'slug'        => Str::slug($request->name) . '-' . time(),
                'brand'       => $request->brand,
                'price'       => $request->price,
                'size'        => $request->size ?? 0,
                'condition'   => $request->condition ?? 'Good',
                'description' => $request->description,
                'image'       => $path1,
                'image_2'     => $path2,
                'image_3'     => $path3,
                'status'      => 'available',
                'is_fullset'  => 1
            ]);

            return response()->json([
                'message' => 'Produk Berhasil Ditambahkan',
                'data'    => $product
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal: ' . $e->getMessage()], 500);
        }
    }

    /**
     * 3. GET: LIHAT DETAIL 1 PRODUK
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        return response()->json([
            'message' => 'Detail Produk',
            'data'    => $product
        ], 200);
    }

    /**
     * 4. PUT: UPDATE PRODUK (Edit Data & Ganti Gambar)
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        // Validasi (Semua nullable agar user bisa edit sebagian saja)
        $request->validate([
            'name'      => 'nullable',
            'brand'     => 'nullable',
            'price'     => 'nullable|numeric',
            'size'      => 'nullable',
            'condition' => 'nullable',
            'image'     => 'nullable|image|max:2048',
            'image_2'   => 'nullable|image|max:2048',
            'image_3'   => 'nullable|image|max:2048',
        ]);

        // Ambil data input selain gambar & _method
        $data = $request->except(['image', 'image_2', 'image_3', '_method']);

        // --- LOGIC GANTI GAMBAR ---

        // Cek Image 1
        if ($request->hasFile('image')) {
            // Hapus yang lama
            if ($product->image) Storage::disk('public')->delete($product->image);
            // Upload yang baru
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Cek Image 2
        if ($request->hasFile('image_2')) {
            if ($product->image_2) Storage::disk('public')->delete($product->image_2);
            $data['image_2'] = $request->file('image_2')->store('products', 'public');
        }

        // Cek Image 3
        if ($request->hasFile('image_3')) {
            if ($product->image_3) Storage::disk('public')->delete($product->image_3);
            $data['image_3'] = $request->file('image_3')->store('products', 'public');
        }

        // Update Slug jika nama berubah
        if ($request->name && $request->name != $product->name) {
            $data['slug'] = Str::slug($request->name) . '-' . time();
        }

        // Simpan Perubahan
        $product->update($data);

        return response()->json([
            'message' => 'Produk Berhasil Diupdate',
            'data'    => $product
        ], 200);
    }

    /**
     * 5. DELETE: HAPUS PRODUK
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        // Hapus file gambar dari penyimpanan server
        if ($product->image) Storage::disk('public')->delete($product->image);
        if ($product->image_2) Storage::disk('public')->delete($product->image_2);
        if ($product->image_3) Storage::disk('public')->delete($product->image_3);

        // Hapus data dari database
        $product->delete();

        return response()->json([
            'message' => 'Produk Berhasil Dihapus'
        ], 200);
    }
}