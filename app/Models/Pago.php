<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    
    protected $table = 'pagos';
    protected $fillable = ['monto', 'fecha_pago', 'estatus', 'metodo_pago', 'comprobante', 'comentario', 'vigencia_id'];

    /*----------  Vigencia  ----------*/
    public function vigencia(){
        return $this->belongsTo(Vigencia::class, 'vigencia_id');
    }
}
