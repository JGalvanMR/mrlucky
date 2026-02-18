<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacante;
use App\Models\Idioma;
use Hashids;
use Storage;
use File;
use Str;

class VacanteController extends Controller
{
    /*----------  listado  ----------*/
    public function index(){
        $vacantes = Vacante::all();
        return view('admin.modules.vacantes.index', compact('vacantes'));
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        $idiomas = Idioma::where('activo','1')->orderBy('orden', 'ASC')->get();
        return view('admin.modules.vacantes.agregar', compact('idiomas'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $vacante = new Vacante;
        $data = $request->all();
        $data['imagen'] = str_replace([','], '', $request->imagen);
        $vacante->create($data);
        return ['titulo'=>'Agregar vacante', 'msg'=>'La vacante ha sido agregada.', 'class'=>'success'];
    }

    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id){
        $idiomas = Idioma::where('activo','1')->orderBy('orden', 'ASC')->get();
        $vacante = Vacante::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.vacantes.editar', compact('idiomas','vacante'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $vacante = Vacante::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();
        $data['imagen'] = str_replace([','], '', $request->imagen);

        if(!$request->activo)
            $data['activo'] = '0';

        $vacante->update($data);
        return ['titulo'=>'Editar vacante', 'msg'=>'La vacante ha sido editada.', 'class'=>'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $vacante = Vacante::findOrFail(Hashids::decode($hash_id)[0]);
        $disk = Storage::disk('uploads');
        $imagen = $vacante->imagen;
        $disk->delete($imagen);
        $vacante->delete();
        return ['titulo'=>'Eliminar vacante', 'msg'=>'La vacante ha sido eliminada.', 'class'=>'success'];
    }

    /*----------  Subir Imagen  ----------*/
    public function subirImagen(Request $request){
        $disk = Storage::disk('uploads');

        $folder = "vacantes/imagenes/";
        $filename = $folder . time() . "-" . $_FILES['imagenInput']['name'];

        // Si no existe la carpeta se crea
        if(!file_exists(public_path('uploads').'/'.$folder)){
            mkdir(public_path('uploads').'/'.$folder, 0777, true);
        }

        $file = $request->file('imagenInput');
        $disk->put($filename, File::get($file) );

        $res = ["imagen" => $filename];

        echo json_encode($res);
    }

    /*----------  Eliminar Imagen  ----------*/
    public function eliminarImagen(Request $request){
        $disk = Storage::disk('uploads');
        $vacante = Vacante::findOrFail(Hashids::decode($request->vacante_id)[0]);
        $imagen = $vacante->imagen;
        $vacante->imagen = '';
        $vacante->save();
        //$slide->delete();
        $disk->delete($imagen);

        return ['titulo'=>'Eliminar imagen', 'msg'=>'La imagen ha sido eliminada.', 'class'=>'success'];
    }
}
