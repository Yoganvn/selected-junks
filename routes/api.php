<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController; // Pastikan baris ini ada

// Route bawaan install:api (bisa dihapus atau biarkan)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// INI ROUTE KITA:
Route::apiResource('products', ProductController::class);