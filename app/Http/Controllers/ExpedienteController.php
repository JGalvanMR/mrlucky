<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expediente;
use Hashids;
use Storage;

class ExpedienteController extends Controller
{
    /*----------  Agregar  ----------*/
    public function agregar(Request $request){

        $expedientes = explode(',', $request->expediente);

        foreach($expedientes as $expediente){

            if($expediente){
                $exp = new Expediente;
                $exp->siniestro_id = $request->siniestro_id;
                $exp->documento = $expediente;
                $exp->save();
            }

        }

        return ['titulo'=>'Agregar expediente', 'msg'=>'El expediente ha sido agregado.', 'class'=>'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $disk = Storage::disk('uploads');
        $expediente = Expediente::findOrFail(Hashids::decode($hash_id)[0]);
        $doc = $expediente->documento;
        $expediente->delete();
        $disk->delete($doc);

        return ['titulo'=>'Eliminar Expediente', 'msg'=>'El expediente ha sido eliminado.', 'class'=>'success'];
        
    }
}
