<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    use HasFactory;
    protected $table = 'idiomas';
    protected $fillable = ['nombre', 'clave', 'principal', 'orden', 'activo'];

    /*----------  Preguntas  ----------*/
    public function preguntas(){
        return $this->hasMany(Pregunta::class, 'idioma_id');
    }

    /*----------  Slides  ----------*/
    public function slides(){
        return $this->hasMany(Slide::class, 'idioma_id');
    }
}
