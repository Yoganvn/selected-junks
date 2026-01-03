<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // GET: Ambil semua data
    public function index()
    {
        $products = Product::latest()->get();
        return ProductResource::collection($products);
    }

    // POST: Simpan data baru
    // Perhatikan kita pakai 'StoreProductRequest' bukan 'Request' biasa
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        
        // Handle Upload Gambar
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Auto Generate Slug
        $data['slug'] = Str::slug($request->name) . '-' . time();

        $product = Product::create($data);

        return response()->json([
            'message' => 'Product created successfully',
            'data' => new ProductResource($product)
        ], 201);
    }

    // GET: Ambil detail 1 sepatu
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return new ProductResource($product);
    }

    // DELETE: Hapus data
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Hapus gambar lama jika ada biar server gak penuh
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}