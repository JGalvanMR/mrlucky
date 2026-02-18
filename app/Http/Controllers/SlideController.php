<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Idioma;
use Hashids;
use Storage;
use File;
use Str;

class SlideController extends Controller
{
    /*----------  Index  ----------*/
    public function index(){
        $slides = Slide::all();
    	return view('admin.modules.slides.index', compact('slides'));
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        $idiomas = Idioma::where('activo', '1')->orderBy('orden', 'ASC')->get();
    	return view('admin.modules.slides.agregar', compact('idiomas'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
    	$data = $request->all();
        $slide = new Slide;

        $data['imagen'] = str_replace(',', '', $request->imagen);
        $data['imagen_movil'] = str_replace(',', '', $request->imagen_movil);

        if(!$request->activo)
            $data['activo'] = '0';

        if(!$request->target_blank)
            $data['target_blank'] = '0';

        if($slide->create($data)){
            $res = ['titulo'=>'Agregar slide', 'msg'=>'El slide ha sido agregado.', 'class'=>'success'];
        }else{
            $res = ['titulo'=>'Agregar slide', 'msg'=>'Error al agregar el slide.', 'class'=>'error'];
        }

        return $res;
    }

    /*----------  Ver  ----------*/
    public function ver(){
        $slides = Slide::orderBy('orden', 'ASC')->get();
        return view('admin.modules.slides.ver', compact('slides'));
    }


    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id){
        $idiomas = Idioma::where('activo', '1')->orderBy('orden', 'ASC')->get();
        $slide = Slide::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.slides.editar', compact('slide', 'idiomas'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $slide = Slide::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();

        if(!$request->activo)
            $data['activo'] = '0';

        if(!$request->target_blank)
            $data['target_blank'] = '0';

        if($slide->update($data)){
            $res = ['titulo' => 'Editar slide', 'msg' => 'El slide ha sido editado.', 'class' => 'success'];
        }else{
            $res = ['titulo' => 'Editar slide', 'msg' => 'Error al editar el slide.', 'class' => 'error'];
        }

        return $res;
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $disk = Storage::disk('uploads');
        $slide = Slide::findOrFail(Hashids::decode($hash_id)[0]);
        $img = $slide->imagen;
        $imgMovil = $slide->imagen_movil;
        $slide->delete();
        $disk->delete($img);
        $disk->delete($imgMovil);

        return ['titulo'=>'Eliminar slide', 'msg'=>'El slide ha sido eliminado.', 'class'=>'success'];
    }


    /*----------  Subir Slide  ----------*/
    public function subirImagen(Request $request){
        $disk = Storage::disk('uploads');

        $folder = "slides/";
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

    /*----------  Eliminar Slide  ----------*/
    public function eliminarImagen(Request $request){
        $disk = Storage::disk('uploads');
        $slide = Slide::findOrFail(Hashids::decode($request->slide_id)[0]);
        $img = $slide->imagen;
        $slide->imagen = '';
        $slide->save();
        //$slide->delete();
        $disk->delete($img);

        return ['titulo'=>'Eliminar slide', 'msg'=>'El slide ha sido eliminado.', 'class'=>'success'];
    }


    /*----------  Subir Slide Móvil  ----------*/
    public function subirImagenMovil(Request $request){
        $disk = Storage::disk('uploads');

        $folder = "slides-movil/";
        $filename = $folder . time() . "-" . $_FILES['imagenMovilInput']['name'];

        // Si no existe la carpeta se crea
        if(!file_exists(public_path('uploads').'/'.$folder)){
            mkdir(public_path('uploads').'/'.$folder, 0777, true);
        }

        $file = $request->file('imagenMovilInput');
        $disk->put($filename, File::get($file) );

        $res = ["imagenMovil" => $filename];

        echo json_encode($res);
    }

    /*----------  Eliminar Slide Móvil  ----------*/
    public function eliminarImagenMovil(Request $request){
        $disk = Storage::disk('uploads');
        $slide = Slide::findOrFail(Hashids::decode($request->slide_id)[0]);
        $img = $slide->imagen_movil;
        $slide->imagen_movil = '';
        $slide->save();
        //$slide->delete();
        $disk->delete($img);

        return ['titulo'=>'Eliminar slide movil', 'msg'=>'El slide ha sido eliminado.', 'class'=>'success'];
    }

    /*----------  Ordenar Form  ----------*/
    public function ordenarForm(){
        $slides = Slide::orderBy('orden', 'ASC');

        if(request('lang')){
            $slides = $slides->where('idioma_id', request('lang'));
        }

        $slides = $slides->get();

        $idiomas = Idioma::all();
        return view('admin.modules.slides.ordenar', compact('idiomas', 'slides'));
    }

    /*----------  Ordenar  ----------*/
    public function ordenar(Request $request){
        $slides = $request->slides;

        foreach ($slides as $key => $slide_id) {
            $slide = Slide::findOrFail($slide_id);
            $slide->orden = $key;
            $slide->save();
        }

        return ['titulo' => 'Ordenar slides', 'msg' => 'El orden ha cambiado.', 'class' => 'success'];
    }


}
