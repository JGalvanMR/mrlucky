<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siniestro extends Model
{
    use HasFactory;
    protected $table = 'siniestros';
    protected $fillable = ['num_siniestro', 'fecha', 'hora_arribo', 'hora_retiro', 'comentarios', 'estatus', 'lugar_arribo', 'pase_taller', 'pase_medico', 'declaracion_asegurado', 'declaracion_tercero', 'observaciones_ajustador', 'servicio_grua', 'acuerdo_crucero', 'taller_id', 'poliza_id', 'ajustador_id'];

    /*----------  Afectados  ----------*/
    public function afectados(){
        return $this->hasMany(Afectado::class, 'siniestro_id');
    }

    /*----------  Expedientes  ----------*/
    public function expedientes(){
        return $this->hasMany(Expediente::class, 'siniestro_id');
    }

    /*----------  Póliza  ----------*/
    public function poliza(){
        return $this->belongsTo(Poliza::class, 'poliza_id');
    }

    /*----------  Imagenes Siniestros  ----------*/
    public function imagenes_siniestro(){
        return $this->hasMany(ImagenSiniestro::class, 'siniestro_id');
    }

    /*----------  Imagenes Tercero  ----------*/
    public function imagenes_tercero(){
        return $this->hasMany(ImagenTercero::class, 'siniestro_id');
    }

    /*----------  Taller  ----------*/
    public function taller(){
        return $this->belongsTo(Proveedor::class, 'taller_id');
    }
}
