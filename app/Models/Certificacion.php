<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificacion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'rancho_id',
        'tipo_certificacion_id',
        'numero_certificado',
        'fecha_emision',
        'fecha_vencimiento',
        'pdf_path',
        'pdf_nombre_original',
        'organismo_auditor',
        'estado',
        'visible_publico',
        'notas',
    ];

    protected $casts = [
        'fecha_emision'     => 'date',
        'fecha_vencimiento' => 'date',
        'visible_publico'   => 'boolean',
    ];

    // ── Relaciones ───────────────────────────────────────────────────────────

    public function rancho(): BelongsTo
    {
        return $this->belongsTo(Rancho::class);
    }

    public function tipoCertificacion(): BelongsTo
    {
        return $this->belongsTo(TipoCertificacion::class, 'tipo_certificacion_id');
    }

    // ── Scopes ───────────────────────────────────────────────────────────────

    /**
     * Solo certificaciones visibles al público.
     */
    public function scopePublicas($query)
    {
        return $query->where('visible_publico', true);
    }

    /**
     * Solo certificaciones vigentes (estado DB + fecha real).
     */
    public function scopeVigentes($query)
    {
        return $query->where('estado', 'vigente')
                     ->where('fecha_vencimiento', '>=', now()->toDateString());
    }

    /**
     * Filtrar por ID de tipo de certificación.
     */
    public function scopePorTipo($query, int $tipoId)
    {
        return $query->where('tipo_certificacion_id', $tipoId);
    }

    // ── Accessors ────────────────────────────────────────────────────────────

    /**
     * Estado real calculado en tiempo de ejecución.
     *
     * Protección contra datos desactualizados: si la fecha de vencimiento
     * ya pasó pero el campo 'estado' sigue siendo 'vigente' en la DB,
     * este accessor devuelve 'vencido' correctamente sin requerir un Job/Cron.
     */
    public function getEstadoRealAttribute(): string
    {
        if ($this->fecha_vencimiento->isPast()) {
            return 'vencido';
        }

        return $this->estado;
    }

    /**
     * ¿El certificado está vigente en este momento?
     */
    public function getEsVigenteAttribute(): bool
    {
        return $this->estado_real === 'vigente';
    }

    /**
     * Días restantes para el vencimiento (0 si ya venció).
     */
    public function getDiasParaVencerAttribute(): int
    {
        if ($this->fecha_vencimiento->isPast()) {
            return 0;
        }

        return (int) now()->diffInDays($this->fecha_vencimiento);
    }

    /**
     * ¿Está próximo a vencer? (menos de 30 días).
     * Activa el badge naranja animado en el mosaico.
     */
    public function getProximoAVencerAttribute(): bool
    {
        return $this->es_vigente && $this->dias_para_vencer <= 30;
    }

    /**
     * URL de descarga del PDF.
     *
     * SIEMPRE apunta al controlador — nunca a una ruta pública directa.
     * El controlador valida visible_publico antes de servir el archivo.
     */
    public function getPdfUrlAttribute(): ?string
    {
        if ($this->pdf_path) {
            return route('certificaciones.descargar', $this->id);
        }

        return null;
    }
}
