<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product_cars;

class Carts extends Model
{
    //
    protected $table = 'carts';

    protected $fillable = array('status');

    public function product_carts()
    {
        return $this->hasMany(Product_cars::class, "cart_id");
    }
}
