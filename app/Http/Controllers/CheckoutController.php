<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // 1. TAMPILKAN HALAMAN FORM CHECKOUT
    public function show()
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        $total = $cart->items->sum(function($item) {
            return $item->product->price;
        });

        return view('checkout.details', compact('cart', 'total', 'user'));
    }

    // 2. PROSES TRANSAKSI (DIPANGGIL DARI FORM)
    public function process(Request $request)
    {
        // Validasi input dulu
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $user = Auth::user();
        $cart = $user->cart;
        $total = $cart->items->sum(fn($item) => $item->product->price);

        DB::transaction(function () use ($user, $cart, $total, $request) {
            
            // Simpan Order beserta Alamatnya
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $total,
                'status' => 'paid',
                'customer_name' => $request->name,
                'customer_phone' => $request->phone,
                'shipping_address' => $request->address,
                'payment_method' => $request->payment_method ?? 'bank_transfer',
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'price' => $item->product->price,
                ]);

                // Update status sepatu jadi sold
                $item->product->update(['status' => 'sold']);
            }

            $cart->items()->delete();
        });

        return redirect()->route('checkout.success');
    }

    public function success()
    {
        return view('checkout.success');
    }
}