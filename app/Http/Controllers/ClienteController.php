<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Estado;
use Hashids;
use Storage;
/*use File;
use Str;*/

class ClienteController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
    	$clientes = Cliente::all();
    	return view('admin.modules.clientes.index', compact('clientes'));
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        $estados = Estado::all();
    	return view('admin.modules.clientes.agregar', compact('estados'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
    	$cliente = new Cliente;
    	$data = $request->all();
        $cliente->create($data);
        
        return ['titulo'=>'Agregar cliente', 'msg'=>'El cliente ha sido agregado.', 'class'=>'success'];
    }

    /*----------  Ver  ----------*/
    public function ver($hash_id){
    	$cliente = Cliente::findOrFail(Hashids::decode($hash_id)[0]);
    	return view('admin.modules.clientes.ver', compact('cliente'));
    }

    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id){
        $estados = Estado::all();
        $cliente = Cliente::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.clientes.editar', compact('cliente', 'estados'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
    	$cliente = Cliente::findOrFail(Hashids::decode($hash_id)[0]);
    	$data = $request->all();

    	if($cliente->update($data)){
    		$res = ['titulo'=>'Editar cliente', 'msg'=>'El cliente ha sido editado.', 'class'=>'success'];
    	}else{
    		$res = ['titulo'=>'Editar cliente', 'msg'=>'Error al editar el cliente.', 'class'=>'error'];
    	}
    	return $res;
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
    	$cliente = Cliente::findOrFail(Hashids::decode($hash_id)[0]);

    	if($cliente->delete()){
    		$res = ['titulo'=>'Eliminar cliente', 'msg'=>'El cliente ha sido eliminado.', 'class'=>'success'];
    	}else{
    		$res = ['titulo'=>'Eliminar cliente', 'msg'=>'Error al eliminar el cliente.', 'class'=>'error'];
    	}
    	return $res;
    }

    /*----------  Agregar Foto  ----------*/
    public function agregarFoto(Request $request){
        $cliente = Cliente::findOrFail($request->cliente_id);
        $cliente->foto = str_replace(',', '', $request->foto);
        $cliente->save();
        return ['titulo'=>'Agregar Foto', 'msg'=>'La foto ha sido agregada.', 'class'=>'success'];
    }

    /*----------  Eliminar Foto  ----------*/
    public function eliminarFoto(Request $request){
        $disk = Storage::disk('uploads');
        $cliente = Cliente::findOrFail($request->cliente_id);
        $img = $cliente->foto;
        $cliente->foto = '';
        $cliente->save();
        $disk->delete($img);

        return ['titulo'=>'Eliminar Foto', 'msg'=>'La foto ha sido eliminada.', 'class'=>'success'];
    }

    /*----------  Agregar INE Frontal  ----------*/
    public function agregarIneFrontal(Request $request){
        $cliente = Cliente::findOrFail($request->cliente_id);
        $cliente->ine_frontal = str_replace(',', '', $request->ine_frontal);
        $cliente->save();
        return ['titulo'=>'Agregar INE Frontal', 'msg'=>'La INE frontal ha sido agregada.', 'class'=>'success'];
    }

    /*----------  Eliminar INE Frontal  ----------*/
    public function eliminarIneFrontal(Request $request){
        $disk = Storage::disk('uploads');
        $cliente = Cliente::findOrFail($request->cliente_id);
        $img = $cliente->ine_frontal;
        $cliente->ine_frontal = '';
        $cliente->save();
        $disk->delete($img);

        return ['titulo'=>'Eliminar INE Frontal', 'msg'=>'La INE frontal ha sido eliminada.', 'class'=>'success'];
    }

    /*----------  Agregar INE Reverso  ----------*/
    public function agregarIneReverso(Request $request){
        $cliente = Cliente::findOrFail($request->cliente_id);
        $cliente->ine_reverso = str_replace(',', '', $request->ine_reverso);
        $cliente->save();
        return ['titulo'=>'Agregar INE Reverso', 'msg'=>'La INE reverso ha sido agregada.', 'class'=>'success'];
    }

    /*----------  Eliminar INE Reverso  ----------*/
    public function eliminarIneReverso(Request $request){
        $disk = Storage::disk('uploads');
        $cliente = Cliente::findOrFail($request->cliente_id);
        $img = $cliente->ine_reverso;
        $cliente->ine_reverso = '';
        $cliente->save();
        $disk->delete($img);

        return ['titulo'=>'Eliminar INE Reverso', 'msg'=>'La INE reverso ha sido eliminada.', 'class'=>'success'];
    }
}
