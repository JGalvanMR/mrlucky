<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class TipoCertificacion extends Model
{
    protected $table = 'tipos_certificacion';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'logo_path',
        'color_hex',
        'sitio_web',
        'activo',
        'orden',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    // ── Relaciones ───────────────────────────────────────────────────────────

    /**
     * Todas las certificaciones emitidas bajo este tipo.
     */
    public function certificaciones(): HasMany
    {
        return $this->hasMany(Certificacion::class);
    }

    // ── Scopes ───────────────────────────────────────────────────────────────

    /**
     * Solo tipos de certificación activos, ordenados por campo 'orden'.
     */
    public function scopeActivos($query)
    {
        return $query->where('activo', true)->orderBy('orden');
    }

    // ── Accessors ────────────────────────────────────────────────────────────

    /**
     * URL pública del logo del organismo certificador.
     * Retorna null si no hay logo cargado (la vista tiene fallback de texto).
     */
    public function getLogoUrlAttribute(): ?string
    {
        if ($this->logo_path && Storage::disk('public')->exists($this->logo_path)) {
            return asset('storage/' . $this->logo_path);
        }

        return null;
    }
}
