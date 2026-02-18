<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodoAdministrativo extends Model
{
    use HasFactory;

    protected $table = 'periodos_administrativos';
    protected $fillable = ['ano', 'mes', 'estatus'];

    /*----------  Gastos  ----------*/
    public function gastos(){
    	return $this->hasMany(Gasto::class, 'periodo_id');
    }
}
