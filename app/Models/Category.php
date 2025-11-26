<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    
    //Relations to sub Category
    function rel_to_subCategory(){
        return $this->hasMany(Subcategory::class, 'category_id');
    }
}
