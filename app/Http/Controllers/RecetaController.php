<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receta;
use App\Models\Ingrediente;
use App\Models\CategoriaReceta;
use App\Models\Idioma;
use Hashids;
use Storage;
use File;
use Str;

class RecetaController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        $recetas = Receta::all();
        return view('admin.modules.recetas.index', compact('recetas'));
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        $idiomas = Idioma::where('activo','1')->orderBy('orden', 'ASC')->get();
        return view('admin.modules.recetas.agregar', compact('idiomas'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $data = $request->all();
        $receta = new Receta;
        $data['imagen'] = str_replace(',','',$request->imagen);
        // if(!$request->activo){
        //     $data['activo'] = '0';
        // }
        $receta->create($data);
        return ['titulo'=>'Agregar receta', 'msg'=>'La receta ha sido agregada.', 'class'=>'success'];
    }

    /*----------  Ver  ----------*/
    public function ver($hash_id){
        $receta = Receta::findOrFail(Hashids::decode($hash_id)[0]);
        $ingredientes = Ingrediente::where('idioma_id', $receta->idioma_id)->get();

        return view('admin.modules.recetas.ver', compact('receta', 'ingredientes'));
    }

    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id){
        $idiomas = Idioma::where('activo','1')->orderBy('orden', 'ASC')->get();
        $receta = Receta::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.recetas.editar', compact('idiomas', 'receta'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $data = $request->all();
        $receta = Receta::findOrFail(Hashids::decode($hash_id)[0]);
        if(!$request->activo){
            $data['activo'] = '0';
        }
        $receta->update($data);
        return ['titulo'=>'Editar receta', 'msg'=>'La receta ha sido editada.', 'class'=>'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $disk = Storage::disk('uploads');
        $receta = Receta::findOrFail(Hashids::decode($hash_id)[0]);
        $imagen = $receta->imagen;
        $receta->delete();
        $disk->delete($imagen);
        return ['titulo'=>'Eliminar receta', 'msg'=>'La receta ha sido eliminada.', 'class'=>'success'];
    }

    /*----------  Subir Imagen  ----------*/
    public function subirImagen(Request $request){
        $disk = Storage::disk('uploads');

        $folder = "recetas/imagenes/";
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
        $receta = Receta::findOrFail(Hashids::decode($request->receta_id)[0]);
        $imagen = $receta->imagen;
        $receta->imagen = '';
        $receta->save();
        //$slide->delete();
        $disk->delete($imagen);

        return ['titulo'=>'Eliminar imagen', 'msg'=>'La imagen ha sido eliminada.', 'class'=>'success'];
    }

    /*----------  Agregar Ingredientes  ----------*/
    public function agregarIngredientes(Request $request){
        //dd($request->all());
        $receta = Receta::findOrFail($request->receta_id);
        $receta->ingredientes()->detach();
        $receta->ingredientes()->attach($request->ingredientes);
        return ['titulo'=>'Agregar Ingredientes', 'msg'=>'Los ingredientes ha sido acualizados.', 'class'=>'success'];
    }
}
