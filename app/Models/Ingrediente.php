<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;
    protected $table = 'ingredientes';
    protected $fillable = ['nombre', 'orden', 'idioma_id'];

    /*----------  Recetas  ----------*/
    public function recetas(){
        return $this->belongsToMany(Receta::class, 'ingrediente_receta');
    }

    /*----------  Idioma  ----------*/
    public function idioma(){
        return $this->belongsTo(Idioma::class, 'idioma_id');
    }
}
