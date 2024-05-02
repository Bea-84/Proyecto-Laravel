<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nombre', 'descripcion'];

    protected $table = 'actividades';

    
      //Al crear las relaciones entre tablas podremos recoger diferentes datos para mostrar en la vista
      //Relación uno a muchos con la tabla Dia
     
}
