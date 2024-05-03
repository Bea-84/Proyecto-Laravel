<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ClaseController extends Controller
{
    
    //Función para recoger datos tabla intermedia user_clase por id de alumno
    public function index(){
        $user = User::with('clases')->where('id',Auth::user()->id)->first();
        return $user->clases;
    }

  
    
}


