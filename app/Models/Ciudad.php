<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;
    protected $table = 'ciudades';
    protected $fillable = ['ciudad', 'estado_id'];

    /*----------  Estado  ----------*/
    public function estado(){
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    /*----------  Proveedores  ----------*/
    public function proveedores(){
        return $this->hasMany(Proveedor::class, 'ciudad_id');
    }
}
