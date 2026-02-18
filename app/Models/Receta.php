<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;
    protected $table = 'recetas';
    protected $fillable = ['titulo', 'slug', 'imagen', 'ingredientes', 'contenido', 'tiempo', 'coccion', 'porciones', 'orden', 'activo', 'idioma_id', 'categoria_id'];

    /*----------  Idioma  ----------*/
    public function idioma(){
        return $this->belongsTo(Idioma::class, 'idioma_id');
    }

    /*----------  Categoria  ----------*/
    public function categoria(){
        return $this->belongsTo(CategoriaReceta::class, 'categoria_id');
    }

    /*----------  Ingredientes  ----------*/
    public function ingredientes(){
        return $this->belongsToMany(Ingrediente::class, 'ingrediente_receta');
    }

}
