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

    // rel to category 
    function rel_to_category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    // inventory 
    public function rel_to_inventory()
    {
        return $this->hasMany(Inventory::class, 'product_id');
    }

    // product gallary table ralation 
    function rel_to_gallarey(){
        return $this->belongsTo(gallary::class, 'product_id');
    }
}
