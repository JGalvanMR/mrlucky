<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imagen;
use App\Models\Producto;
use Hashids;
use Storage;
use File;
use Str;

class ImagenController extends Controller
{
    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $imagenes = explode(',', $request->imagen);

        foreach($imagenes as $imagen){
            if($imagen != ''){
                $img = new Imagen;
                $img->ruta = $imagen;
                $img->orden = 99;
                $img->activo = '1';
                $img->producto_id = $request->producto_id;
                $img->save();
            }
        }
        return ['titulo'=>'Agregar imágenes', 'msg'=>'Las imágenes han sido agregadas.', 'class'=>'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $disk = Storage::disk('uploads');
        $imagen = Imagen::findOrFail(Hashids::decode($hash_id)[0]);
        $disk->delete([$imagen->ruta]);
        $imagen->delete();

        return ['titulo'=>'Eliminar imagen', 'msg'=>'La imagen ha sido eliminada.', 'class'=>'success'];
    }

    /*----------  Ordenar  ----------*/
    public function ordenar(Request $request){

        foreach($request->imagenes as $pos => $imagen_id){
            $imagen = Imagen::findOrFail($imagen_id);
            $imagen->orden = $pos + 1;
            $imagen->save();
        }

         return ['titulo'=>'Ordenar imágenes', 'msg'=>'El orden ha cambiado.', 'class'=>'success'];
    }
}
