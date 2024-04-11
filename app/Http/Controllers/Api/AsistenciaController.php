<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asistencia;

class AsistenciaController extends Controller
{
      //Función que nos devuelve todos los datos de asistencia que hay en la BBDD 
      //Al añadir el with nos devuelve los datos de las tablas user, clase y estado aquí llamamos a los métodos
      //que tenemos en el model asistencia
      public function index(){
        $asistencias = Asistencia::with('user','clase','estado')->get(); 
        return $asistencias;
      }
  
}
