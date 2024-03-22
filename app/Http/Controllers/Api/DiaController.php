<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dia;

class DiaController extends Controller
{
     //Función que nos devuelve todas las dias que hay en la BBDD 
     public function index(){
        $dias = Dia::all();  
        return $dias;
   }
}
