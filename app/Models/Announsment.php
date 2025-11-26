<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class announsment extends Model
{
    //fillable 
    use HasFactory;

    protected $fillable =[
        'announsment',
        'status',
    ];
}
