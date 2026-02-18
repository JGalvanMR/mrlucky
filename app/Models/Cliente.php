<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $fillable = ['nombre', 'apellido_paterno', 'apellido_materno', 'fecha_nacimiento', 'genero', 'rfc', 'curp', 'correo', 'telefono', 'direccion', 'colonia', 'codigo_postal', 'ciudad_id', 'asesor_id', 'foto', 'ine_frontal', 'ine_reverso'];

    /*----------  Ciudad  ----------*/
    public function ciudad(){
        return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }

    /*----------  Pólizas  ----------*/
    public function polizas(){
        return $this->hasMany(Poliza::Class, 'cliente_id');
    }

}
