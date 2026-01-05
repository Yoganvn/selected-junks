<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Admin\UserController; // <--- PENTING: Import Controller Admin
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes (Jalur Utama Website)
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. AREA PUBLIK (Bisa Diakses Tanpa Login)
// ==========================================
Route::get('/', [ProductController::class, 'index'])->name('home'); 

// PERBAIKAN PENTING: Nama route ini saya ubah jadi 'products.show' 
// agar sesuai dengan link di halaman Wishlist kamu.
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');


// ==========================================
// 2. DASHBOARD & AUTHENTICATION
// ==========================================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// ==========================================
// 3. FITUR KHUSUS MEMBER (Wajib Login)
// ==========================================
Route::middleware('auth')->group(function () {
    
    // --- A. FITUR JUAL & KELOLA PRODUK ---
    Route::get('/sell', [ProductController::class, 'create'])->name('products.create');
    Route::post('/sell', [ProductController::class, 'store'])->name('products.store');

    Route::get('/my-products', [ProductController::class, 'manage'])->name('products.manage'); 
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('products.edit'); 
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('products.update'); 
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); 

    // --- B. FITUR KERANJANG BELANJA ---
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'removeItem'])->name('cart.remove');

    // --- C. FITUR CHECKOUT & TRANSAKSI ---
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

    // --- D. PENGATURAN PROFIL ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- E. WISHLIST ---
    Route::get('/my-wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{id}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
});


// ==========================================
// FITUR KHUSUS ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index'); 
    Route::post('/users', [UserController::class, 'store'])->name('users.store'); 
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Reports (BARU)
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});


// Memuat rute auth bawaan Breeze (Login, Register, Logout)
require __DIR__.'/auth.php';