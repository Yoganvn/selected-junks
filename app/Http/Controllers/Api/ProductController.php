<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
// PENTING: Jangan ada "Route::..." di file ini!

class ProductController extends Controller
{
    public function index()
    {
        return Product::latest()->get();
    }

    public function store(Request $request)
    {
        // Validasi manual jika tidak pakai FormRequest
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'image' => 'required|image'
        ]);

        $path = $request->file('image')->store('products', 'public');

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'brand' => $request->brand,
            'price' => $request->price,
            'size' => $request->size ?? 0,
            'condition' => $request->condition ?? 'Good',
            'description' => $request->description,
            'image' => $path,
            'status' => 'available',
            'is_fullset' => 1
        ]);

        return response()->json(['message' => 'Success', 'data' => $product], 201);
    }

    public function show($id)
    {
        return Product::find($id);
    }
}