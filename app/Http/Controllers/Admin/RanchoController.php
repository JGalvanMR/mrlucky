<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CertificacionController;
use App\Models\Rancho;
use App\Models\TipoCertificacion;
use App\Models\Certificaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;

class RanchoController extends Controller
{
    // ── Listado ──────────────────────────────────────────────────────────────

    /**
     * Listado de todos los ranchos en el panel admin.
     * Incluye certificaciones para mostrar estado en la tabla.
     */
    public function index()
    {
        $ranchos = Rancho::withTrashed()
                         ->with(['certificaciones.tipoCertificacion'])
                         ->orderBy('orden')
                         ->orderBy('nombre')
                         ->get();

        return view('admin.ranchos.index', compact('ranchos'));
    }

    // ── Agregar ──────────────────────────────────────────────────────────────

    public function agregarForm()
    {
        $tiposCertificacion = TipoCertificacion::activos()->get();

        return view('admin.ranchos.form', compact('tiposCertificacion'));
    }

    public function agregar(Request $request)
    {
        $request->validate([
            'nombre'                => 'required|string|max:150',
            'ubicacion'             => 'required|string|max:200',
            'municipio'             => 'nullable|string|max:100',
            'estado'                => 'nullable|string|max:100',
            'orden'                 => 'nullable|integer|min:0',
            'imagen'                => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            // Certificación (opcional al crear)
            'tipo_certificacion_id' => 'nullable|exists:tipos_certificacion,id',
            'numero_certificado'    => 'nullable|string|max:100',
            'fecha_emision'         => 'nullable|required_with:tipo_certificacion_id|date',
            'fecha_vencimiento'     => 'nullable|required_with:tipo_certificacion_id|date|after:fecha_emision',
            'organismo_auditor'     => 'nullable|string|max:200',
            'pdf'                   => 'nullable|mimes:pdf|max:20480',
        ]);

        $rancho = new Rancho($request->only([
            'nombre', 'ubicacion', 'municipio', 'estado', 'orden',
        ]));
        $rancho->activo = $request->boolean('activo', true);
        $rancho->slug   = Str::slug($request->nombre);

        // Subir imagen a disco público
        if ($request->hasFile('imagen')) {
            $rancho->imagen = $request->file('imagen')->store('ranchos', 'public');
        }

        $rancho->save();

        // Crear certificación asociada si se proporcionó
        if ($request->filled('tipo_certificacion_id')) {
            $this->guardarCertificacion($rancho, $request);
        }

        // Invalidar cache del mosaico público
        CertificacionController::invalidarCache();

        return redirect()
            ->route('admin.ranchos')
            ->with('success', 'Rancho agregado correctamente.');
    }

    // ── Editar ───────────────────────────────────────────────────────────────

    public function editarForm(string $hash_id)
    {
        $id     = Hashids::decode($hash_id)[0] ?? abort(404);
        $rancho = Rancho::with(['certificaciones.tipoCertificacion'])->findOrFail($id);
        $tiposCertificacion = TipoCertificacion::activos()->get();

        return view('admin.ranchos.form', compact('rancho', 'tiposCertificacion'));
    }

    public function editar(Request $request, string $hash_id)
    {
        $id     = Hashids::decode($hash_id)[0] ?? abort(404);
        $rancho = Rancho::findOrFail($id);

        $request->validate([
            'nombre'    => 'required|string|max:150',
            'ubicacion' => 'required|string|max:200',
            'municipio' => 'nullable|string|max:100',
            'estado'    => 'nullable|string|max:100',
            'orden'     => 'nullable|integer|min:0',
            'imagen'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $rancho->fill($request->only(['nombre', 'ubicacion', 'municipio', 'estado', 'orden']));
        $rancho->activo = $request->boolean('activo', true);

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior del disco antes de subir la nueva
            if ($rancho->imagen) {
                Storage::disk('public')->delete($rancho->imagen);
            }
            $rancho->imagen = $request->file('imagen')->store('ranchos', 'public');
        }

        $rancho->save();

        CertificacionController::invalidarCache();

        return redirect()
            ->route('admin.ranchos')
            ->with('success', 'Rancho actualizado correctamente.');
    }

    // ── Eliminar (SoftDelete) ─────────────────────────────────────────────────

    public function eliminar(string $hash_id)
    {
        $id     = Hashids::decode($hash_id)[0] ?? abort(404);
        $rancho = Rancho::findOrFail($id);
        $rancho->delete(); // SoftDelete — no elimina físicamente

        CertificacionController::invalidarCache();

        return redirect()
            ->route('admin.ranchos')
            ->with('success', 'Rancho eliminado correctamente.');
    }

    // ── Subida de imagen (AJAX) ───────────────────────────────────────────────

    /**
     * Subir imagen de un rancho vía AJAX desde el formulario admin.
     * Responde con la URL pública para previsualización inmediata.
     */
    public function subirImagen(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $path = $request->file('imagen')->store('ranchos', 'public');

        return response()->json([
            'path' => $path,
            'url'  => asset('storage/' . $path),
        ]);
    }

    // ── Subida/Edición de certificación ──────────────────────────────────────

    /**
     * Crea o actualiza la certificación de un rancho para un tipo dado.
     * updateOrCreate garantiza que no se dupliquen filas para el mismo
     * rancho + tipo. Guarda el PDF en disco privado si se proporciona.
     *
     * @param  Rancho   $rancho
     * @param  Request  $request
     */
    private function guardarCertificacion(Rancho $rancho, Request $request): void
    {
        $cert = Certificacion::updateOrCreate(
            [
                'rancho_id'             => $rancho->id,
                'tipo_certificacion_id' => $request->tipo_certificacion_id,
            ],
            [
                'numero_certificado' => $request->numero_certificado,
                'fecha_emision'      => $request->fecha_emision,
                'fecha_vencimiento'  => $request->fecha_vencimiento,
                'organismo_auditor'  => $request->organismo_auditor,
                'estado'             => $request->estado ?? 'vigente',
                'visible_publico'    => $request->boolean('visible_publico', true),
                'notas'              => $request->notas,
            ]
        );

        // PDF: se guarda en disco PRIVADO — nunca accesible por URL directa
        if ($request->hasFile('pdf')) {
            // Eliminar PDF anterior si existe
            if ($cert->pdf_path) {
                Storage::disk('private')->delete($cert->pdf_path);
            }

            $archivo = $request->file('pdf');
            $cert->pdf_nombre_original = $archivo->getClientOriginalName();
            $cert->pdf_path = $archivo->store('certificados', 'private');
            $cert->save();
        }
    }
}
