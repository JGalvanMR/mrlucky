<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Idioma;
use Hashids;
use Storage;
use File;
use Str;
use DB;

class PostController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        $posts = Post::all();
        return view('admin.modules.posts.index', compact('posts'));
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        $idiomas = Idioma::where('activo','1')->orderBy('orden','ASC')->get();
        return view('admin.modules.posts.agregar', compact('idiomas'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $post = new Post;
        $data = $request->all();
        $data['imagen'] = str_replace(',', '', $request->imagen);
        $post->create($data);
        return ['titulo'=>'Agregar post', 'msg'=>'El post ha sido agregado.', 'class'=>'success'];
    }

    /*----------  Ver  ----------*/
    public function ver($hash_id){
        $post = Post::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.posts.ver', compact('post'));
    }

    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id){
        $idiomas = Idioma::where('activo','1')->orderBy('orden','ASC')->get();
        $post = Post::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.posts.editar', compact('idiomas', 'post'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $post = Post::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();
        if(!$request->activo){
            $data['activo'] = '0';
        }
        if(!$request->destacado){
            $data['destacado'] = '0';
        }else{
            Post::where('idioma_id', $post->idioma_id)->update(['destacado'=>'0']);
            $data['destacado'] = '1';
        }
        $post->update($data);
        return ['titulo'=>'Editar post', 'msg'=>'El post ha sido editado.', 'class'=>'success'];
    }

     /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $disk = Storage::disk('uploads');
        $post = Post::findOrFail(Hashids::decode($hash_id)[0]);
        $imagen = $post->imagen;
        $post->delete();
        $disk->delete($imagen);
        return ['titulo'=>'Eliminar post', 'msg'=>'El post ha sido eliminado.', 'class'=>'success'];
    }

    /*----------  Subir Imagen  ----------*/
    public function subirImagen(Request $request){
        $disk = Storage::disk('uploads');

        $folder = "posts/imagenes/";
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
        $post = Post::findOrFail(Hashids::decode($request->post_id)[0]);
        $imagen = $post->imagen;
        $post->imagen = '';
        $post->save();
        //$slide->delete();
        $disk->delete($imagen);

        return ['titulo'=>'Eliminar imagen', 'msg'=>'La imagen ha sido eliminada.', 'class'=>'success'];
    }
}
