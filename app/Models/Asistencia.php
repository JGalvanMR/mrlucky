<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $table = 'asistencias';
    protected $fillable = ['folio', 'fecha', 'tipo', 'tipo_asistencia', 'estatus', 'poliza_id', 'hora_arribo', 'hora_retiro'];

    /*----------  Póliza  ----------*/
    public function poliza(){
        return $this->belongsTo(Poliza::class, 'poliza_id');
    }

    /*----------  Imagenes  ----------*/
    public function imagenes(){
        return $this->hasMany(ImagenAsistencia::class, 'asistencia_id');
    }
}
