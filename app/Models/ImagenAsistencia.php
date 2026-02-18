<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenAsistencia extends Model
{
    use HasFactory;
    protected $table = 'imagenes_asistencia';
    protected $fillable = ['imagen', 'asistencia_id'];

    /*----------  Asistencia  ----------*/
    public function asistencia(){
        return $this->belongsTo(Asistencia::class, 'asistencia_id');
    }
}
