<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Tipo;
use Hashids;

class TipoController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        $tipos = Tipo::all();
        return view('admin.modules.tipos.index', compact('tipos'));
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        $marcas = Marca::where('activo','1')->orderBy('orden', 'ASC')->get();
        return view('admin.modules.tipos.agregar', compact('marcas'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $tipo = new Tipo;
        $data = $request->all();

        if(!$request->activo)
            $data['activo'] = '0';

        $tipo->create($data);

        return ['titulo'=>'Agregar Tipo', 'msg'=>'El tipo ha sido agregado.', 'class'=>'success'];
    }

    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id){
        $marcas = Marca::where('activo','1')->orderBy('orden', 'ASC')->get();
        $tipo = Tipo::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.tipos.editar', compact('marcas', 'tipo'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $tipo = Tipo::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();

        if(!$request->activo)
            $data['activo'] = '0';
        
        $tipo->update($data);

        return ['titulo'=>'Editar Tipo', 'msg'=>'El tipo ha sido editado.', 'class'=>'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id, Request $request){
        $tipo = Tipo::findOrFail(Hashids::decode($hash_id)[0]);
        $tipo->delete();

        return ['titulo'=>'Eliminar Tipo', 'msg'=>'El tipo ha sido eliminado.', 'class'=>'success'];
    }

    /*----------  Ordenar Form  ----------*/
    public function ordenarForm(){
        $tipos = Tipo::orderBy('orden','ASC')->get();
        return view('admin.modules.tipos.ordenar', compact('tipos'));
    }

    /*----------  Ordenar  ----------*/
    public function ordenar(Request $request){
        $tipos = $request->tipos;

        foreach ($tipos as $key => $tipo_id) {
            $tipo = Tipo::findOrFail($tipo_id);
            $tipo->orden = $key;
            $tipo->save();
        }

        return ['titulo' => 'Ordenar Tipos', 'msg' => 'El orden ha cambiado.', 'class' => 'success'];
    }
}
