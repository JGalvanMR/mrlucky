<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afectado extends Model
{
    use HasFactory;
    protected $table = 'afectados';
    protected $fillable = ['nombre', 'estado', 'implicacion', 'siniestro_id'];

    /*----------  Siniestro  ----------*/
    public function siniestro(){
        return $this->belongsTo(Siniestro::class, 'siniestro_id');
    }
}
