<?php

namespace App\Http\Controllers;

use App\Mail\SolicitudDescargaCertificadoMail;
use App\Models\Certificacion;
use App\Models\SolicitudDescargaCertificado;
use App\Http\Requests\SolicitudDescargaCertificadoRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CertificacionController extends Controller
{
    /**
     * Visor protegido del certificado (SOLO LECTURA / "inline").
     *
     * Requerimiento de Gerencia: los certificados se pueden consultar
     * libremente, pero NO deben poder descargarse directamente desde la
     * interfaz pública. Este método sirve el PDF con
     * `Content-Disposition: inline`, para que el navegador lo muestre en el
     * visor en lugar de descargarlo, y nunca expone una ruta pública directa
     * al archivo (el archivo vive en el disco 'private', fuera de /public).
     *
     * LIMITACION CONOCIDA (ver punto 11 del requerimiento): esto no impide
     * al 100% que alguien capture o guarde el documento mostrado en pantalla
     * (por ejemplo con "Imprimir como PDF" del navegador). Lo que si se logra
     * es eliminar el boton de descarga directa, el enlace publico al archivo
     * original y la ruta publica obvia hacia el documento.
     */
    public function ver(Certificacion $certificacion): StreamedResponse
    {
        abort_unless(
            $certificacion->visible_publico,
            403,
            'Este certificado no esta disponible para consulta publica.'
        );

        abort_unless(
            $certificacion->pdf_path && Storage::disk('private')->exists($certificacion->pdf_path),
            404,
            'El archivo de certificado no fue encontrado.'
        );

        return Storage::disk('private')->response(
            $certificacion->pdf_path,
            null,
            [
                'Content-Type' => 'application/pdf',
                // 'inline' evita que el navegador lo trate como descarga.
                'Content-Disposition' => 'inline; filename="certificado.pdf"',
                'X-Frame-Options' => 'SAMEORIGIN',
                'Cache-Control' => 'private, no-store',
            ]
        );
    }

    /**
     * Muestra el formulario de "Solicitar descarga" para un certificado.
     */
    public function solicitarDescarga(Certificacion $certificacion)
    {
        abort_unless($certificacion->visible_publico, 403);

        $idioma = App::currentLocale();

        return view('site.pages.certificado-solicitud', compact('certificacion', 'idioma'));
    }

    /**
     * Procesa el formulario de solicitud de descarga:
     *  - Valida en backend (nunca confia solo en JS).
     *  - Registra la solicitud (log/tabla) para auditoria.
     *  - Envia el correo a los destinatarios configurados en
     *    config('certificaciones.request_recipients') - nunca a un
     *    destinatario definido por el usuario.
     */
    public function enviarSolicitudDescarga(SolicitudDescargaCertificadoRequest $request, Certificacion $certificacion)
    {
        abort_unless($certificacion->visible_publico, 403);

        $datos = $request->validated();
        unset($datos['website']); // honeypot, no se persiste

        $ipOrigen = $request->ip();

        $registro = SolicitudDescargaCertificado::create([
            'certificacion_id' => $certificacion->id,
            'nombre' => $datos['nombre'],
            'puesto' => $datos['puesto'],
            'empresa' => $datos['empresa'],
            'correo' => $datos['correo'],
            'telefono' => $datos['telefono'],
            'contacto_gab' => $datos['contacto_gab'],
            'uso' => $datos['uso'],
            'ip_origen' => $ipOrigen,
            'estado_envio' => 'enviado',
        ]);

        $destinatarios = config('certificaciones.request_recipients', []);

        try {
            if (empty($destinatarios)) {
                throw new \RuntimeException('No hay destinatarios configurados en CERTIFICATE_REQUEST_RECIPIENTS.');
            }

            $nombreCertificado = $certificacion->rancho->nombre . ' - ' . $certificacion->tipoCertificacion->nombre;

            Mail::to($destinatarios)->send(new SolicitudDescargaCertificadoMail($nombreCertificado, $certificacion->id, $datos));
        } catch (\Throwable $e) {
            $registro->update([
                'estado_envio' => 'error',
                'error_detalle' => $e->getMessage(),
            ]);

            Log::error('Error al enviar solicitud de descarga de certificado', [
                'certificacion_id' => $certificacion->id,
                'solicitud_id' => $registro->id,
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('certificado_error', true);
        }

        return back()->with('certificado_solicitud_enviada', true);
    }

    /**
     * Visor protegido (inline) para el catálogo de certificaciones generales
     * (CCOF, C-TPAT, SQF, Kosher, Fair Trade USA, SMETA), que antes se
     * servían como PDFs públicos descargables directamente desde /public.
     */
    public function verGeneral(string $slug): StreamedResponse
    {
        $catalogo = config('certificaciones.catalogo_general', []);

        abort_unless(isset($catalogo[$slug]), 404, 'Certificado no encontrado.');

        $archivo = $catalogo[$slug]['archivo'];

        abort_unless(Storage::disk('private')->exists($archivo), 404, 'El archivo de certificado no fue encontrado.');

        return Storage::disk('private')->response(
            $archivo,
            null,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $slug . '.pdf"',
                'X-Frame-Options' => 'SAMEORIGIN',
                'Cache-Control' => 'private, no-store',
            ]
        );
    }

    /**
     * Formulario de solicitud de descarga para el catálogo general.
     */
    public function solicitarDescargaGeneral(string $slug)
    {
        $catalogo = config('certificaciones.catalogo_general', []);
        abort_unless(isset($catalogo[$slug]), 404);

        $idioma = App::currentLocale();
        $nombreCertificado = $catalogo[$slug]['nombre'];

        return view('site.pages.certificado-solicitud', [
            'certificacion' => null,
            'slugGeneral' => $slug,
            'nombreCertificado' => $nombreCertificado,
            'idioma' => $idioma,
        ]);
    }

    /**
     * Procesa la solicitud de descarga del catálogo general.
     */
    public function enviarSolicitudDescargaGeneral(SolicitudDescargaCertificadoRequest $request, string $slug)
    {
        $catalogo = config('certificaciones.catalogo_general', []);
        abort_unless(isset($catalogo[$slug]), 404);

        $nombreCertificado = $catalogo[$slug]['nombre'];
        $datos = $request->validated();
        unset($datos['website']);

        $destinatarios = config('certificaciones.request_recipients', []);

        try {
            if (empty($destinatarios)) {
                throw new \RuntimeException('No hay destinatarios configurados en CERTIFICATE_REQUEST_RECIPIENTS.');
            }

            Mail::to($destinatarios)->send(new SolicitudDescargaCertificadoMail($nombreCertificado, $slug, $datos));
        } catch (\Throwable $e) {
            Log::error('Error al enviar solicitud de descarga de certificado general', [
                'slug' => $slug,
                'error' => $e->getMessage(),
            ]);

            return back()->withInput()->with('certificado_error', true);
        }

        return back()->with('certificado_solicitud_enviada', true);
    }

    /**
     * Invalida el cache del mosaico de un tipo de certificacion.
     *
     * Llamar desde RanchoController cada vez que se cree, edite
     * o elimine un rancho o certificacion desde el admin.
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
