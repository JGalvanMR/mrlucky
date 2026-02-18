<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Asistencia;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

class AsistenciaTable extends DataTableComponent
{
    protected $model = Asistencia::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),

            Column::make("Folio", "folio")
                ->format(fn($value) => ($value) ? $value : '--')
                ->searchable()
                ->sortable(),

            Column::make("Fecha", "fecha")
                ->format(fn($value) =>date('d/m/Y', strtotime($value)))
                ->searchable()
                ->sortable(),

            Column::make("Tipo", "tipo")
                ->format(function($value){
                    if($value == 'par'){
                        echo 'Particular';
                    }else{
                        echo 'Asegurado';
                    }
                })
                ->sortable(),

            Column::make("Tipo de Asistencia", "tipo_asistencia")
                ->format(function($value){

                    switch($value){
                        case 'gas':
                            echo  'Gasolina';
                            break;
                        case 'cam':
                            echo  'Cambio de llanta';
                            break;
                        case 'pas':
                            echo  'Paso de corriente';
                            break;
                        case 'gru':
                            echo  'Grúa';
                            break;
                        case 'aju':
                            echo  'Ajustador';
                            break;
                        case 'cer':
                            echo  'Cerrajero';
                            break;
                        default:
                            echo '--';

                    }

                })
                ->sortable(),

            Column::make("Estatus", "estatus")
                ->format(fn($value) => ($value == '1') ? '<span class="label label-success">Terminado</span>' : '<span class="label label-warning">Proceso</span>')
                ->html()
                ->sortable(),

            Column::make("Hora arribo", "hora_arribo")
                ->format(fn($value) => ($value) ? date('H:m', strtotime($value)) : '--')
                ->sortable(),

            Column::make("Hora retiro", "hora_retiro")
                ->format(fn($value) => ($value) ? date('H:m', strtotime($value)) : '--')
                ->sortable(),

            Column::make('Acciones', 'id')
                ->label(fn($row) => view('admin.modules.asistencias.datatable.acciones', compact('row'))),

        ];

    }

    public function filters(): array{
        return [
            SelectFilter::make('Tipo', 'tipo')
                ->options([
                    '' =>'Todos',
                    'par'=>'Particular',
                    'ase'=>'Asegurado',
                ])->filter( function($query, $value){
                    if($value != ''){
                        $query->where('tipo',$value);
                    }
                }),
            SelectFilter::make('Estatus', 'estatus')
                ->options([
                    '' =>'Todos',
                    '0'=>'Proceso',
                    '1'=>'Terminado',
                ])->filter( function($query, $value){
                    if($value != ''){
                        $query->where('estatus',$value);
                    }
                }),
            SelectFilter::make('Tipo Asistencia', 'tipo_asistencia')
                ->options([
                    '' =>'Todos',
                    'gas'=>'Gasolina',
                    'cam'=>'Cambio de llanta',
                    'pas'=>'Paso de corriente',
                    'gru'=>'Grúa',
                    'aju'=>'Ajustador',
                    'cer'=>'Cerrajero',
                ])->filter( function($query, $value){
                    if($value != ''){
                        $query->where('tipo_asistencia',$value);
                    }
                }),
            DateFilter::make('Fecha','fecha')->filter( function($query, $value){
                    if($value != ''){
                        $query->where('fecha', '=', $value);
                    }
                }),
        ];
    }
}

