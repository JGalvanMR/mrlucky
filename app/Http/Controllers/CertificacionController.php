<?php

namespace App\Http\Controllers;

use App\Models\Certificacion;
use App\Models\TipoCertificacion;
use App\Models\Rancho;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CertificacionController extends Controller
{
    /**
     * Endpoint AJAX — Mosaico de ranchos con certificación PrimusGFS.
     *
     * Rutas registradas:
     *   GET /compromiso/primusgfs         → es.certificaciones.primusgfs
     *   GET /en/commitment/primusgfs      → en.certificaciones.primusgfs
     *
     * Llamado por jQuery al abrirse el modal Bootstrap en compromiso.blade.php.
     * La respuesta es JSON con el HTML del partial renderizado en el servidor.
     */
    public function primusGFS(Request $request): JsonResponse
    {
        return $this->mosaicoPorTipo('primusgfs', $request);
    }

    /**
     * Endpoint genérico por slug de tipo de certificación.
     *
     * Listo para GlobalGAP, USDA Organic, etc. sin tocar más código:
     * solo se agregan filas en tipos_certificacion y nuevos botones en la vista.
     *
     * Ruta:
     *   GET /compromiso/cert/{tipo}       → es.certificaciones.tipo
     *
     * @param  string   $tipo     Slug del tipo (ej: "primusgfs", "globalgap")
     * @param  Request  $request
     */
    public function mosaicoPorTipo(string $tipo, Request $request): JsonResponse
    {
        // Esta ruta solo responde a peticiones AJAX — bloquea acceso directo por URL
        abort_unless($request->ajax(), 403, 'Acceso no permitido.');

        // Cache del tipo de certificación (casi estático, TTL: 1 hora)
        $tipoCertificacion = Cache::remember("tipo_cert.{$tipo}", 3600, function () use ($tipo) {
            return TipoCertificacion::where('slug', $tipo)
                                    ->where('activo', true)
                                    ->firstOrFail();
        });

        // Cache del mosaico completo (TTL: 30 minutos)
        // Se invalida manualmente con invalidarCache() al editar desde el admin.
        $cacheKey = "mosaico.{$tipo}.publico";

        $ranchos = Cache::remember($cacheKey, 1800, function () use ($tipoCertificacion) {
            return Rancho::activos()
                ->conCertificacionTipo($tipoCertificacion->id)
                ->with([
                    // Eager loading optimizado: solo la certificación más reciente
                    // de este tipo para cada rancho. Evita N+1 queries.
                    'certificacion' => function ($query) use ($tipoCertificacion) {
                        $query->where('tipo_certificacion_id', $tipoCertificacion->id)
                              ->where('visible_publico', true)
                              ->orderByDesc('fecha_vencimiento');
                            //   ->limit(1);
                    },
                ])
                ->get()
                ->map(function (rancho $rancho) {
                    // adjuntar la certificación relevante directamente al objeto rancho
                    // para acceso limpio en la vista: $rancho->cert
                    $rancho->cert = $rancho->certificacion->first();
                    return $rancho;
                });
        });

        // Renderizar el partial en el servidor y enviarlo como HTML en JSON
        $html = view(
            'site.partials.certificados-mosaico',
            compact('ranchos', 'tipoCertificacion')
        )->render();

        return response()->json([
            'html'     => $html,
            'total'    => $ranchos->count(),
            'vigentes' => $ranchos->filter(fn($r) => $r->cert?->es_vigente)->count(),
        ]);
    }

    /**
     * Descarga protegida de certificado PDF.
     *
     * SEGURIDAD:
     *  - Los PDFs están en storage/app/private/certificados/ (disco 'private').
     *  - Nunca son accesibles por URL directa desde el navegador.
     *  - Este método valida visible_publico antes de servir cualquier archivo.
     *  - Laravel Route Model Binding carga el Certificacion por ID.
     *
     * Ruta:
     *   GET /certificaciones/descargar/{certificacion}  → certificaciones.descargar
     *
     * @param  Certificacion  $certificacion  Inyectado por Route Model Binding
     */
    public function descargar(Certificacion $certificacion): StreamedResponse
    {
        abort_unless(
            $certificacion->visible_publico,
            403,
            'Este certificado no está disponible para descarga pública.'
        );

        abort_unless(
            $certificacion->pdf_path && Storage::disk('private')->exists($certificacion->pdf_path),
            404,
            'El archivo de certificado no fue encontrado.'
        );

        // Nombre de descarga: usa el nombre original si existe,
        // o construye uno legible a partir del slug del rancho.
        $nombreDescarga = $certificacion->pdf_nombre_original
            ?? 'certificado-primusgfs-' . $certificacion->rancho->slug . '.pdf';

        return Storage::disk('private')->download(
            $certificacion->pdf_path,
            $nombreDescarga,
            ['Content-Type' => 'application/pdf']
        );
    }

    /**
     * Invalida el cache del mosaico de un tipo de certificación.
     *
     * Llamar desde RanchoController cada vez que se cree, edite
     * o elimine un rancho o certificación desde el admin.
     *
     * @param  string  $tipo  Slug del tipo (default: 'primusgfs')
     */
    public static function invalidarCache(string $tipo = 'primusgfs'): void
    {
        Cache::forget("mosaico.{$tipo}.publico");
        Cache::forget("tipo_cert.{$tipo}");
    }
}
