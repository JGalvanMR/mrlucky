<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $table = 'preguntas';
    protected $fillable = ['pregunta', 'respuesta', 'orden', 'activo', 'idioma_id'];

    /*----------  Idioma  ----------*/
    public function idioma(){
        return $this->belongsTo(Idioma::class, 'idioma_id');
    }

}
