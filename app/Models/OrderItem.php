<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    // 1. RELASI KE ORDER (Bapaknya)
    // "Satu item pasti milik satu order"
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // 2. RELASI KE PRODUK
    // "Satu item pasti adalah satu jenis produk"
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}