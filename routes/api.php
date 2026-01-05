<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// --- IMPORT CONTROLLER ---
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Admin\UserController; // <--- Import Controller Admin

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

// Rute Login Khusus Postman (Buat ambil Token)
Route::post('/login', function (Request $request) {
    $request->validate(['email' => 'required', 'password' => 'required']);
    
    $user = User::where('email', $request->email)->first();
    
    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Login Gagal'], 401);
    }
    
    // Hapus token lama biar bersih, lalu buat baru
    $user->tokens()->delete();
    return response()->json([
        'message' => 'Login Sukses',
        'token' => $user->createToken('auth_token')->plainTextToken
    ]);
});

// ==========================================
// 1. PUBLIC ROUTES (Bisa Diakses Siapa Saja)
// ==========================================
Route::get('/products', [ProductController::class, 'index']);      // Lihat Semua Produk
Route::get('/products/{id}', [ProductController::class, 'show']);  // Lihat Detail Produk


// ==========================================
// 2. PROTECTED ROUTES (Harus Punya Token / Login)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {
    
    // Cek User Sendiri (Siapa yang login?)
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // --- FITUR WISHLIST ---
    Route::get('/wishlist', [WishlistController::class, 'index']);       // Lihat Wishlist Saya
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle']); // Like / Unlike

    // --- FITUR JUAL PRODUK (User Member) ---
    // Dipindah ke sini agar aman (hanya member login yang bisa upload/edit)
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    
});


// ==========================================
// 3. ADMIN ROUTES (Harus Login & Role Admin)
// ==========================================
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    
    // CRUD User via Postman
    // URL: http://127.0.0.1:8000/api/admin/users
    Route::post('/admin/users', [UserController::class, 'store']);      // Tambah User Baru
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy']); // Hapus User

});