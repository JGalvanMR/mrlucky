<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\ImagenAsistencia;
use App\Models\Poliza;
use Hashids;
use Storage;
use DB;

class AsistenciaController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        return view('admin.modules.asistencias.index');
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        $polizas = Poliza::all();
        return view('admin.modules.asistencias.agregar', compact('polizas'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $asistencia = new Asistencia;
        $data = $request->all();

        /*----------  Consecutivo  ----------*/
        $config = new \Larapack\ConfigWriter\Repository('rentas');
        $prefijo =  $config->get('prefijo_asistencias');

        $ultimo = Asistencia::where(DB::raw('YEAR(fecha)'), date('Y'))->orderBy('id', 'DESC')->first();

        if($ultimo){
            $consecutivo = substr($ultimo->folio,-4, 4);
            $consecutivo = str_pad((int)$consecutivo + 1, 4, '0', STR_PAD_LEFT);
        }else{
            $consecutivo = str_pad(1, 4, '0', STR_PAD_LEFT);
        }

         $data['folio'] = $prefijo.date('y').date('m').$consecutivo;

        $asistencia->create($data);
        return ['titulo'=>'Agregar Asistencia', 'msg'=>'La asistencia ha sido agregada.', 'class'=>'success'];
    }

    /*----------  Ver  ----------*/
    public function ver($hash_id){
        $asistencia = Asistencia::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.asistencias.ver', compact('asistencia'));
    }

    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id){
        $asistencia = Asistencia::findOrFail(Hashids::decode($hash_id)[0]);
        $polizas = Poliza::all();
        return view('admin.modules.asistencias.editar', compact('asistencia','polizas'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $asistencia = Asistencia::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();

        $asistencia->update($data);
        return ['titulo'=>'Editar Asistencia', 'msg'=>'La asistencia ha sido editada.', 'class'=>'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $asistencia = Asistencia::findOrFail(Hashids::decode($hash_id)[0]);
        $imagenes = $asistencia->imagenes;
        $disk = Storage::disk('uploads');

        foreach($imagenes as $imagen){
            $img = $imagen->imagen;
            $imagen->delete();
            $disk->delete($img);
        }

        $asistencia->delete();
        return ['titulo'=>'Eliminar Asistencia', 'msg'=>'La asistencia ha sido eliminada.', 'class'=>'success'];
    }

    /*----------  Agregar Imagen  ----------*/
    public function agregarImagen(Request $request){
        
        $imagenes = explode(',', $request->imagen);

        foreach($imagenes as $imagen){

            if($imagen != ''){
                $img = new ImagenAsistencia;
                $img->imagen = $imagen;
                $img->asistencia_id = $request->asistencia_id;
                $img->save();
            }

        }

        return ['titulo'=>'Agregar imágenes', 'msg'=>'Las imágenes han sido agregadas.', 'class'=>'success'];
    }

    /*----------  Eliminar imagen  ----------*/
    public function eliminarImagen($hash_id){
        $imagen = ImagenAsistencia::findOrFail(Hashids::decode($hash_id)[0]);
        $disk = Storage::disk('uploads');
        $img = $imagen->imagen;
        $imagen->delete();
        $disk->delete($img);

        return ['titulo'=>'Eliminar imagen', 'msg'=>'La imagen ha sido eliminada.', 'class'=>'success'];


    }
}
