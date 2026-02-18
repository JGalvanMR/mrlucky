<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaProducto;
use App\Models\Idioma;
use Hashids;
use Storage;
use File;
use Str;

class CategoriaProductoController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        $categorias = CategoriaProducto::all();
        return view('admin.modules.categorias-productos.index', compact('categorias'));
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        $idiomas = Idioma::where('activo','1')->orderBy('orden','ASC')->get();
        return view('admin.modules.categorias-productos.agregar', compact('idiomas'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $categoria = new CategoriaProducto;
        $data = $request->all();
        $data['banner'] = str_replace(',', '', $request->banner);
        $categoria->create($data);

        return ['titulo'=>'Agregar Categoría', 'msg'=>'La categoría ha sido agregada.', 'class'=>'success'];
    }

    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id){
        $idiomas = Idioma::where('activo','1')->orderBy('orden','ASC')->get();
        $categoria = CategoriaProducto::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.categorias-productos.editar', compact('idiomas', 'categoria'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $categoria = CategoriaProducto::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();

        if(!$request->activo){
            $data['activo'] = '0';
        }
        $categoria->update($data);

        return ['titulo'=>'Editar Categoría', 'msg'=>'La categoría ha sido editada.', 'class'=>'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $disk = Storage::disk('uploads');
        $categoria = CategoriaProducto::findOrFail(Hashids::decode($hash_id)[0]);
        $banner = $categoria->banner;
        $categoria->delete();
        $disk->delete($banner);

        return ['titulo'=>'Eliminar Categoría', 'msg'=>'La categoría ha sido eliminada.', 'class'=>'success'];

    }

    /*----------  Subir Banner  ----------*/
    public function subirBanner(Request $request){
        $disk = Storage::disk('uploads');

        $folder = "categorias/banners/";
        $filename = $folder . time() . "-" . $_FILES['bannerInput']['name'];

        // Si no existe la carpeta se crea
        if(!file_exists(public_path('uploads').'/'.$folder)){
            mkdir(public_path('uploads').'/'.$folder, 0777, true);
        }

        $file = $request->file('bannerInput');
        $disk->put($filename, File::get($file) );

        $res = ["banner" => $filename];

        echo json_encode($res);
    }

    /*----------  Eliminar Banner  ----------*/
    public function eliminarBanner(Request $request){
        $disk = Storage::disk('uploads');
        $categoria = CategoriaProducto::findOrFail(Hashids::decode($request->categoria_id)[0]);
        $banner = $categoria->banner;
        $categoria->banner = '';
        $categoria->save();
        //$slide->delete();
        $disk->delete($banner);

        return ['titulo'=>'Eliminar banner', 'msg'=>'El banner ha sido eliminado.', 'class'=>'success'];
    }

    /*----------  Ordenar Form  ----------*/
    public function ordenarForm($idioma_id=null){

        if($idioma_id){
            $categorias = CategoriaProducto::where('idioma_id', $idioma_id)->orderBy('orden', 'ASC')->get();
        }else{
            $categorias = CategoriaProducto::orderBy('orden', 'ASC')->get();
        }

        $idiomas = Idioma::all();
        return view('admin.modules.categorias-productos.ordenar', compact('categorias', 'idiomas'));
    }

    /*----------  Ordenar  ----------*/
    public function ordenar(Request $request){
        $categorias = $request->categorias;

        foreach ($categorias as $key => $categoria_id) {
            $categoria = CategoriaProducto::findOrFail($categoria_id);
            $categoria->orden = $key + 1;
            $categoria->save();
        }

        return ['titulo' => 'Ordenar Categorías', 'msg' => 'El orden ha cambiado.', 'class' => 'success'];
    }
}
