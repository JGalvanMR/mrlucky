<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;
    protected $table = 'vacantes';
    protected $fillable = ['titulo', 'slug', 'imagen', 'requisitos', 'ofrecemos', 'orden', 'activo', 'idioma_id'];

    /*----------  Subsection comment block  ----------*/

}
