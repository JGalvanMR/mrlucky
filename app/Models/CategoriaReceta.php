<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaReceta extends Model
{
    use HasFactory;
    protected $table = 'categorias_recetas';
    protected $fillable = ['nombre', 'orden', 'activo', 'idioma_id'];

    /*----------  Recetas  ----------*/
    public function recetas(){
        return $this->hasMany(Receta::class, 'categoria_id');
    }

    /*----------  Idioma  ----------*/
    public function idioma(){
        return $this->belongsTo(Idioma::class, 'idioma_id');
    }
}
