<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\CategoriaProducto;
use App\Models\Idioma;
use Hashids;
use Storage;
use File;
use Str;

class ProductoController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        $productos = Producto::All();
        return view('admin.modules.productos.index', compact('productos'));
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        $idiomas = Idioma::where('activo', '1')->orderBy('orden', 'ASC')->get();
        //$categoria = CategoriaProducto::where('activo', '1')->orderBy('orden', 'ASC')->get();
        return view('admin.modules.productos.agregar', compact('idiomas'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $data = $request->all();
        $producto = new Producto;
        $data['imagen'] = str_replace(',', '', $request->imagen);

        if(!$request->activo){
            $data['activo'] = '0';
        }

        $producto->create($data);
        return ['titulo'=>'Agregar producto', 'msg'=>'El producto ha sido agregado.', 'class'=>'success'];
    }

    /*----------  Ver  ----------*/
    public function ver($hash_id){
        $producto = Producto::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.productos.ver', compact('producto'));
    }

    /*----------  Ordenar Form  ----------*/
    // public function ordenarForm(){
    //     if($)
    //     $productos = Producto::findOrFail(Hashids::decode($hash_id)[0]);
    //     return view('admin.modules.productos.ver', compact('producto'));
    // }

    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id){
        $idiomas = Idioma::where('activo', '1')->orderBy('orden', 'ASC')->get();
        $producto = Producto::findOrFail(Hashids::decode($hash_id)[0]);
        //$categoria = CategoriaProducto::where('activo', '1')->orderBy('orden', 'ASC')->get();
        return view('admin.modules.productos.editar', compact('idiomas', 'producto'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $data = $request->all();
        $producto = Producto::findOrFail(Hashids::decode($hash_id)[0]);
        $data['imagen'] = str_replace(',', '', $request->imagen);

        if(!$request->activo){
            $data['activo'] = '0';
        }

        $producto->update($data);
        return ['titulo'=>'Editar producto', 'msg'=>'El producto ha sido editado.', 'class'=>'success'];
    }

    /*----------  Subir Imagen  ----------*/
    public function subirImagen(Request $request){
        $disk = Storage::disk('uploads');

        $folder = "productos/imagenes/";
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
        $producto = Producto::findOrFail(Hashids::decode($request->producto_id)[0]);
        $imagen = $producto->imagen;
        $producto->imagen = '';
        $producto->save();
        //$slide->delete();
        $disk->delete($imagen);

        return ['titulo'=>'Eliminar imagen', 'msg'=>'La imagen ha sido eliminada.', 'class'=>'success'];
    }

    /*----------  Subir Ficha  ----------*/
    public function subirFicha(Request $request){
        $disk = Storage::disk('uploads');

        $folder = "productos/fichas/";
        $filename = $folder . time() . "-" . $_FILES['fichaInput']['name'];

        // Si no existe la carpeta se crea
        if(!file_exists(public_path('uploads').'/'.$folder)){
            mkdir(public_path('uploads').'/'.$folder, 0777, true);
        }

        $file = $request->file('fichaInput');
        $disk->put($filename, File::get($file) );

        $res = ["ficha" => $filename];

        echo json_encode($res);
    }

    /*----------  Eliminar Ficha  ----------*/
    public function eliminarFicha(Request $request){
        $disk = Storage::disk('uploads');
        $producto = Producto::findOrFail(Hashids::decode($request->producto_id)[0]);
        $ficha = $producto->ficha;
        $producto->ficha = '';
        $producto->save();
        //$slide->delete();
        $disk->delete($ficha);

        return ['titulo'=>'Eliminar ficha', 'msg'=>'La ficha ha sido eliminada.', 'class'=>'success'];
    }

    /*----------  Subir Tabla Nutrimental  ----------*/
    public function subirTablaNutrimental(Request $request){
        $disk = Storage::disk('uploads');

        $folder = "productos/tablas/";
        $filename = $folder . time() . "-" . $_FILES['tabla_nutrimentalInput']['name'];

        // Si no existe la carpeta se crea
        if(!file_exists(public_path('uploads').'/'.$folder)){
            mkdir(public_path('uploads').'/'.$folder, 0777, true);
        }

        $file = $request->file('tabla_nutrimentalInput');
        $disk->put($filename, File::get($file) );

        $res = ["tabla_nutrimental" => $filename];

        echo json_encode($res);
    }

    /*----------  Eliminar Tabla Nutrimental  ----------*/
    public function eliminarTablaNutrimental(Request $request){
        $disk = Storage::disk('uploads');
        $producto = Producto::findOrFail(Hashids::decode($request->producto_id)[0]);
        $tabla_nutrimental = $producto->tabla_nutrimental;
        $producto->tabla_nutrimental = '';
        $producto->save();
        //$slide->delete();
        $disk->delete($tabla_nutrimental);

        return ['titulo'=>'Eliminar tabla nutrimental', 'msg'=>'La tabla ha sido eliminada.', 'class'=>'success'];
    }

    /*----------  Ordenar Form  ----------*/
    public function ordenarForm($categoria_id=null){

        if($categoria_id){
            $productos = Producto::where('categoria_id', $categoria_id)->orderBy('orden', 'ASC')->get();
        }else{
            $productos = Producto::orderBy('orden', 'ASC')->get();
        }

        $idiomas = Idioma::all();
        return view('admin.modules.productos.ordenar', compact('idiomas', 'productos'));
    }

    /*----------  Ordenar  ----------*/
    public function ordenar(Request $request){
        //dd($request->all());
        $productos = $request->productos;

        foreach ($productos as $key => $producto_id) {
            $producto = Producto::findOrFail($producto_id);
            $producto->orden = $key + 1;
            $producto->save();
        }

        return ['titulo' => 'Ordenar Productos', 'msg' => 'El orden ha cambiado.', 'class' => 'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $disk = Storage::disk('uploads');
        $producto = Producto::findOrFail(Hashids::decode($hash_id)[0]);
        $imagen = $producto->imagen;
        $producto->delete();
        $disk->delete($imagen);

        return ['titulo' => 'Eliminar Producto', 'msg' => 'El producto ha eliminado.', 'class' => 'success'];
    }
}
