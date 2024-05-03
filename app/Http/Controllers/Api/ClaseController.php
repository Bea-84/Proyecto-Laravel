<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ClaseController extends Controller
{

    //Función para recoger todos los datos de la tabla clase
    public function index(){
        $clase = Clase:: with('actividad')->get();
        return $clase;
    }

    
}


