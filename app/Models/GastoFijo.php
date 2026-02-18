<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastoFijo extends Model
{
    use HasFactory;
    protected $table = 'gastos_fijos';
    protected $fillable = ['concepto', 'monto', 'fecha', 'descripcion'];
}
