<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    // INI WAJIB ADA BIAR BISA DISIMPAN KE DB
    protected $fillable = ['cart_id', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}