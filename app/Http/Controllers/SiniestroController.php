<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siniestro;
use App\Models\Poliza;
use App\Models\ImagenSiniestro;
use App\Models\ImagenTercero;
use App\Models\Proveedor;
use Hashids;
use Storage;
use DB;

class SiniestroController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        return view('admin.modules.siniestros.index');
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        $polizas = Poliza::all();
        return view('admin.modules.siniestros.agregar', compact('polizas'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $siniestro = new Siniestro;
        $data = $request->all();

        /*----------  Consecutivo  ----------*/
        $config = new \Larapack\ConfigWriter\Repository('rentas');
        $prefijo =  $config->get('prefijo_siniestros');

        $ultimo = Siniestro::where(DB::raw('YEAR(fecha)'), date('Y'))->orderBy('id', 'DESC')->first();

        if($ultimo){
            $consecutivo = substr($ultimo->num_siniestro,-4, 4);
            $consecutivo = str_pad((int)$consecutivo + 1, 4, '0', STR_PAD_LEFT);
        }else{
            $consecutivo = str_pad(1, 4, '0', STR_PAD_LEFT);
        }

        //$data['num_siniestro'] = $prefijo.date('m').$consecutivo.'-'.date('y');
        $data['num_siniestro'] = $prefijo.date('y').date('m').$consecutivo;
        
        if(auth()->check()){
            $data['ajustador_id'] = auth()->user()->id;
        }

        $sin = $siniestro->create($data);
        return ['titulo'=>'Agregar Siniestro', 'msg'=>'El siniestro ha sido agregado.', 'class'=>'success', 'redirect'=>route('siniestros.ver', ['hash_id'=>Hashids::encode($sin->id)])];
    }

    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id){
        $polizas = Poliza::all();
        $siniestro = Siniestro::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.siniestros.editar', compact('polizas', 'siniestro'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $siniestro = Siniestro::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();

        if(!$request->acuerdo_crucero){
            $data['acuerdo_crucero'] = '0';
        }

        $siniestro->update($data);
        return ['titulo'=>'Editar Siniestro', 'msg'=>'El siniestro ha sido editado.', 'class'=>'success'];
    }

    /*----------  Ver  ----------*/
    public function ver($hash_id){
        $siniestro = Siniestro::findOrFail(Hashids::decode($hash_id)[0]);
        $proveedores = Proveedor::where('tipo','tal')->get();
        return view('admin.modules.siniestros.ver', compact('siniestro', 'proveedores'));
    }

    /*----------  Agregar Imagen  ----------*/
    public function agregarImagen(Request $request){
        
        $imagenes = explode(',', $request->imagen);

        foreach($imagenes as $imagen){

            if($imagen != ''){
                $img = new ImagenSiniestro;
                $img->imagen = $imagen;
                $img->siniestro_id = $request->siniestro_id;
                $img->save();
            }

        }

        return ['titulo'=>'Agregar imágenes', 'msg'=>'Las imágenes han sido agregadas.', 'class'=>'success'];
    }

    /*----------  Eliminar imagen  ----------*/
    public function eliminarImagen($hash_id){
        $imagen = ImagenSiniestro::findOrFail(Hashids::decode($hash_id)[0]);
        $disk = Storage::disk('uploads');
        $img = $imagen->imagen;
        $imagen->delete();
        $disk->delete($img);

        return ['titulo'=>'Eliminar imagen', 'msg'=>'La imagen ha sido eliminada.', 'class'=>'success'];
    }

    /*----------  Agregar Imagen Tercero  ----------*/
    public function agregarImagenTercero(Request $request){
        
        $imagenes = explode(',', $request->imagen_tercero);

        foreach($imagenes as $imagen){

            if($imagen != ''){
                $img = new ImagenTercero;
                $img->imagen = $imagen;
                $img->siniestro_id = $request->siniestro_id;
                $img->save();
            }

        }

        return ['titulo'=>'Agregar imágenes', 'msg'=>'Las imágenes han sido agregadas.', 'class'=>'success'];
    }

    /*----------  Eliminar imagen tercero  ----------*/
    public function eliminarImagenTercero($hash_id){
        $imagen = ImagenTercero::findOrFail(Hashids::decode($hash_id)[0]);
        $disk = Storage::disk('uploads');
        $img = $imagen->imagen;
        $imagen->delete();
        $disk->delete($img);

        return ['titulo'=>'Eliminar imagen', 'msg'=>'La imagen ha sido eliminada.', 'class'=>'success'];
    }

    /*----------  Concluir siniestro  ----------*/
    public function concluir($hash_id, Request $request){
        $siniestro = Siniestro::findOrFail(Hashids::decode($hash_id)[0]);
        
        if(!$siniestro->imagenes_siniestro->count()){
            return ['titulo'=>'Concluir Siniestro', 'msg'=>'Es necesario incluir imágenes del siniestro para poder concluirlo.', 'class'=>'error'];
        }
        
        $data = $request->all();
        $data['estatus'] = 'con';
        $siniestro->update($data);

        return ['titulo'=>'Concluir siniestro', 'msg'=>'El siniestro ha sido concluído.', 'class'=>'success'];
    }

    /*----------  Cerrar siniestro  ----------*/
    public function cerrar($hash_id){
        $siniestro = Siniestro::findOrFail(Hashids::decode($hash_id)[0]);
        $data['estatus'] = 'cer';
        $siniestro->update($data);

        return ['titulo'=>'Cerrar siniestro', 'msg'=>'El siniestro ha sido cerrado.', 'class'=>'success'];
    }
}
