<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Horario;

class HorarioController extends Controller
{
    //Función que nos devuelve todas los horarios que hay en la BBDD 
    public function index(){
        $horarios = Horario:: with('dia')->get();
        return $horarios;
   }

   //Función para devolver los horarios de un día en concreto
    public function showday($id){

        $horarios = Horario::where('dia', $id)->get();
      
        return $horarios;
    }

       //Función que crea un horario nuevo que se guarda en la BBDD por post request ponemos url
       public function store( Request $request){

        //Validar datos que tienen que estar obligatorios
        $request->validate([
            'dia'=>'required',
            'hora_inicio'=>'required',
            'hora_fin'=>'required',
        ]);
   
        $data=$request->all();
   
        $horarios = Horario::create($data);
        $response=[
            'success'=>true,
            'message'=>'Horario creado',
            'data'=>$horarios
        ];
   
        return response()->json($response);
    }

       //Función actualizar datos 
       public function update(Request $request, $id){

        //Validar datos que tienen que estar obligatorios
        $request->validate([
        'dia'=>'required',
        'hora_inicio'=>'required',
        'hora_fin'=>'required',
        
    ]);

    $data=$request->all();

    $horarios = Horario::find($id); 
    $horarios->update($data);
    
    $response=[
        'success'=>true,
        'message'=>'Horario actualizada',
        'data'=>$horarios
    ];

    return response()->json($response);
    }

    //Función para buscar dato por su id
    public function show($id) {
        // Buscar la clase por su ID
        $horarios = Horario::find($id);  
    
        // Verificar si se encontró la clase
        if (!$horarios) {
            $response = [
                'success' => false,
                'message' => 'Horario no encontrado',
                'data' => null
            ];
            return response()->json($response, 404);
        }
    
        // Si se encontró la clase, retornarla en la respuesta JSON
        $response = [
            'success' => true,
            'message' => 'Horario encontrado',
            'data' => $horarios
        ];
        return response()->json($response);
    }

    //Función para eliminar clase
    public function destroy($id){

        $horarios = Horario::find($id); 
        $horarios->delete();
        return response()->json(['success' => true, 'message' => 'Horario eliminado correctamente']);
    }
}
