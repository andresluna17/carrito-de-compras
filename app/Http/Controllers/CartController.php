<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carts;
use App\Product_cars;
use App\Products;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Carts::where('status', '=', 'pending')->first();
        if (!$cart) {
            $cart = Carts::create(
                [
                    'status' => 'pending'
                ]
            );
        }


        $products_cart = [];
        foreach ($cart->product_carts as $products_carts => $product_cart) {
            $product = [
                'product' => $product_cart->product,
                'quantity' => $product_cart->quantity,
                'id' => $product_cart->id
            ];
            array_push($products_cart, $product);
        }

        return
            response()->json(
                [
                    'status' => 'ok',
                    'data' => [
                        'id' => $cart->id,
                        'products_cart' => $cart->product_carts
                    ]
                ],
                200
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->input('product_id') || !$request->input('cart_id') || !$request->input('quantity')) {
            return response()->json(['errors' => array(['code' => 422, 'message' => 'Faltan parametros'])], 422);
        }
        $cart = Carts::find($request->input('cart_id'));
        if (!$cart || ($cart->status == "completed")) {
            return response()->json(['errors' => array(['code' => 422, 'message' => ''])], 422);
        }
        $product_id = $request->input('product_id');
        $cart_id = $request->input('cart_id');
        $quantity = $request->input('quantity');
        $product = Product_cars::where([['product_id', '=', $product_id], ['cart_id', '=', $cart_id]])->first();
        if (!$product) {
            Product_cars::create($request->all());
        } else {
            $product->quantity = $product->quantity + $quantity;
            $product->save();
        }


        return response()->json(['data' => [
            'message' => 'producto agregado al carrito'
        ], 'status' => 'ok',], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart = Carts::find($id);
        if (!$cart) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra carrito con ese código.'])], 404);
        }
        $products_cart = array();
        foreach ($cart->product_carts as $products_carts => $product_cart) {
            $product = [
                'product' => $product_cart->product,
                'quantity' => $product_cart->quantity,
                'id' => $product_cart->id
            ];
            array_push($products_cart, $product);
        }
        return response()->json(['status' => 'ok', 'data' => $products_cart], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cart = Carts::find($id);
        if (!$cart) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra carrito con ese código.'])], 404);
        }
        $cart->status = "completed";
        $cart->save();
        return response()->json(['status' => 'ok', 'message' => 'compra realizada'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product_cart = Product_cars::find($id);
        if (!$product_cart) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra un ese producto en el carrito con ese código.'])], 404);
        }
        $quantity = $request->input('quantity');
        $product_cart->quantity = $quantity;
        $product_cart->save();
        return response()->json(['status' => 'ok', 'message' => 'cantidad de producto en el carrito ' . $product_cart->quantity . ' fue actualizado', 'data' => $product_cart], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Product_cars::find($id);


        if (!$cart) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra un producto del carrito con ese código.'])], 404);
        }
        $cart->delete();
        return response()->json(['code' => 200, 'status' => 'ok', 'message' => 'Se ha eliminado el producto del carrito correctamente.'], 200);
    }
}
