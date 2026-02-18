<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use Hashids;

class PagoController extends Controller
{
    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $pago = new Pago;
        $data = $request->all();
        $data['monto'] = str_replace(['$', ',', ' '], '', $request->monto);

        $pago->create($data);
        return ['titulo'=>'Agregar Pago', 'msg'=>'El pago ha sido agregado.', 'class'=>'success'];
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $pago = Pago::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();
        $data['monto'] = str_replace(['$', ',', ' '], '', $request->monto);

        /*if(!$data['activo']){
            $data['activo'] = '0';
        }*/

        $pago->update($data);
        return ['titulo'=>'Editar Pago', 'msg'=>'El pago ha sido editado.', 'class'=>'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $pago = Pago::findOrFail(Hashids::decode($hash_id)[0]);
        $pago->delete();
        return ['titulo'=>'Eliminar Pago', 'msg'=>'El pago ha sido eliminado.', 'class'=>'success'];
    }

    /*----------  Imprimir  ----------*/
    public function imprimir($hash_id){
        $pago = Pago::findOrFail(Hashids::decode($hash_id)[0]);
        
        return view('admin.modules.vigencias.imprimir-pago', compact('pago'));
    }
}
