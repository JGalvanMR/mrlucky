<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GastoFijo;
use Hashids;

class GastoFijoController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
    	$gastos = GastoFijo::all();
    	return view('admin.modules.gastos-fijos.index', compact('gastos'));
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
    	return view('admin.modules.gastos-fijos.agregar');
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
    	$gasto = new GastoFijo;
    	$data = $request->all();

    	$data['monto'] = str_replace(['$', ' ', ','], '', $data['monto']);
        $gasto->create($data);

        return ['titulo'=>'Agregar gasto fijo', 'msg'=>'El gasto fijo ha sido agregado.', 'class'=>'success'];
        
    }

    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id){
    	$gasto = GastoFijo::findOrFail(Hashids::decode($hash_id)[0]);
    	return view('admin.modules.gastos-fijos.editar', compact('gasto'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
    	$gasto = GastoFijo::findOrFail(Hashids::decode($hash_id)[0]);
    	$data = $request->all();

    	$data['monto'] = str_replace(['$', ' ', ','], '', $data['monto']);

        $gasto->update($data);
        return ['titulo'=>'Editar gasto fijo', 'msg'=>'El gasto fijo ha sido editado.', 'class'=>'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
    	$gasto = GastoFijo::findOrFail(Hashids::decode($hash_id)[0]);

    	if($gasto->delete()){
    		$res = ['titulo'=>'Eliminar gasto fijo', 'msg'=>'El gasto fijo ha sido eliminado.', 'class'=>'success'];
    	}else{
    		$res = ['titulo'=>'Eliminar gasto fijo', 'msg'=>'Error al eliminar el gasto fijo.', 'class'=>'error'];
    	}
    	return $res;
    }
}
