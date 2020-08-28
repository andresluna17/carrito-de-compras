<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use Response;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return
            response()->json(['status' => 'ok', 'data' => Products::all()], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->input('nombre') || !$request->input('sku') || !$request->input('descripcion')) {
            return response()->json(['errors' => array(['code' => 422, 'message' => 'Faltan parametros'])], 422);
        }
        $nuevoproducto = Products::create($request->all());
        return response()->json(['data' => $nuevoproducto], 201)->header('Location',  url('/api/v1/') . '/products/' . $nuevoproducto->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Products::find($id);
        if (!$producto) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra un producto con ese código.'])], 404);
        }

        return response()->json(['status' => 'ok', 'data' => $producto], 200);
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
        $producto = Products::find($id);
        if (!$producto) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra un producto con ese código.'])], 404);
        }
        $nombre = $request->input('nombre');
        $sku = $request->input('sku');
        $descripcion = $request->input('descripcion');
        if (!$nombre || !$sku || !$descripcion) {
            return response()->json(['errors' => array(['code' => 422, 'message' => 'Faltan valores para completar el procesamiento.'])], 422);
        }
        $producto->nombre = $nombre;
        $producto->sku = $sku;
        $producto->descripcion = $descripcion;
        $producto->save();
        return response()->json(['status' => 'ok', 'message' => 'producto ' . $producto->nombre . ' fue actualizado', 'data' => $producto], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Products::find($id);

        if (!$producto) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra un producto con ese código.'])], 404);
        }
        $producto->delete();
        return response()->json(['code' => 200, 'status' => 'ok', 'message' => 'Se ha eliminado el producto correctamente.'], 200);
    }
}
