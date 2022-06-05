<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $fillable = ['category_name', 'photo_url'];
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
