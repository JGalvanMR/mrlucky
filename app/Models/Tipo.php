<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;
    protected $table = 'tipos';
    protected $fillable = ['nombre', 'orden', 'activo', 'marca_id'];

    /*----------  Marca  ----------*/
    public function marca(){
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    /*----------  Polizas  ----------*/
    public function polizas(){
        return $this->hasMany(Poliza::class, 'tipo_id');
    }
}
