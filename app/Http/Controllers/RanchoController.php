<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rancho;
use App\Models\TipoCertificacion;
use App\Models\Certificacion;
use App\Http\Controllers\CertificacionController;
use Hashids;
use Storage;
use File;
use Str;

class RanchoController extends Controller
{
    /*----------  Listado  ----------*/
    public function index()
    {
        $ranchos = Rancho::withTrashed()
                         ->with(['certificacion.tipoCertificacion'])
                         ->orderBy('orden', 'ASC')
                         ->orderBy('nombre', 'ASC')
                         ->get();

        return view('admin.modules.ranchos.index', compact('ranchos'));
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm()
    {
        $tiposCertificacion = TipoCertificacion::where('activo', true)
                                               ->orderBy('orden', 'ASC')
                                               ->get();

        return view('admin.modules.ranchos.agregar', compact('tiposCertificacion'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request)
    {
        $rancho = new Rancho;
        $data   = $request->all();

        // Imagen — se sube por separado vía subirImagen(), llega como campo hidden
        $data['imagen'] = str_replace(',', '', $request->imagen);

        if (!$request->activo) {
            $data['activo'] = '0';
        }

        // Auto-slug único: si 'rancho-de-prueba' ya existe genera 'rancho-de-prueba-2', etc.
        $slugBase = Str::slug($request->nombre);
        $slug     = $slugBase;
        $i        = 2;
        while (Rancho::withTrashed()->where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $i++;
        }
        $data['slug'] = $slug;

        $rancho->create($data);

        // Crear certificación si se proporcionó tipo
        if ($request->tipo_certificacion_id) {
            $this->guardarCertificacion($rancho, $request);
        }

        CertificacionController::invalidarCache();

        return ['titulo' => 'Agregar Rancho', 'msg' => 'El rancho ha sido agregado.', 'class' => 'success'];
    }

    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id)
    {
        $rancho             = Rancho::with(['certificacion.tipoCertificacion'])
                                    ->findOrFail(Hashids::decode($hash_id)[0]);
        $tiposCertificacion = TipoCertificacion::where('activo', true)
                                               ->orderBy('orden', 'ASC')
                                               ->get();

        return view('admin.modules.ranchos.editar', compact('rancho', 'tiposCertificacion'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request)
    {
        $rancho = Rancho::findOrFail(Hashids::decode($hash_id)[0]);
        $data   = $request->all();

        $data['imagen'] = str_replace(',', '', $request->imagen);

        if (!$request->activo) {
            $data['activo'] = '0';
        }

        $rancho->update($data);

        // Actualizar/crear certificación si se proporcionó tipo
        if ($request->tipo_certificacion_id) {
            $this->guardarCertificacion($rancho, $request);
        }

        CertificacionController::invalidarCache();

        return ['titulo' => 'Editar Rancho', 'msg' => 'El rancho ha sido editado.', 'class' => 'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id)
    {
        $rancho = Rancho::findOrFail(Hashids::decode($hash_id)[0]);
        $rancho->delete(); // SoftDelete

        CertificacionController::invalidarCache();

        return ['titulo' => 'Eliminar Rancho', 'msg' => 'El rancho ha sido eliminado.', 'class' => 'success'];
    }

    /*----------  Subir Imagen  ----------*/
    public function subirImagen(Request $request)
    {
        $disk   = Storage::disk('uploads');
        $folder = 'ranchos/imagenes/';

        // Compatible con agregar (imagenInput via x-file-input)
        // y editar (imagenFileInput via bootstrap-fileinput)
        $file     = $request->file('imagenInput') ?? $request->file('imagenFileInput');
        $filename = $folder . time() . '-' . $file->getClientOriginalName();

        if (!file_exists(public_path('uploads') . '/' . $folder)) {
            mkdir(public_path('uploads') . '/' . $folder, 0777, true);
        }

        $disk->put($filename, File::get($file));

        return response()->json(['imagen' => $filename]);
    }

    /*----------  Eliminar Imagen  ----------*/
    public function eliminarImagen(Request $request)
    {
        $disk   = Storage::disk('uploads');
        $rancho = Rancho::findOrFail(Hashids::decode($request->rancho_id)[0]);
        $imagen = $rancho->imagen;

        $rancho->imagen = '';
        $rancho->save();
        $disk->delete($imagen);

        return ['titulo' => 'Eliminar imagen', 'msg' => 'La imagen ha sido eliminada.', 'class' => 'success'];
    }

    /*----------  Subir PDF (disco privado)  ----------*/
    public function subirPdf(Request $request)
    {
        // El input en la vista se llama 'pdfFileInput' (nombre del <input type="file">)
        $file     = $request->file('pdfFileInput');
        $folder   = 'certificados/';
        $filename = $folder . time() . '-' . $file->getClientOriginalName();

        // Crear directorio si no existe
        if (!file_exists(storage_path('app/private/' . $folder))) {
            mkdir(storage_path('app/private/' . $folder), 0777, true);
        }

        Storage::disk('private')->put($filename, File::get($file));

        return response()->json([
            'pdf'                 => $filename,
            'pdf_nombre_original' => $file->getClientOriginalName(),
        ]);
    }

    /*----------  Eliminar PDF  ----------*/
    public function eliminarPdf(Request $request)
    {
        $cert = Certificacion::findOrFail(Hashids::decode($request->cert_id)[0]);

        Storage::disk('private')->delete($cert->pdf_path);
        $cert->pdf_path            = null;
        $cert->pdf_nombre_original = null;
        $cert->save();

        CertificacionController::invalidarCache();

        return ['titulo' => 'Eliminar PDF', 'msg' => 'El PDF ha sido eliminado.', 'class' => 'success'];
    }

    /*----------  Guardar Certificación  ----------*/
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
                'estado'             => $request->estado_cert ?? 'vigente',
                'visible_publico'    => $request->visible_publico ? true : false,
                'notas'              => $request->notas,
            ]
        );

        // El PDF llega como campo hidden (subido por subirPdf())
        if ($request->filled('pdf_path')) {
            // Borrar PDF anterior
            if ($cert->pdf_path) {
                Storage::disk('private')->delete($cert->pdf_path);
            }
            $cert->pdf_path            = $request->pdf_path;
            $cert->pdf_nombre_original = $request->pdf_nombre_original;
            $cert->save();
        }
    }
}
