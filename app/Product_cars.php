<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Carts;
use App\Products;

class Product_cars extends Model
{
    //
    protected $table = 'product_cars';

    protected $fillable = array('product_id', 'cart_id', 'quantity');

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function carts()
    {
        return $this->belongsTo(Carts::class);
    }
}
