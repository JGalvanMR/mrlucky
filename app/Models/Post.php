<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ['titulo', 'slug', 'imagen', 'fecha', 'contenido', 'orden', 'activo', 'destacado', 'idioma_id'];

    /*----------  Idioma  ----------*/
    public function idioma(){
        return $this->belongsTo(Idioma::class, 'idioma_id');
    }
}
