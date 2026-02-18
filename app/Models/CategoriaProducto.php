<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{
    use HasFactory;
    protected $table = 'categorias_productos';
    protected $fillable = ['nombre', 'slug', 'banner', 'orden', 'activo', 'idioma_id'];

    /*----------  Productos  ----------*/
    public function productos(){
        return $this->hasMany(Producto::class, 'categoria_id');
    }

    /*----------  Idioma  ----------*/
    public function idioma(){
        return $this->belongsTo(Idioma::class, 'idioma_id');
    }
}
