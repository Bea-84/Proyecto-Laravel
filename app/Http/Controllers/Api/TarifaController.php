<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tarifa;

class TarifaController extends Controller
{
     //Función que nos devuelve todas las tarifas que hay en la BBDD 
     public function index(){
        $tarifas = Tarifa::all();   
        return $tarifas;
   }
}
