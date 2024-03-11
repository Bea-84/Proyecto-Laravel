<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nivel;

class NivelController extends Controller
{
     //Función que nos devuelve todas los niveles que hay en la BBDD por get request ponemos url
     public function index(){
        $niveles = Nivel::all(); 
        return $niveles;
     }

     //Función que crea un nivel nuevo que se guarda en la BBDD por post request ponemos url
    public function store( Request $request){

      //Validar datos que tienen que estar obligatorios
      $request->validate([
          'nombre'=>'required',
          'descripcion'=>'required',
      ]);

      $data=$request->all();

      $nivel = Nivel::create($data);
      $response=[
          'success'=>true,
          'message'=>'Nivel creado',
          'data'=>$nivel
      ];

      return response()->json($response);
  }
}
