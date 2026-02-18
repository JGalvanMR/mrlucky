<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Afectado;
use Hashids;

class AfectadoController extends Controller
{
    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $afectado = new Afectado;
        $data = $request->all();
        $afectado->create($data);

        return ['titulo'=>'Agregar afectado', 'msg'=>'El afectado a sido agregado.', 'class'=>'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $afectado = Afectado::findOrFail(Hashids::decode($hash_id)[0]);
        $afectado->delete();
        return ['titulo'=>'Eliminar afectado', 'msg'=>'El afectado a sido eliminado.', 'class'=>'success'];
    }
}
