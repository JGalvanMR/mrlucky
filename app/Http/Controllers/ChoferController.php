<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chofer;
use Hashids;
use Storage;

class ChoferController extends Controller
{
    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $chofer = new Chofer;
        $data = $request->all();

        $chofer->create($data);
        return ['titulo'=>'Agregar chofer', 'msg'=>'El chofer ha sido agregado.', 'class'=>'success'];
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $chofer = Chofer::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();

        $chofer->update($data);
        return ['titulo'=>'Editar chofer', 'msg'=>'El chofer ha sido editado.', 'class'=>'success'];
    }

    /*----------  Agregar Licencia  ----------*/
    public function agregarLicencia(Request $request){
        $chofer = Chofer::findOrFail($request->chofer_id);
        $chofer->licencia = str_replace(',', '', $request->licencia);
        $chofer->save();
        return ['titulo'=>'Agregar Licencia', 'msg'=>'La Licencia ha sido agregada.', 'class'=>'success'];
    }

    /*----------  Eliminar Licencia  ----------*/
    public function eliminarLicencia(Request $request){
        $disk = Storage::disk('uploads');
        $chofer = Chofer::findOrFail($request->chofer_id);
        //dd($chofer);
        $img = $chofer->licencia;
        $chofer->licencia = '';
        $chofer->save();
        $disk->delete($img);

        return ['titulo'=>'Eliminar Licencia', 'msg'=>'La Licencia ha sido eliminada.', 'class'=>'success'];
    }

    /*----------  Agregar INE Frontal  ----------*/
    public function agregarIneFrontal(Request $request){
        $chofer = Chofer::findOrFail($request->chofer_id);
        $chofer->ine_frontal = str_replace(',', '', $request->ine_frontal);
        $chofer->save();
        return ['titulo'=>'Agregar INE Frontal', 'msg'=>'La INE frontal ha sido agregada.', 'class'=>'success'];
    }

    /*----------  Eliminar INE Frontal  ----------*/
    public function eliminarIneFrontal(Request $request){
        $disk = Storage::disk('uploads');
        $chofer = Chofer::findOrFail($request->chofer_id);
        //dd($chofer);
        $img = $chofer->ine_frontal;
        $chofer->ine_frontal = '';
        $chofer->save();
        $disk->delete($img);

        return ['titulo'=>'Eliminar INE Frontal', 'msg'=>'La INE frontal ha sido eliminada.', 'class'=>'success'];
    }

    /*----------  Agregar INE Reverso  ----------*/
    public function agregarIneReverso(Request $request){
        $chofer = Chofer::findOrFail($request->chofer_id);
        $chofer->ine_reverso = str_replace(',', '', $request->ine_reverso);
        $chofer->save();
        return ['titulo'=>'Agregar INE Reverso', 'msg'=>'La INE Reverso ha sido agregada.', 'class'=>'success'];
    }

    /*----------  Eliminar INE Reverso  ----------*/
    public function eliminarIneReverso(Request $request){
        $disk = Storage::disk('uploads');
        $chofer = Chofer::findOrFail($request->chofer_id);
        //dd($chofer);
        $img = $chofer->ine_reverso;
        $chofer->ine_reverso = '';
        $chofer->save();
        $disk->delete($img);

        return ['titulo'=>'Eliminar INE Reverso', 'msg'=>'La INE Reverso ha sido eliminada.', 'class'=>'success'];
    }

    /*----------  Eliminar  ----------*/
    public function eliminar($hash_id){
        $chofer = Chofer::findOrFail(Hashids::decode($hash_id)[0]);
        $disk = Storage::disk('uploads');
        $disk->delete($chofer->licencia);
        $disk->delete($chofer->ine_frontal);
        $disk->delete($chofer->ine_reverso);
        $chofer->delete();
        return ['titulo'=>'Eliminar chofer', 'msg'=>'El chofer ha sido eliminado.', 'class'=>'success'];
    }

}
