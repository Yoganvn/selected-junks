<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController; // Panggil Controller-nya di sini

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Jalur API Produk
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']); // Ini jalur POST kamu
Route::get('/products/{id}', [ProductController::class, 'show']);