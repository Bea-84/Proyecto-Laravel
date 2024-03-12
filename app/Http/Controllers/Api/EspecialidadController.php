<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Especialidad;

class EspecialidadController extends Controller
{
     //Función que nos devuelve resultados tabla especialidad
     public function index(){
        $especialidades = Especialidad::all();
        return $especialidades;
    }

      //Función que crea un nivel nuevo que se guarda en la BBDD por post request ponemos url
      public function store( Request $request){

        //Validar datos que tienen que estar obligatorios
        $request->validate([
            'dia'=>'required',
            'hora'=>'required',
        ]);
  
        $data=$request->all();
  
        $especialidades = Especialidad::create($data);
        $response=[
            'success'=>true,
            'message'=>'Especialidad creada',
            'data'=>$especialidades
        ];
  
        return response()->json($response);
    }
  }

