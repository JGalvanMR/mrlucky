<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    
    protected $table = 'productos';
    protected $fillable = ['titulo', 'slug', 'imagen', 'descripcion', 'nutricion', 'usos', 'conservacion', 'orden', 'activo', 'ficha', 'tabla_nutrimental', 'categoria_id'];

    /*----------  Categoría  ----------*/
    public function categoria(){
        return $this->belongsTo(CategoriaProducto::class, 'categoria_id');
    }

    /*----------  Imágenes  ----------*/
    public function imagenes(){
        return $this->hasMany(Imagen::class, 'producto_id')->orderBy('orden', 'ASC');
    }
}
