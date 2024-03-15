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

    //Función que crea un nivel nuevo que se guarda en la BBDD por post request ponemos url
    public function store( Request $request){

     //Validar datos que tienen que estar obligatorios
     $request->validate([
         'fecha'=>'required',
         'forma_de_pago'=>'required',
     ]);

     $data=$request->all();

     $inscripcion = Inscripcion::create($data);
     $response=[
         'success'=>true,
         'message'=>'Inscripcion creada',
         'data'=>$inscripcion
     ];

     return response()->json($response);
 }

    //Función actualizar datos de una tarea por put request ponemos url/ id tarea
    public function update(Request $request, $id){

        //Validar datos que tienen que estar obligatorios
        $request->validate([
        'fecha'=>'required',
        'hora'=>'required'
        
    ]);

    $data=$request->all();

    $inscripcion = Inscripcion::find($id);
    $inscripcion->update($data);
    
    $response=[
        'success'=>true,
        'message'=>'Inscripción actualizada',
        'data'=>$inscripcion
    ];

    return response()->json($response);
    }

    //Función para buscar dato por su id
    public function show($id) {
        // Buscar la asistencia por su ID
        $inscripcion = Inscripcion::find($id);
    
        // Verificar si se encontró la asistencia
        if (!$inscripcion) {
            $response = [
                'success' => false,
                'message' => 'Inscripcion no encontrada',
                'data' => null
            ];
            return response()->json($response, 404);
        }
    
        // Si se encontró la asistencia, retornarla en la respuesta JSON
        $response = [
            'success' => true,
            'message' => 'Inscripcion encontrada',
            'data' => $inscripcion
        ];
        return response()->json($response);
    }
    
  }


