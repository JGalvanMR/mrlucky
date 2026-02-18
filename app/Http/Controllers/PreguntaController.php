<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pregunta;
use App\Models\Idioma;
use Hashids;

class PreguntaController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        $preguntas = Pregunta::all();
        return view('admin.modules.preguntas.index', compact('preguntas'));
    }

    /*----------  Agregar form  ----------*/
    public function agregarForm(){
        $idiomas = Idioma::all();
        return view('admin.modules.preguntas.agregar', compact('idiomas'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $pregunta = new Pregunta;
        $data = $request->all();

        if(!$request->activo){
            $data['activo'] = '0';
        }

        $pregunta->create($data);
        return ['titulo'=>'Agregar pregunta', 'msg'=>'La pregunta ha sido agregada.', 'class'=>'success'];
    }

    /*----------  Editar form  ----------*/
    public function editarForm($hash_id){
        $idiomas = Idioma::all();
        $pregunta = Pregunta::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.preguntas.editar', compact('pregunta', 'idiomas'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $pregunta = Pregunta::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();

        if(!$request->activo){
            $data['activo'] = '0';
        }

        $pregunta->update($data);
        return ['titulo'=>'Editar pregunta', 'msg'=>'La pregunta ha sido editada.', 'class'=>'success'];
    }

    /*----------  Ordenar Form  ----------*/
    public function ordenarForm(){
        $preguntas = Pregunta::orderBy('orden', 'ASC')->get();
        return view('admin.modules.preguntas.ordenar', compact('preguntas'));
    }

    /*----------  Ordenar  ----------*/
    public function ordenar(Request $request){
        $preguntas = $request->preguntas;

        foreach ($preguntas as $key => $pregunta_id) {
            $pregunta = Pregunta::findOrFail($pregunta_id);
            $pregunta->orden = $key + 1;
            $pregunta->save();
        }

        return ['titulo' => 'Ordenar Preguntas', 'msg' => 'El orden ha cambiado.', 'class' => 'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $pregunta = Pregunta::findOrFail(Hashids::decode($hash_id)[0]);
        $pregunta->delete();
        return ['titulo'=>'Eliminar pregunta', 'msg'=>'La pregunta ha sido eliminada.', 'class'=>'success'];
    }
}
