<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $fillable = [
        // 'category_id', 
        'product_name', 
        'desc', 
        'photo_url',
        'price'
    ];
    protected $guarded = [];
}
