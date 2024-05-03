<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    protected $fillable = ['id','actividad_id','fecha','duracion'];

    
      //Al crear las relaciones entre tablas podremos recoger diferentes datos para mostrar en la vista
      //Relación uno a muchos con la tabla actividad
      public function actividad()
      {
          return $this->belongsTo(Actividad::class,'actividad_id');
      }
      
      //Relación de "de muchos a muchos" con tabla user
      public function user()
      {
          return $this->belongsToMany(User::class,'user_clase');
      }
    
     
}
