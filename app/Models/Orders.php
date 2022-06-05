<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'user_id', 
        'product_id', 
        'address', 
        'quantity'
    ];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
