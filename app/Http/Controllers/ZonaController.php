<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona;
use Hashids;

class ZonaController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        return view('admin.modules.zonas.index');
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        return view('admin.modules.zonas.agregar');
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $zona = new Zona;
        $data = $request->all();
        $zona->create($data);

        return ['titulo'=>'Agregar zona', 'msg'=>'La zona ha sido agregada.', 'class'=>'success'];
    }

    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id){
        $zona = Zona::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.zonas.editar', compact('zona'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $zona = Zona::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();
        $zona->update($data);

        return ['titulo'=>'Editar zona', 'msg'=>'La zona ha sido editada.', 'class'=>'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $zona = Zona::findOrFail(Hashids::decode($hash_id)[0]);
        $zona->delete();

        return ['titulo'=>'Eliminar zona', 'msg'=>'La zona ha sido eliminada.', 'class'=>'success'];
    }
}
