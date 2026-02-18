<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodoAdministrativo;
use App\Models\GastoFijo;
use App\Models\Gasto;
use Hashids;

class PeriodoAdministrativoController extends Controller
{
	/*----------  Listado  ----------*/
	public function index(){
		$periodos = PeriodoAdministrativo::all();
		return view('admin.modules.periodos-administrativos.index', compact('periodos'));
	}

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
    	return view('admin.modules.periodos-administrativos.agregar');
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
    	$periodo = PeriodoAdministrativo::where('ano', $request->ano)->where('mes', $request->mes)->get();

    	if(count($periodo)){
    		return ['titulo'=>'Agregar periodo administrativo', 'msg'=>'El periodo seleccionado ya existe.', 'class'=>'error'];
    	}

    	$periodo = new PeriodoAdministrativo;
    	$data = $request->all();

    	if($periodo->create($data)){
    		$res = ['titulo'=>'Agregar periodo administrativo', 'msg'=>'El periodo administrativo ha sido agregado.', 'class'=>'success'];
    	}else{
    		$res = ['titulo'=>'Agregar periodo administrativo', 'msg'=>'Error al agregar el periodo administrativo.', 'class'=>'error'];
    	}
    	return $res;

    }

    /*----------  Ver  ----------*/
    public function ver($hash_id){
    	$periodo = PeriodoAdministrativo::findOrFail(Hashids::decode($hash_id)[0]);
    	$gastos = Gasto::where('periodo_id', $periodo->id)->get();
    	return view('admin.modules.periodos-administrativos.ver', compact('periodo', 'gastos'));
    }

    /*----------  Cargar gastos fijos  ----------*/
    public function cargarGastoFijo($hash_id){
    	$periodo = PeriodoAdministrativo::findOrFail(Hashids::decode($hash_id)[0]);
    	$gastos = GastoFijo::all();

    	foreach($gastos as $gasto_fijo){
    		$gasto = new Gasto;
    		$gasto->concepto = $gasto_fijo->concepto;
    		$gasto->monto = $gasto_fijo->monto;
    		$gasto->descripcion = $gasto_fijo->descripcion;
    		$gasto->periodo_id = $periodo->id;
    		$gasto->save();
    	}

    	return ['titulo'=>'Gasto fijo', 'msg'=>'El gasto fijo ha sido cargado.', 'class'=>'success'];
    }

}
