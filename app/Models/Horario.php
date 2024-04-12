<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = ['id','dia','hora_inicio','hora_fin'];

      //Al crear las relaciones entre tablas podremos recoger diferentes datos para mostrar en la vista
      //Relación uno a muchos con la tabla Dia
      public function dia()
      {
          return $this->belongsTo(Dia::class,'dia');
      }
}
