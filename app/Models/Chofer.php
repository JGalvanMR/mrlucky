<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    use HasFactory;
    protected $table = 'choferes';
    protected $fillable = ['nombre', 'apellido_paterno', 'apellido_materno', 'fecha_nacimiento', 'genero', 'licencia', 'ine_frontal', 'ine_reverso', 'poliza_id'];

    /*----------  Póliza  ----------*/
    public function poliza(){
        return $this->belongsTo(Poliza::class, 'poliza_id');
    }
}
