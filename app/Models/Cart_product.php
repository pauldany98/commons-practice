<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart_product extends Model
{
    //
    protected $table = 'cart_products';
    protected $fillable = [
        'cart_id', 'product_id', 'quantity', 'price'
    ];
}
