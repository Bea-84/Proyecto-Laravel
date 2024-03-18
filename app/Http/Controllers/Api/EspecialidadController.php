<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Especialidad;

class EspecialidadController extends Controller
{
     //Función que nos devuelve resultados tabla especialidad
     public function index(){
        $especialidades = Especialidad::all();
        return $especialidades;
    }

      //Función que crea un nivel nuevo que se guarda en la BBDD por post request ponemos url
      public function store( Request $request){

        //Validar datos que tienen que estar obligatorios
        $request->validate([
            'dia'=>'required',
            'hora'=>'required',
        ]);
  
        $data=$request->all();
  
        $especialidades = Especialidad::create($data);
        $response=[
            'success'=>true,
            'message'=>'Especialidad creada',
            'data'=>$especialidades
        ];
  
        return response()->json($response);
    }

     //Función actualizar datos de una tarea por put request ponemos url/ id tarea
     public function update(Request $request, $id){

        //Validar datos que tienen que estar obligatorios
        $request->validate([
        'dia'=>'required',
        'hora'=>'required',
        'user_id'=>'required',
        
    ]);

    $data=$request->all();

    $especialidad = Especialidad::find($id);
    $especialidad->update($data);
    
    $response=[
        'success'=>true,
        'message'=>'Especialidad actualizada',
        'data'=>$especialidad
    ];

    return response()->json($response);
    }

    //Función para buscar dato por su id
    public function show($id) {
        // Buscar la asistencia por su ID
        $especialidad = Especialidad::find($id);
    
        // Verificar si se encontró la asistencia
        if (!$especialidad) {
            $response = [
                'success' => false,
                'message' => 'Especialidad no encontrada',
                'data' => null
            ];
            return response()->json($response, 404);
        }
    
        // Si se encontró la especialidad, retornarla en la respuesta JSON
        $response = [
            'success' => true,
            'message' => 'Especialidad encontrada',
            'data' => $especialidad
        ];
        return response()->json($response);
    }

    //Función para eliminar un nivel de la BBDD
    public function destroy($id){

        $especialidad = Especialidad::find($id);
        $especialidad->delete();
        return response()->json(['success' => true, 'message' => 'Especialidad eliminada correctamente']);
    }
    
  }


