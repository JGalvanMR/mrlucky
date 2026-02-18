<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vigencia extends Model
{
    use HasFactory;
    protected $table = 'vigencias';
    protected $fillable = ['fecha_inicio', 'fecha_fin', 'monto', 'fecha_vencimiento', 'estatus', 'poliza_id'];

    /*----------  Póliza  ----------*/
    public function poliza(){
        return $this->belongsTo(Poliza::class, 'poliza_id');
    }

    /*----------  Pagos  ----------*/
    public function pagos(){
        return $this->hasMany(Pago::class, 'vigencia_id');
    }

    /*----------  Facturas  ----------*/
    public function facturas(){
        return $this->hasMany(Factura::class, 'vigencia_id');
    }
}
