<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientesExport;
use Hashids;

class ClienteTable extends DataTableComponent
{
    protected $model = Cliente::class;

   /* public array $bulkActions = [
        'deleteSelected' => 'Eliminar',
        'exportSelected' => 'Exportar',
    ];*/

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchDebounce(500);
        $this->setSingleSortingDisabled();
        $this->setPerPageAccepted([10,15,20,50]);
        $this->setPerPage(10);
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
                ->searchable()
                ->collapseOnMobile()
                ->sortable(),

            Column::make("Nombre", "nombre")
                ->searchable()
                ->sortable(),

            Column::make("Apellido paterno", "apellido_paterno")
                ->sortable(),

            Column::make("Apellido materno", "apellido_materno")
                ->searchable()
                ->sortable(),

            Column::make("Fecha nacimiento", "fecha_nacimiento")
                ->format(fn($value) =>date('d/m/Y', strtotime($value)))
                ->collapseOnMobile()
                ->sortable(),

            Column::make("Genero", "genero")
                ->format(fn($value) => view('admin.modules.clientes.datatable.genero', compact('value')))
                ->sortable(),


            Column::make("RFC", "rfc")
                ->searchable()
                ->sortable()
                ->format(fn($value) => ($value) ? $value : '--'),

            Column::make("CURP", "curp")
                ->searchable()
                ->sortable()
                ->format(fn($value) => ($value) ? $value : '--'),

            Column::make("Correo", "correo")
                ->searchable()
                ->sortable(),

            Column::make("Teléfono", "telefono")
                ->searchable()
                ->sortable()
                ->format(fn($value) => ($value) ? $value : '--'),

            Column::make("Direccion", "direccion")
                ->searchable()
                ->sortable()
                ->format(fn($value) => ($value) ? $value : '--'),

            Column::make("Colonia", "colonia")
                ->searchable()
                ->sortable()
                ->format(fn($value) => ($value) ? $value : '--'),

            Column::make("Codigo postal", "codigo_postal")
                ->searchable()
                ->sortable()
                ->format(fn($value) => ($value) ? $value : '--'),

            Column::make('Foto', 'foto')
                ->format(function($value){
                        if($value){
                            return '<a href="/uploads/'.$value.'" class="magnific" data-toggle="tooltip" title="Ver foto">
                                        <img src="/uploads/'.$value.'" class="img-fluid" />
                                    </a>';
                        }else{
                            return '--';
                        }
                    })
                ->html(),

            Column::make('INE Frontal', 'ine_frontal')
                ->format(function($value){
                        if($value){
                            return '<a href="/uploads/'.$value.'" class="magnific" data-toggle="tooltip" title="Ver INE">
                                        <img src="/uploads/'.$value.'" class="img-fluid" />
                                    </a>';
                        }else{
                            return '--';
                        }
                    })
                ->html(),

            Column::make('INE Reverso', 'ine_reverso')
                ->format(function($value){
                        if($value){
                            return '<a href="/uploads/'.$value.'" class="magnific" data-toggle="tooltip" title="Ver INE">
                                        <img src="/uploads/'.$value.'" class="img-fluid" />
                                    </a>';
                        }else{
                            return '--';
                        }
                    })
                ->html(),

            Column::make("Fecha de alta", "created_at")
                ->format(fn($value) => $value->format('d/m/Y')),

            Column::make("Última Actualización", "updated_at")
                ->format(fn($value) => $value->format('d/m/Y')),

            Column::make('Acciones', 'id')
                ->label(fn($row) => view('admin.modules.clientes.datatable.acciones', compact('row'))),
        ];
    }

    public function builder(): Builder{
            return Cliente::query()->with('polizas')
                ->select('clientes.*');
                //->when($this->getAppliedFilterWithValue('created_at'), fn($query, $created_at) => $query->where('created_at', '>', date('Y-m-d', strtotime($created_at))));
    }

    public function filters(): array{
        return [
            SelectFilter::make('Género', 'genero')
                ->options([
                    '' =>'Todos',
                    'h'=>'Hombre',
                    'm'=>'Mujer',
                ])->filter( function($query, $value){
                    if($value != ''){
                        $query->where('genero',$value);
                    }
                }),
            DateFilter::make('Fecha de alta','created_at')->filter( function($query, $value){
                    if($value != ''){
                        $query->where('created_at', '>=', $value);
                    }
                }),
        ];
    }

    /*----------  Eliminar clientes  ----------*/
    public function deleteSelected(){
        if($this->getSelected()){
            $clientes = Cliente::whereIn('id', $this->getSelected())->get();
            //Eliminar clientes
        }else{
            $this->emit('errorDelete', 'No hay registros seleccionados.');
        }

        $this->clearSelected();
    }

    /*----------  Exportar clientes  ----------*/
    public function exportSelected(){
        if($this->getSelected()){
            $clientes = Cliente::whereIn('id', $this->getSelected())->get();
            return Excel::download(new ClientesExport($clientes), 'clientes.xlsx');
        }else{
            $this->emit('errorExport', 'No hay registros seleccionados.');
        }

        $this->clearSelected();
    }


}
