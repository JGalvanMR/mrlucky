<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenSiniestro extends Model
{
    use HasFactory;
    protected $table = 'imagenes_siniestro';
    protected $fillable = ['imagen', 'siniestro_id'];

    /*----------  Siniestro  ----------*/
    public function siniestro(){
        return $this->belongsTo(ImagenSiniestro::class, 'siniestro_id');
    }
}
