<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asistencia;

class AsistenciaController extends Controller
{
      //Función que nos devuelve todos los datos de asistencia que hay en la BBDD por get request ponemos url
      public function index(){
        $asistencias = Asistencia::all(); 
        return $asistencias;
     }
}
