<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController; // Pastikan ini mengarah ke WEB Controller
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (Jalur Utama Website)
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. AREA PUBLIK (Bisa Diakses Tanpa Login)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');

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
    
    // --- A. FITUR JUAL PRODUK (ProductController Web) ---
    // Menampilkan Form
    Route::get('/sell', [ProductController::class, 'create'])->name('products.create');
    // Proses Simpan Data (Redirect ke Home setelah sukses)
    Route::post('/sell', [ProductController::class, 'store'])->name('products.store');

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

    Route::get('/my-products', [ProductController::class, 'manage'])->name('products.manage'); // Halaman Tabel
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('products.edit'); // Form Edit
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('products.update'); // Proses Simpan Edit
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); // Proses Hapus

    Route::get('/my-wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{id}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
});

// Memuat rute auth bawaan Breeze (Login, Register, Logout)
require __DIR__.'/auth.php';