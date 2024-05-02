<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductoController extends Controller {
     //Función que nos devuelve todas los niveles que hay en la BBDD 
     public function index(){
        $productos = Producto::all(); 
        return $nproductos;
     }

     //Función que crea un nivel nuevo que se guarda en la BBDD 
    public function store( Request $request){

      //Validar datos que tienen que estar obligatorios
      $request->validate([
          'id'=>'required',
          'descripcion'=>'required',
          'precio'=>'required',
          'imagen'=>'required'
      ]);
    }
}