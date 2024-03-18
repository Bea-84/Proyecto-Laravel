<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nivel;

class NivelController extends Controller
{
     //Función que nos devuelve todas los niveles que hay en la BBDD 
     public function index(){
        $niveles = Nivel::all(); 
        return $niveles;
     }

     //Función que crea un nivel nuevo que se guarda en la BBDD 
    public function store( Request $request){

      //Validar datos que tienen que estar obligatorios
      $request->validate([
          'nombre'=>'required',
          'descripcion'=>'required',
      ]);

      $data=$request->all();

      $nivel = Nivel::create($data);
      $response=[
          'success'=>true,
          'message'=>'Nivel creado',
          'data'=>$nivel
      ];

      return response()->json($response);
  }

  //Función editar datos de nivel en la BBDD
  public function update(Request $request, $id){

    //Validar datos que tienen que estar obligatorios
    $request->validate([
      'nombre'=>'required',
      'descripcion'=>'required',
      'user_id'=>'required',
      
    ]);

    $data=$request->all();

    $nivel = Nivel::find($id);
    $nivel->update($data);
 
    $response=[
        'success'=>true,
        'message'=>'Nivel actualizado',
        'data'=>$nivel
    ];

    return response()->json($response);
  }

    //Función para buscar dato por su id y mostrar
    public function show($id) {
        // Buscar la asistencia por su ID
        $nivel = Nivel::find($id);
    
        // Verificar si se encontró la asistencia
        if (!$nivel) {
            $response = [
                'success' => false,
                'message' => 'Nivel no encontrado',
                'data' => null
            ];
            return response()->json($response, 404);
        }
    
        // Si se encontró el nivel, retornarla en la respuesta JSON
        $response = [
            'success' => true,
            'message' => 'Nivel encontrado',
            'data' => $nivel
        ];
        return response()->json($response);
    }

    //Función para eliminar un nivel de la BBDD
    public function destroy($id){

        $nivel = Nivel::find($id);
        $nivel->delete();
        return response()->json(['success' => true, 'message' => 'Nivel eliminado correctamente']);
    }
    
}
