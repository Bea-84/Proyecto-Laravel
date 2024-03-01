<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    //Función que nos devuelve todas las tareas que hay en la BBDD por get request ponemos url
    public function index(){
        $tareas = Task::all();
        return $tareas;
    }

    //Función que crea una tarea en la BBDD por post request ponemos url
    public function store( Request $request){

        //Validar datos que tienen que estar obligatorios
        $request->validate([
            'name'=>'required',
            'description'=>'required',
        ]);

        $data=$request->all();

        $task = Task::create($data);
        $response=[
            'success'=>true,
            'message'=>'Tarea creada',
            'data'=>$task
        ];

        return response()->json($response);
    }

    //Función actualizar datos de una tarea por put request ponemos url/ id tarea
    public function update(Request $request, $id){

         //Validar datos que tienen que estar obligatorios
         $request->validate([
            'name'=>'required',
            
        ]);

        $data=$request->all();

        $task = Task::find($id);
        $task->update($data);
        
        $response=[
            'success'=>true,
            'message'=>'Tarea actualizada',
            'data'=>$task
        ];

        return response()->json($response);
    }
}
