<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asistencia;

class AsistenciaController extends Controller
{
      //Función que nos devuelve todos los datos de asistencia que hay en la BBDD 
      public function index(){
        $asistencias = Asistencia::all(); 
        return $asistencias;
      }

     //Función que crea un nuevo dato de asistencia en la BBDD 
     public function store( Request $request){

        //Validar datos que tienen que estar obligatorios
        $request->validate([
            'asistencia'=>'required',
            'fecha'=>'required',
        ]);

        $data=$request->all();

        $asistencias = Asistencia::create($data);
        $response=[
            'success'=>true,
            'message'=>'Asistencia creada',
            'data'=>$asistencias
        ];

        return response()->json($response);
      }

    //Función editar datos de asistencia en la BBDD
    public function update(Request $request, $id){

      //Validar datos que tienen que estar obligatorios
      $request->validate([
        'asistencia'=>'required',
        'fecha'=>'required',
        'user_id'=>'required',
        
      ]);

      $data=$request->all();

      $asistencia = Asistencia::find($id);
      $asistencia->update($data);
   
      $response=[
          'success'=>true,
          'message'=>'Asistencia actualizada',
          'data'=>$asistencia
      ];

      return response()->json($response);
    }

    //Función para buscar dato por su id y mostrar
    public function show($id) {
      // Buscar la asistencia por su ID
      $asistencia = Asistencia::find($id);
  
      // Verificar si se encontró la asistencia
      if (!$asistencia) {
          $response = [
              'success' => false,
              'message' => 'Asistencia no encontrada',
              'data' => null
          ];
          return response()->json($response, 404);
      }
  
      // Si se encontró la asistencia, retornarla en la respuesta JSON
      $response = [
          'success' => true,
          'message' => 'Asistencia encontrada',
          'data' => $asistencia
      ];
      return response()->json($response);
  }

   //Función para eliminar un dato asistencia de la BBDD
   public function destroy($id){

    $asistencia = Asistencia::find($id); 
    $asistencia->delete();
    return response()->json(['success' => true, 'message' => 'Dato asistencia eliminado correctamente']);
}
  
}
