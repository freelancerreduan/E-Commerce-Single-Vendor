<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['color_id','size_id','price','quantity','created_at'];

    function rel_to_color(){
        return $this->belongsTo(Color::class, 'color_id');
    }

    function rel_to_size(){
        return $this->belongsTo(Size::class,'size_id');
    }
}
