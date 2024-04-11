<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estado;

class EstadoController extends Controller
{
        //Función que nos devuelve todas los estados que hay en la BBDD 
        public function index(){
            $estados = Estado::all();   
            return $estados;
       }
}
