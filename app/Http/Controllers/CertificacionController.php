<?php

namespace App\Http\Controllers;

use App\Models\Certificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CertificacionController extends Controller
{
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
     * @return StreamedResponse
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
            ?? 'certificado-' . $certificacion->rancho->slug . '.pdf';

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
     * @return void
     */
    public static function invalidarCache(string $tipo = 'primusgfs'): void
    {
        Cache::forget("mosaico.{$tipo}.publico");
        Cache::forget("tipo_cert.{$tipo}");
    }
}
