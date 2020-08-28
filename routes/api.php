<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('carrito-de-compras/v1')->group(function () {
    Route::resource('products', 'ProductsController', ['only' => ['index', 'show', 'update', 'store', 'destroy']]);
    Route::get('cart', 'CartController@index');
    Route::post('add-product-cart', 'CartController@store');
    Route::resource('product-cart', 'CartController', ['only' => ['destroy', 'show']]);
    Route::patch('product-cart/{id}', 'CartController@update');
    Route::put('checkout/{id}', 'CartController@edit');
});
