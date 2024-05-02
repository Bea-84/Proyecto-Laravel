<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Actividad;

class ActividadController extends Controller
{
    public function index(){
        $actividades = Actividad::all();
        return $actividades;
    }

    //Función para buscar dato por su id
    public function show($id) {
        // Buscar la Actividad por su ID
        $actividad = Actividad::find($id); 
    
        // Verificar si se encontró la Actividad
        if (!$actividad) {
            $response = [
                'success' => false,
                'message' => 'Clase no encontrada',
                'data' => null
            ];
            return response()->json($response, 404);
        }
    
        // Si se encontró la Actividad, retornarla en la respuesta JSON
        $response = [
            'success' => true,
            'message' => 'Clase encontrada',
            'data' => $actividad
        ];
        return response()->json($response);
    }

      //Función que almacena Actividad en BBDD
      public function store( Request $request){

        //Validar datos que tienen que estar obligatorios
        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'required',
        ]);
  
        $data=$request->all();
  
        $actividad = Actividad::create($data); 
        $response=[
            'success'=>true,
            'message'=>'Actividad creada',
            'data'=>$actividad
        ];
  
        return response()->json($response);
    }

     //Función actualizar datos 
     public function update(Request $request, $id){

        //Validar datos que tienen que estar obligatorios
        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'required'
        ]);

    $data=$request->all();

    $actividad = Actividad::find($id); 
    $actividad->update($data);
    
    $response=[
        'success'=>true,
        'message'=>'Clase actualizada',
        'data'=>$actividad
    ];

    return response()->json($response);
    }


    //Función para eliminar Actividad
    public function destroy($id){

        $actividad = Actividad::find($id); 
        $actividad->delete();
        return response()->json(['success' => true, 'message' => 'Actividad eliminada correctamente']);
    }
}
