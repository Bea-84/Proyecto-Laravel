<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inscripcion;

class InscripcionController extends Controller
{
     //Función que nos devuelve todas las inscripciones que hay en la BBDD por get request ponemos url
     public function index(){
          $inscripcion = Inscripcion::all(); 
          return $inscripcion;
     }
}
