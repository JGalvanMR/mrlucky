<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idioma;
use Hashids;

class IdiomaController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        $idiomas = Idioma::all();
        return view('admin.modules.idiomas.index', compact('idiomas'));
    }

    /*----------  Agregar form  ----------*/
    public function agregarForm(){
        return view('admin.modules.idiomas.agregar');
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $idioma = new Idioma;
        $data = $request->all();
        $idioma->create($data);

        return ['titulo'=>'Agregar idioma', 'msg'=>'El idioma ha sido agregado.', 'class'=>'success'];
    }

    /*----------  Editar form  ----------*/
    public function editarForm($hash_id){
        $idioma = Idioma::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.idiomas.editar', compact('idioma'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        if($request->principal){
            Idioma::query()->update(['principal'=>'0']);
        }
        $idioma = Idioma::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();
        if(!$request->activo){
            $data['activo'] = '0';
        }
        if(!$request->principal){
            $data['principal'] = '0';
        }
        $idioma->update($data);

        return ['titulo'=>'Editar idioma', 'msg'=>'El idioma ha sido editado.', 'class'=>'success'];
    }

    /*----------  Ordenar Form  ----------*/
    public function ordenarForm(){
        $idiomas = Idioma::orderBy('orden', 'ASC')->get();
        return view('admin.modules.idiomas.ordenar', compact('idiomas'));
    }

    /*----------  Ordenar  ----------*/
    public function ordenar(Request $request){
        $idiomas = $request->idiomas;

        foreach ($idiomas as $key => $idioma_id) {
            $idioma = idioma::findOrFail($idioma_id);
            $idioma->orden = $key + 1;
            $idioma->save();
        }

        return ['titulo' => 'Ordenar idiomas', 'msg' => 'El orden ha cambiado.', 'class' => 'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $idioma = Idioma::findOrFail(Hashids::decode($hash_id)[0]);
        $idioma->delete();
        return ['titulo'=>'Eliminar idioma', 'msg'=>'El idioma ha sido eliminado.', 'class'=>'success'];
    }
}
