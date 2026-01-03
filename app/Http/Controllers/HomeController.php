<?php

namespace App\Http\Controllers;

use App\Models\Product; // Panggil model Product
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua produk, urutkan dari yang terbaru
        $products = Product::latest()->get();

        return view('home', compact('products'));
    }
}