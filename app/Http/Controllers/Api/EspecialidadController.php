<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Especialidad;

class EspecialidadController extends Controller
{
     //Función que nos devuelve resultados tabla especialidad
     public function index(){
        $especialidad = Especialidad::all();
        return $especialidad;
    }
}
