<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Estado;
use Hashids;

class ProveedorController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        //$proveedores = Proveedor::all();
        return view('admin.modules.proveedores.index');
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        $estados = Estado::all();
        return view('admin.modules.proveedores.agregar', compact('estados'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $proveedor = new Proveedor;
        $data = $request->all();

        $proveedor->create($data);
        return ['titulo'=>'Agregar Proveedor', 'msg'=>'El proveedor ha sido agregado.', 'class'=>'success'];
    }

    /*----------  Ver  ----------*/
    public function ver($hash_id){
        $proveedor = Proveedor::findOrFail(Hashids::decode($hash_id)[0]);

        return view('admin.modules.proveedores.ver', compact('proveedor'));
    }

    /*----------  Editar Form  ----------*/
    public function editarForm($hash_id){
        $proveedor = Proveedor::findOrFail(Hashids::decode($hash_id)[0]);
        $estados = Estado::all();

        return view('admin.modules.proveedores.editar', compact('proveedor', 'estados'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $proveedor = Proveedor::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();

        if(!$request->activo)
            $data['activo'] = '0';

        $proveedor->update($data);
        return ['titulo'=>'Editar Proveedor', 'msg'=>'El proveedor ha sido editado.', 'class'=>'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $proveedor = Proveedor::findOrFail(Hashids::decode($hash_id)[0]);
        $proveedor->delete();
        return ['titulo'=>'Eliminar Proveedor', 'msg'=>'El proveedor ha sido eliminado.', 'class'=>'success'];
    }
}
