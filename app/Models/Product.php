<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'brand', 'size', 'price', 
        'condition', 'description', 'is_fullset', 
        'status', 'image','status'
    ];

    // Agar tipe data is_fullset otomatis jadi true/false, bukan 1/0
    protected $casts = [
        'is_fullset' => 'boolean',
    ];
}