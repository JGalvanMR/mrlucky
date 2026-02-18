<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use App\Models\Vigencia;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProveedorExport;

class VigenciaTable extends DataTableComponent
{
    protected $model = Vigencia::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchDebounce(500);
        $this->setSingleSortingDisabled();
        $this->setPerPageAccepted([10,25,50,100,-1]);
        $this->setPerPage(25);
        //$this->setFilterLayout('slide-down');
        $this->setFilterLayoutPopover();
        $this->setBulkActions([
            'deleteSelected' => 'Eliminar',
            'exportSelected' => 'Exportar',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),

            Column::make("Póliza","poliza.num_poliza")
                ->searchable()
                ->sortable(),

            Column::make("Fecha de inicio", "fecha_inicio")
                ->format(function($value){
                    if($value){
                        return date('d/m/Y', strtotime($value));
                    }else{
                        return '--';
                    }
                })
                ->sortable(),

            Column::make("Fecha fin", "fecha_inicio")
                ->format(function($value){
                    if($value){
                        return date('d/m/Y', strtotime($value));
                    }else{
                        return '--';
                    }
                })
                ->sortable(),

            Column::make("Monto", "monto")
                ->format(fn($value)=>"$".number_format($value,2))
                ->sortable(),

            Column::make("Estatus", "estatus")
                ->format(function($estatus){
                    switch($estatus){
                        case 'pen':
                            echo '<span class="label label-warning">Pendiente</span>';
                            break;
                        case 'ven':
                            echo '<span class="label label-danger">Vencida</span>';
                            break;
                        case 'can':
                            echo '<span class="label label-inverse">Cancelada</span>';
                            break;
                        case 'act':
                            echo '<span class="label label-success">Activa</span>';
                            break;
                    }
                })
                ->sortable(),
            
            Column::make("Fecha límite de pago", "fecha_vencimiento")
                ->format(function($value){
                    if($value){
                        return date('d/m/Y', strtotime($value));
                    }else{
                        return '--';
                    }
                })
                ->sortable(),

            Column::make('Acciones', 'id')
                ->label(fn($row) => view('admin.modules.vigencias.datatable.acciones', compact('row'))),
        ];
    }

    public function filters(): array{
        return [
            SelectFilter::make('Estatus', 'vigencia.estatus')
                ->options([
                    '' =>'Todos',
                    'pen'=>'Pendiente',
                    'ven'=>'Vencida',
                    'can'=>'Cancelada',
                    'act'=>'Activa',
                ])->filter( function($query, $value){
                    if($value != ''){
                        $query->where('estatus',$value);
                    }
                }),
        ];
    }
}
