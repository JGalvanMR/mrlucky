<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    
    protected $table = 'proveedores';
    protected $fillable = ['rfc', 'razon_social', 'alias', 'orden', 'activo', 'tipo', 'ciudad_id'];

    /*----------  Ciudad  ----------*/
    public function ciudad(){
        return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }
}
