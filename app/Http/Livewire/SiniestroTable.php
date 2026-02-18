<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Siniestro;

class SiniestroTable extends DataTableComponent
{
    protected $model = Siniestro::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),

            Column::make("Num siniestro", "num_siniestro")
                ->format(fn($value)=> $value ?? '--')
                ->sortable(),
            
            Column::make("Fecha", "fecha")
                ->format(function($value){
                    if($value){
                        return date('d/m/Y', strtotime($value));
                    }else{
                        return '--';
                    }
                })
                ->sortable(),
            
            Column::make("Hora de arribo", "hora_arribo")
                ->format(function($value){
                    if($value){
                        return date('H:m:s', strtotime($value));
                    }else{
                        return '--';
                    }
                })
                ->sortable(),
            
            Column::make("Hora de retiro", "hora_retiro")
                ->format(function($value){
                    if($value){
                        return date('H:m:s', strtotime($value));
                    }else{
                        return '--';
                    }
                })
                ->sortable(),

            Column::make("Póliza", "poliza.num_poliza")
                ->format(fn($value)=> $value ?? '--')
                ->sortable(),

            Column::make("Estatus", "estatus")
                ->format(function($value){
                    switch($value){
                        case 'pro':
                            echo '<span class="label label-warning">Proceso</span>';
                            break;
                        case 'con':
                            echo '<span class="label label-info">Siniestro concluído</span>';
                            break;
                        case 'cer':
                            echo '<span class="label label-primary">Asunto cerrado</span>';
                            break;
                        default:
                            echo '--';
                    }
                })
                ->sortable(),

            Column::make("Cliente", "poliza.cliente.nombre")
                ->format(function($val){
                    echo $val;
                })
                ->sortable(),
        
            
            Column::make('Acciones', 'id')
                ->label(fn($row) => view('admin.modules.siniestros.datatable.acciones', compact('row'))),
        ];
    }
}
