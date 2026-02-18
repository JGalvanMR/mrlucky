<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\TranslationLoader\LanguageLine;
use App\Models\Idioma;
use Hashids;

class TraduccionController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        $traducciones = LanguageLine::all();
        //dd($traducciones);
        return view('admin.modules.traducciones.index', compact('traducciones'));
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        $idiomas = Idioma::where('activo','1')->orderBy('orden', 'ASC')->get();
        return view('admin.modules.traducciones.agregar', compact('idiomas'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        // dd($request->all());
        $line = LanguageLine::where('group', $request->grupo)->where('key', $request->clave)->get();
        if($line->count()){
            return ['titulo' => 'Agregar traducción', 'msg' => 'La clave que está intentando agregar ya existe.', 'class' => 'error'];
        }
        $traduccion = [];
        foreach($request->traduccion as $key => $trans){
            $traduccion[$trans['idioma']] = $trans['texto'];
        }

        LanguageLine::create([
            'group' => $request->grupo,
            'key' => $request->clave,
            'text' => $traduccion,
        ]);

        return ['titulo' => 'Agregar traducción', 'msg' => 'La traducción ha sido agregada.', 'class' => 'success'];
    }

    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id){
        $traduccion = LanguageLine::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.traducciones.editar', compact('traduccion'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        //dd($request->all());

        if($request->traduccion){
            // Se agregan multiple traducciones
            $line = LanguageLine::findOrFail(Hashids::decode($hash_id)[0]);
            $traduccion = $line->text;

            foreach($request->traduccion as $key => $trans){
                if($trans['idioma'] != null){
                    $traduccion[$trans['idioma']] = $trans['texto'];
                }
            }

            $line->text = $traduccion;
            $line->group = $request->grupo;
            $line->key = $request->key;
            $line->save();

            return ['titulo' => 'Editar traducción', 'msg' => 'La traducción ha sido editada.', 'class' => 'success'];
        }elseif($request->idioma && $request->texto){
            // Se agrega una traducción
            $line = LanguageLine::findOrFail(Hashids::decode($hash_id)[0]);

            if($request->idioma != null){
                $traduccion = $line->text;
                $traduccion[$request->idioma] = $request->texto;
                $line->text = $traduccion;
            }

            $line->group = $request->grupo;
            $line->key = $request->key;
            $line->save();
            return ['titulo' => 'Editar traducción', 'msg' => 'La traducción ha sido editada.', 'class' => 'success'];
        }else{
            // No se agregan traducciones
            $line = LanguageLine::findOrFail(Hashids::decode($hash_id)[0]);
            $line->group = $request->grupo;
            $line->key = $request->key;
            $line->save();
            return ['titulo' => 'Editar traducción', 'msg' => 'La traducción ha sido editada.', 'class' => 'success'];
        }


    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $traduccion = LanguageLine::findOrFail(Hashids::decode($hash_id)[0]);
        $traduccion->delete();
        return ['titulo' => 'Eliminar traducción', 'msg' => 'La traducción ha sido eliminada.', 'class' => 'success'];
    }

    /*----------  Editar detalle  ----------*/
    public function editarDetalle(Request $request){
        $line = LanguageLine::where('group', $request->group)->where('key', $request->key)->first();
        $text = $line->text;
        $text[$request->lang] = $request->val;
        $line->text = $text;
        $line->save();
        return ['titulo' => 'Editar traducción', 'msg' => 'La traducción ha sido editada.', 'class' => 'success'];
    }

    /*----------  Eliminar detalle  ----------*/
    public function eliminarDetalle(Request $request){
        $line = LanguageLine::where('group', $request->group)->where('key', $request->key)->first();
        $text = $line->text;
        unset($text[$request->lang]);
        $line->text = $text;
        $line->save();
        return ['titulo' => 'Eliminar traducción', 'msg' => 'La traducción ha sido eliminada.', 'class' => 'success'];
    }

}
