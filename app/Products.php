<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table = 'products';

    protected $fillable = array('nombre', 'sku', 'descripcion');

    // public function product_cars()
    // {
    // 	return $this->hasMany('App\Product_cars');
    // }
}
