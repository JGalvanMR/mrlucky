<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SolicitudDescargaCertificado extends Model
{
    protected $table = 'solicitudes_descarga_certificado';

    protected $fillable = [
        'certificacion_id',
        'nombre',
        'puesto',
        'empresa',
        'correo',
        'telefono',
        'contacto_gab',
        'uso',
        'ip_origen',
        'estado_envio',
        'error_detalle',
    ];

    public function certificacion(): BelongsTo
    {
        return $this->belongsTo(Certificacion::class, 'certificacion_id');
    }
}
