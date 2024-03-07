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
}
