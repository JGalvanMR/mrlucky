<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;
    protected $table = 'zonas';
    protected $fillable = ['zona', 'descripcion', 'cobrador_id'];

    /*----------  Pólizas  ----------*/
    public function polizas(){
        return $this->hasMany(Poliza::class, 'zona_id');
    }

    /*----------  Cobrador  ----------*/
    public function cobrador(){
        return $this->belongsTo(User::class, 'cobrador_id');
    }
}
