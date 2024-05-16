<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ClaseController extends Controller
{
    
        // //Función para recoger datos tabla intermedia user_clase por id de alumno
        // public function index2(){
        //     $user = User::with('clases')->where('id',Auth::user()->id)->first();
        //     return $user->clases;
        // }

        //Función para que devuelva datos tabla clase
        public function index(){
            $clase=Clase::with('actividad')->get();
            return $clase;
        }

        //Función que crea una clase y la guarda en la BBDD
        public function store( Request $request){

            //Validar datos que tienen que estar obligatorios
            $request->validate([
                'actividad_id'=>'required',
                'fecha'=>'required',
                
            ]);
       
            $data=$request->all();
       
            $clase = Clase::create($data);
            $response=[
                'success'=>true,
                'message'=>'Clase creada',
                'data'=>$clase
            ];
       
            return response()->json($response);
        }

        //Función para eliminar clase
        public function destroy($id){

            $clase = Clase::find($id); 
            $clase->delete();
            return response()->json(['success' => true, 'message' => 'Clase eliminada correctamente']);
        }
 
}


