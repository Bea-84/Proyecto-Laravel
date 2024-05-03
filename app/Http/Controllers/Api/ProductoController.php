<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller {
     //Función que nos devuelve todos los productos que hay en la BBDD 
     public function index(){
        $productos = Producto::all(); 
        return $productos;
     }

     //Función que crea un producto nuevo que se guarda en la BBDD 
    public function store( Request $request){

      //Validar datos que tienen que estar obligatorios
      $request->validate([
          'descripcion'=>'required',
          'precio'=>'required',
          'imagen'=>'required'
      ]);

      $data=$request->all();

      $producto = Producto::create($data);
      $response=[
          'success'=>true,
          'message'=>'Producto creado',
          'data'=>$producto
      ];

      return response()->json($response);
  }
}