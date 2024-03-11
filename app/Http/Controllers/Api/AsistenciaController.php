<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asistencia;

class AsistenciaController extends Controller
{
      //Función que nos devuelve todos los datos de asistencia que hay en la BBDD por get request ponemos url(para comprobar)
      public function index(){
        $asistencias = Asistencia::all(); 
        return $asistencias;
     }

     //Función que crea un nuevo dato de asistencia en la BBDD por post request ponemos url(para comprobar)
    public function store( Request $request){

      //Validar datos que tienen que estar obligatorios
      $request->validate([
          'asistencia'=>'required',
          'fecha'=>'required',
      ]);

      $data=$request->all();

      $asistencias = Asistencia::create($data);
      $response=[
          'success'=>true,
          'message'=>'Asistencia creada',
          'data'=>$asistencias
      ];

      return response()->json($response);
  }
}
