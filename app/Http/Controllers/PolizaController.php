<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Poliza;
use App\Models\Marca;
use App\Models\Imagen;
use Hashids;
use Storage;
use DB;

class PolizaController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        $polizas = Poliza::all();
        return view('admin.modules.polizas.index', compact('polizas'));
    }

    /*----------  Agregar form  ----------*/
    public function agregarForm(){
        $clientes = Cliente::all();
        $marcas = Marca::where('activo', '1')->orderBy('orden', 'ASC')->get();
        return view('admin.modules.polizas.agregar', compact('clientes', 'marcas'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $poliza = new Poliza;
        $data = $request->all();

        /*----------  Consecutivo  ----------*/
        $config = new \Larapack\ConfigWriter\Repository('rentas');
        $prefijo =  $config->get('prefijo_polizas');

        $ultimo = Poliza::where(DB::raw('YEAR(created_at)'), date('Y'))->orderBy('id', 'DESC')->first();

        if($ultimo){
            $consecutivo = substr($ultimo->num_poliza,-4, 4);
            $consecutivo = str_pad((int)$consecutivo + 1, 4, '0', STR_PAD_LEFT);
        }else{
            $consecutivo = str_pad(1, 4, '0', STR_PAD_LEFT);
        }

        $data['num_poliza'] = $prefijo.date('y').date('m').$consecutivo;


        $poliza->create($data);

        return ['titulo'=>'Agregar Póliza', 'msg'=>'La póliza ha sido agregada.', 'class'=>'success'];
    }

    /*----------  Ver  ----------*/
    public function ver($hash_id){
        $poliza = Poliza::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.polizas.ver', compact('poliza'));
    }

    /*----------  Editar form  ----------*/
    public function editarForm($hash_id){
        $clientes = Cliente::all();
        $marcas = Marca::where('activo', '1')->orderBy('orden', 'ASC')->get();
        $poliza = Poliza::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.polizas.editar', compact('clientes', 'marcas', 'poliza'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $poliza = Poliza::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();
        $poliza->update($data);

        return ['titulo'=>'Editar Póliza', 'msg'=>'La póliza ha sido editada.', 'class'=>'success'];
    }

    /*----------  Agregar Imagen  ----------*/
    public function agregarImagen(Request $request){
        
        $imagenes = explode(',', $request->imagen);

        foreach($imagenes as $imagen){

            if($imagen != ''){
                $img = new Imagen;
                $img->imagen = $imagen;
                $img->poliza_id = $request->poliza_id;
                $img->save();
            }

        }

        return ['titulo'=>'Agregar imágenes', 'msg'=>'Las imágenes han sido agregadas.', 'class'=>'success'];
    }

    /*----------  Eliminar imagen  ----------*/
    public function eliminarImagen($hash_id){
        $imagen = Imagen::findOrFail(Hashids::decode($hash_id)[0]);
        $disk = Storage::disk('uploads');
        $img = $imagen->imagen;
        $imagen->delete();
        $disk->delete($img);

        return ['titulo'=>'Eliminar imagen', 'msg'=>'La imagen ha sido eliminada.', 'class'=>'success'];

    }

    /*----------  Imprimir  ----------*/
    public function imprimir($hash_id){
        $poliza = Poliza::findOrFail(Hashids::decode($hash_id)[0]);

        switch($poliza->cobertura){
            case '1':
                $cobertura = 'amplia';
                break;
            case '2':
                $cobertura = 'intermedia';
                break;
            case '3':
                $cobertura = 'terceros-a';
                break;
            case '4':
                $cobertura = 'terceros-b';
                break;
            case '5':
                $cobertura = 'terceros-c';
                break;
        }

        return view('admin.modules.polizas.imprimir-'.$cobertura, compact('poliza'));
    }
}
