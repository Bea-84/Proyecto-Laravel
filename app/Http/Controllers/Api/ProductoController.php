<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller {


     //Función que nos devuelve todos los productos que hay en la BBDD y las imágenes de la tabla media
     public function index(){
        $productos = Producto:: with('media')->get(); 
        return $productos;
     }

     //Función que crea un producto nuevo que se guarda en la BBDD 
    public function store( Request $request){

      //Validar datos que tienen que estar obligatorios
      $request->validate([
          'nombre'=>'required',
          'descripcion'=>'required',
          'precio'=>'required'
      ]);

      $data=$request->all();

      $producto = Producto::create($data);
      $response=[
          'success'=>true,
          'message'=>'Producto creado',
          'data'=>$producto
      ];

      if ($request->hasFile('img')) {
        $producto->addMediaFromRequest('img')->preservingOriginal()->toMediaCollection('images-productos');
      }

      return response()->json($response);
     }
    

    //Función editar datos de productos que se guardan en la BBDD
    public function update(Request $request, $id){

        //Validar datos que tienen que estar obligatorios
        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'required',
            'precio'=>'required'
        ]);

        $data=$request->all();

        $producto = Producto::find($id);
        $producto->update($data);
    
        $response=[
            'success'=>true,
            'message'=>'Producto actualizado',
            'data'=>$producto
        ];

        if($request->hasFile('img')) {
            $producto->media()->delete();
            $producto->addMediaFromRequest('img')->preservingOriginal()->toMediaCollection('images-producto');
        }

        $producto->load('media');

        return response()->json($response);
    }
    

    //Función para buscar dato por su id y mostrar
    public function show($id) {
        // Buscar la asistencia por su ID
        $producto = Producto::with('media')->find($id);

        // Verificar si se encontró la asistencia
        if (!$producto) {
            $response = [
                'success' => false,
                'message' => 'Producto no encontrado',
                'data' => null
            ];
            return response()->json($response, 404);
        }

        // Si se encontró el producto, retornarlo en la respuesta JSON
        $response = [
            'success' => true,
            'message' => 'Producto encontrado',
            'data' => $producto
        ];
        return response()->json($response);
    }


    //Función para eliminar un producto de la BBDD
    public function destroy($id){

        $producto = Producto::find($id);
        $producto->delete();
        return response()->json(['success' => true, 'message' => 'Producto eliminado correctamente']);
    }
}

