<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. HALAMAN PUBLIK (Bisa diakses siapa saja)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');

// 2. DASHBOARD (Bawaan Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. FITUR USER (Harus Login)
Route::middleware('auth')->group(function () {
    
    // --- FITUR CHECKOUT (INI YANG PENTING) ---
    // Menampilkan Halaman Form (Isi Alamat)
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    // Memproses Data Form (Tombol Confirm & Pay) -> INI TADI KURANG
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    // Halaman Sukses
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');


    // --- FITUR KERANJANG ---
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'removeItem'])->name('cart.remove');


    // --- PROFIL USER ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';