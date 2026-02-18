<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vigencia;
use App\Models\Poliza;
use Hashids;
use Carbon\Carbon;


class VigenciaController extends Controller
{
    /*----------  Listado  ----------*/
    public function index(){
        return view('admin.modules.vigencias.index');
    }

    /*----------  Agregar Form  ----------*/
    public function agregarForm(){
        $polizas = Poliza::all();
        return view('admin.modules.vigencias.agregar', compact('polizas'));
    }

    /*----------  Agregar  ----------*/
    public function agregar(Request $request){
        $data = $request->all();
        $data['monto'] = str_replace(['$', ' ', '.00', ','], '', $request->monto);

        $fecha_inicio       = Carbon::createFromDate($data['fecha_inicio']);
        $fecha_fin          = Carbon::createFromDate($data['fecha_inicio']);
        $fecha_vencimiento  = Carbon::createFromDate($data['fecha_inicio']);

        for($i = 0; $i<$request->num_vigencias; $i++){


            $vigencia = new Vigencia;

            switch ($data['tipo']) {
                case 'sna':
                    $fecha_fin->addDays(7);
                    $fecha_vencimiento->addDays($data['dias_para_pagar']);
                    $data['fecha_inicio'] = $fecha_inicio->toDateString();
                    $data['fecha_vencimiento'] = $fecha_vencimiento->toDateString();
                    $fecha_inicio->addDays(7);
                    $fecha_vencimiento->addDays(7);
                    break;
                case 'qui':
                    $fecha_fin->addDays(15);
                    $fecha_vencimiento->addDays($data['dias_para_pagar']);
                    $data['fecha_inicio'] = $fecha_inicio->toDateString();
                    $data['fecha_vencimiento'] = $fecha_vencimiento->toDateString();
                    $fecha_inicio->addDays(15);
                    $fecha_vencimiento->addDays(15);
                    break;
                case 'men':
                    $fecha_fin->addMonth();
                    $fecha_vencimiento->addDays($data['dias_para_pagar']);
                    $data['fecha_inicio'] = $fecha_inicio->toDateString();
                    $data['fecha_vencimiento'] = $fecha_vencimiento->toDateString();
                    $fecha_inicio->addMonth();
                    $fecha_vencimiento->addMonth();
                    break;
                case 'tri':
                    $fecha_fin->addMonths(3);
                    $fecha_vencimiento->addDays($data['dias_para_pagar']);
                    $data['fecha_inicio'] = $fecha_inicio->toDateString();
                    $data['fecha_vencimiento'] = $fecha_vencimiento->toDateString();
                    $fecha_inicio->addMonths(3);
                    $fecha_vencimiento->addMonths(3);
                    break;
                case 'sem':
                    $fecha_fin->addMonths(6);
                    $fecha_vencimiento->addDays($data['dias_para_pagar']);
                    $data['fecha_inicio'] = $fecha_inicio->toDateString();
                    $data['fecha_vencimiento'] = $fecha_vencimiento->toDateString();
                    $fecha_inicio->addMonths(6);
                    $fecha_vencimiento->addMonths(6);
                    break;
                case 'anu':
                    $fecha_fin->addMonths(12);
                    $fecha_vencimiento->addDays($data['dias_para_pagar']);
                    $data['fecha_inicio'] = $fecha_inicio->toDateString();
                    $data['fecha_vencimiento'] = $fecha_vencimiento->toDateString();
                    $fecha_inicio->addMonths(12);
                    $fecha_vencimiento->addMonths(12);
                    break;
            }


            $data['fecha_fin'] = $fecha_fin->toDateString();
            $data['estatus'] = 'pen';

            $vigencia->create($data);

            //$fecha_vencimiento->subDays($data['dias_para_pagar']);

        }

        return ['titulo'=>'Agregar Vigencias', 'msg'=>'Las vigencias han sido creadas.', 'class'=>'success'];
    }

    /*----------  Ver  ----------*/
    public function ver($hash_id){
        $vigencia = Vigencia::findOrFail(Hashids::decode($hash_id)[0]);
        return view('admin.modules.vigencias.ver', compact('vigencia'));
    }

    /*----------  Editar  ----------*/
    public function editar($hash_id, Request $request){
        $vigencia = Vigencia::findOrFail(Hashids::decode($hash_id)[0]);
        $data = $request->all();
        $data['monto'] = str_replace(['$', ' ', '.00', ','], '', $request->monto);

        $vigencia->update($data);
        return ['titulo'=>'Editar Vigencia', 'msg'=>'La vigencia ha sido editada.', 'class'=>'success'];
    }
}
