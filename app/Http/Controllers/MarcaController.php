<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use Hashids;

class MarcaController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        $marcas = Marca::all();
        return view('admin.modules.marcas.index', compact('marcas'));
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        return view('admin.modules.marcas.agregar');
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $marca = new Marca;
        $data = $request->all();
        $marca->create($data);

        return ['titulo'=>'Agregar Marca', 'msg'=>'La marca ha sido agregada.', 'class'=>'success'];
    }

    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id){
        $marca = Marca::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.marcas.editar', compact('marca'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $marca = Marca::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();

        if(!$request->activo)
            $data['activo'] = '0';

        $marca->update($data);

        return ['titulo'=>'Editar Marca', 'msg'=>'La marca ha sido editada.', 'class'=>'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id, Request $request){
        $marca = Marca::findOrFail(Hashids::decode($hash_id)[0]);
        $marca->delete();

        return ['titulo'=>'Eliminar Marca', 'msg'=>'La marca ha sido eliminada.', 'class'=>'success'];
    }

    /*----------  Ordenar Form  ----------*/
    public function ordenarForm(){
        $marcas = Marca::orderBy('orden','ASC')->get();
        return view('admin.modules.marcas.ordenar', compact('marcas'));
    }

    /*----------  Ordenar  ----------*/
    public function ordenar(Request $request){
        $marcas = $request->marcas;

        foreach ($marcas as $key => $marca_id) {
            $marca = Marca::findOrFail($marca_id);
            $marca->orden = $key;
            $marca->save();
        }

        return ['titulo' => 'Ordenar Marcas', 'msg' => 'El orden ha cambiado.', 'class' => 'success'];
    }
}
