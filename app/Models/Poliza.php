<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliza extends Model
{
    use HasFactory;
    protected $table = 'polizas';
    protected $fillable = ['num_poliza', 'precio', 'vigencia_inicio', 'vigencia_fin', 'tipo_cliente', 'tipo_id', 'modelo', 'color', 'placas', 'num_serie', 'num_motor', 'cobertura', 'capacidad', 'cliente_id', 'estatus', 'tipo', 'zona_id', 'asesor_id'];

    /*----------  Cliente  ----------*/
    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    /*----------  Vigencias  ----------*/
    public function vigencias(){
        return $this->hasMany(Vigencia::class, 'poliza_id');  
    }

    /*----------  Choferes  ----------*/
    public function choferes(){
        return $this->hasMany(Chofer::class, 'poliza_id');
    }

    /*----------  Asistencias  ----------*/
    public function asistencias(){
        return $this->hasMany(Asistencia::class, 'poliza_id');
    }

    /*----------  Siniestros  ----------*/
    public function siniestros(){
        return $this->hasMany(Siniestro::class, 'poliza_id');
    }

    /*----------  Tipo  ----------*/
    public function submarca(){
        return $this->belongsTo(Tipo::class, 'tipo_id');
    }

    /*----------  Imagenes  ----------*/
    public function imagenes(){
        return $this->hasMany(Imagen::class, 'poliza_id');
    }

    /*----------  Zona  ----------*/
    public function zona(){
        return $this->belongsTo(Zona::class, 'zona_id');
    }

    /*----------  Asesor  ----------*/
    public function asesor(){
        return $this->belongsTo(User::class, 'asesor_id');
    }


}
