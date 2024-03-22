<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Horario;

class HorarioController extends Controller
{
    //Función que nos devuelve todas los horarios que hay en la BBDD 
    public function index(){
        $horarios = Horario::all();  
        return $horarios;
   }

   //Función para devolver los horarios de un día en concreto
    public function showday($id){

        $horarios = Horario::where('dia', $id)->get();
      
        return $horarios;
    }
}
