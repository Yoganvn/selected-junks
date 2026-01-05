<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Pastikan field ini sesuai dengan tabel database kamu
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'payment_receipt', // Tambahan jika nanti ada upload bukti bayar
        'shipping_address'
    ];

    // 1. RELASI KE USER (Pembeli)
    // "Satu Order pasti milik satu User"
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 2. RELASI KE ORDER ITEMS (Barang Belanjaan)
    // "Satu Order bisa punya banyak Item"
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}