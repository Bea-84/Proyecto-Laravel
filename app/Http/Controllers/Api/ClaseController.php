<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clase;

class ClaseController extends Controller
{
     //Función que nos devuelve resultados tabla clases
     public function index(){
        $clases = Clase:: with('dia')->get();
        return $clases;
    }

      //Función que almacena clase en BBDD
      public function store( Request $request){

        //Validar datos que tienen que estar obligatorios
        $request->validate([
            'dia'=>'required',
            'hora'=>'required',
        ]);
  
        $data=$request->all();
  
        $clases = Clase::create($data); 
        $response=[
            'success'=>true,
            'message'=>'Clase creada',
            'data'=>$clases
        ];
  
        return response()->json($response);
    }

     //Función actualizar datos 
     public function update(Request $request, $id){

        //Validar datos que tienen que estar obligatorios
        $request->validate([
        'dia'=>'required',
        'hora'=>'required',
        'user_id'=>'required',
        
    ]);

    $data=$request->all();

    $clases = Clase::find($id); 
    $clases->update($data);
    
    $response=[
        'success'=>true,
        'message'=>'Clase actualizada',
        'data'=>$clases
    ];

    return response()->json($response);
    }

    //Función para buscar dato por su id
    public function show($id) {
        // Buscar la clase por su ID
        $clase = Clase::find($id); 
    
        // Verificar si se encontró la clase
        if (!$clase) {
            $response = [
                'success' => false,
                'message' => 'Clase no encontrada',
                'data' => null
            ];
            return response()->json($response, 404);
        }
    
        // Si se encontró la clase, retornarla en la respuesta JSON
        $response = [
            'success' => true,
            'message' => 'Clase encontrada',
            'data' => $clase
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


