<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = ['id','user_id','id_registroClase','id_resultadoAsistencia'];

    //Al crear las relaciones entre tablas podremos recoger diferentes datos para mostrar en la vista
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function clase()
    {
        return $this->belongsTo(Clase::class, 'id_registroClase');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_resultadoAsistencia');
    }

}
