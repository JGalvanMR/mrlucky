<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Rancho extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'slug',
        'ubicacion',
        'municipio',
        'estado',
        'pais',
        'imagen',
        'activo',
        'orden',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    // ── Boot: generación automática de slug ──────────────────────────────────

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $rancho) {
            if (empty($rancho->slug)) {
                $rancho->slug = Str::slug($rancho->nombre);
            }
        });
    }

    // ── Relaciones ───────────────────────────────────────────────────────────

    /**
     * Todas las certificaciones de este rancho (historial completo).
     */
    public function certificaciones(): HasMany
    {
        return $this->hasMany(Certificacion::class);
    }

    // ── Scopes ───────────────────────────────────────────────────────────────

    /**
     * Ranchos activos, ordenados por campo 'orden' y luego por nombre.
     */
    public function scopeActivos($query)
    {
        return $query->where('activo', true)
                     ->orderBy('orden')
                     ->orderBy('nombre');
    }

    /**
     * Ranchos que tienen al menos una certificación visible de un tipo dado.
     * Usado en la query del mosaico para filtrar antes del eager loading.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $tipoCertificacionId
     */
    public function scopeConCertificacionTipo($query, int $tipoCertificacionId)
    {
        return $query->whereHas('certificaciones', function ($q) use ($tipoCertificacionId) {
            $q->where('tipo_certificacion_id', $tipoCertificacionId)
              ->where('visible_publico', true);
        });
    }

    // ── Accessors ────────────────────────────────────────────────────────────

    /**
     * URL pública de la imagen del rancho.
     * Fallback a una imagen genérica del sitio si no tiene imagen asignada.
     */
    public function getImagenUrlAttribute(): string
    {
        if ($this->imagen && Storage::disk('public')->exists($this->imagen)) {
            return asset('storage/' . $this->imagen);
        }

        // Usa imagen existente del sitio como placeholder
        return asset('site/img/campo-01.jpg');
    }

    /**
     * Ubicación completa formateada: "Municipio, Estado"
     * Omite partes nulas automáticamente.
     */
    public function getUbicacionCompletaAttribute(): string
    {
        return implode(', ', array_filter([
            $this->municipio,
            $this->estado,
        ]));
    }
}
