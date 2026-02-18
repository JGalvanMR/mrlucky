<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Poliza;

class PolizaTable extends DataTableComponent
{
    protected $model = Poliza::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),

            Column::make("Núm. póliza", "num_poliza")
                ->searchable()
                ->sortable(),

            Column::make("Inicio vigencia", "vigencia_inicio")
                ->format(fn($value) => date('d/m/Y', strtotime($value) ?? '--' ))
                ->sortable(),

            Column::make("Fin vigencia", "vigencia_fin")
                ->format(fn($value) => date('d/m/Y', strtotime($value) ?? '--' ))
                ->sortable(),

            Column::make("Tipo de cliente", "tipo_cliente")
                ->format(function($value){
                    switch($value){
                        case '1':
                            echo 'Nuevo';
                            break;
                        case '2':
                            echo 'Renovación';
                            break;
                        case '3':
                            echo 'Preferente';
                            break;
                        case '4':
                            echo 'VIP';
                            break;
                        case '5':
                            echo 'Pendiente';
                            break;
                        default:
                            echo '--';
                    }
                })
                ->sortable(),

            Column::make("Marca", "submarca.marca.nombre")
                ->format(fn($value) => $value ?? '--')
                ->searchable()
                ->sortable(),

            Column::make("Submarca", "submarca.nombre")
                ->format(fn($value) => $value ?? '--')
                ->searchable()
                ->sortable(),

            Column::make("Modelo", "modelo")
                ->searchable()
                ->sortable(),

            Column::make("Color", "color")
                ->searchable()
                ->sortable(),

            Column::make("Placas", "placas")
                ->searchable()
                ->sortable(),

            Column::make("Cliente", "cliente.nombre")
                ->searchable()
                ->sortable(),

            Column::make("Estatus", "estatus")
                ->format( function($value){
                    switch($value){
                        case 'act';
                            echo '<span class="label label-success">Activo</span>';
                            break;
                        case 'can';
                            echo '<span class="label label-danger">Cancelado</span>';
                            break;
                        case 'ven';
                            echo '<span class="label label-warning">Vencido</span>';
                            break;
                        default:
                            echo '--';
                    }
                })
                ->sortable(),

            Column::make("Cobertura", 'cobertura')
                ->format( function($value){
                    switch($value){
                        case '1';
                            echo 'Cobertura Amplia';
                            break;
                        case '2';
                            echo 'Intermedia';
                            break;
                        case '3';
                            echo 'Terceros tipo A';
                            break;
                        case '4';
                            echo 'Terceros tipo B';
                            break;
                        case '5';
                            echo 'Terceros tipo C';
                            break;
                        default:
                            echo '--';
                    }
                })
                ->sortable(),

            Column::make("Tipo de póliza", "tipo")
                ->format( function($value){
                    switch($value){
                        case 'anu';
                            echo 'Anual';
                            break;
                        case 'sem';
                            echo 'Semestral';
                            break;
                        case 'tri';
                            echo 'Trimestral';
                            break;
                        case 'men';
                            echo 'Mensual';
                            break;
                        default:
                            echo '--';
                    }
                })
                ->sortable(),

            Column::make("Asesor", "asesor.name")
                ->format( fn($value) => $value ?? '--' )
                ->searchable()
                ->sortable(),

            Column::make('Acciones', 'id')
                ->label(fn($row) => view('admin.modules.polizas.datatable.acciones', compact('row'))),
        ];
    }
}
