<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    // Product Update
    use HasFactory;

    protected $fillable = [
        'product_name',
        'price',
        'discount',
        'previous',
        'updated_at',
    ];
}
