<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;
    protected $table = 'expedientes';
    protected $fillable = ['documento', 'siniestro_id'];

    /*----------  Siniestro  ----------*/
    public function siniestro(){
        return $this->belongsTo(Siniestro::class, 'siniestro_id');
    }
}
