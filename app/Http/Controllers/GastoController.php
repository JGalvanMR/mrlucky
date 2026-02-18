<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto;
use Hashids;

class GastoController extends Controller
{
	/*----------  Agregar  ----------*/
	public function agregar(Request $request){
		$gasto = new Gasto;
		$data = $request->all();

		$data['monto'] = str_replace(['$', ' ', ','], '', $data['monto']);

		if($gasto->create($data)){
    		$res = ['titulo'=>'Agregar gasto', 'msg'=>'El gasto ha sido agregado.', 'class'=>'success'];
    	}else{
    		$res = ['titulo'=>'Agregar gasto', 'msg'=>'Error al agregar el gasto.', 'class'=>'error'];
    	}
    	return $res;
	}

	/*----------  Editar  ----------*/
	public function editar($hash_id, Request $request){
		$gasto = Gasto::findOrFail(Hashids::decode($hash_id)[0]);
		$data = $request->all();

		$data['monto'] = str_replace(['$', ' ', ','], '', $data['monto']);

		if($gasto->update($data)){
    		$res = ['titulo'=>'Editar gasto', 'msg'=>'El gasto ha sido editado.', 'class'=>'success'];
    	}else{
    		$res = ['titulo'=>'Editar gasto', 'msg'=>'Error al editar el gasto.', 'class'=>'error'];
    	}
    	return $res;
	}

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
    	$gasto = Gasto::findOrFail(Hashids::decode($hash_id)[0]);

    	if($gasto->delete()){
    		$res = ['titulo'=>'Eliminar gasto', 'msg'=>'El gasto ha sido eliminado.', 'class'=>'success'];
    	}else{
    		$res = ['titulo'=>'Eliminar gasto', 'msg'=>'Error al eliminar el gasto.', 'class'=>'error'];
    	}
    	return $res;
    }

    /*----------  Eliminar Lote  ----------*/
    public function eliminarLote(Request $request){
    	$gastos = json_decode($request->gastos);

    	$gastos = Gasto::whereIn('id', $gastos)->delete();
    	return ['titulo'=>'Eliminar gasto', 'msg'=>'Los gastos han sido eliminados.', 'class'=>'success'];

    }

}
