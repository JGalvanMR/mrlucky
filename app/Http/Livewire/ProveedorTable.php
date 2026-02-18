<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use App\Models\Proveedor;
use App\Models\Ciudad;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProveedorExport;

class ProveedorTable extends DataTableComponent
{
    protected $model = Proveedor::class;

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

            Column::make("Tipo", "tipo")
                ->format(function($value){
                    switch($value){
                        case 'tal':
                            echo 'Taller';
                            break;
                        case 'ref':
                            echo 'Refaccionaria';
                            break;
                        case 'gru':
                            echo 'Grúa';
                            break;
                        default:
                            echo '--';
                    }
                })
                ->sortable(),

            Column::make("RFC", "rfc")
                ->searchable()
                ->sortable(),

            Column::make("Razon Social", "razon_social")
                ->searchable()
                ->sortable(),

            Column::make("Alias", "alias")
                ->searchable()
                ->sortable(),

            /*Column::make("Orden", "orden")
                ->searchable()
                ->collapseOnMobile()
                ->sortable(),*/

            Column::make("Estatus", "activo")
                ->format(fn($value) => view('admin.modules.proveedores.datatable.estatus', compact('value')))
                ->collapseOnMobile()
                ->sortable(),

            /*Column::make("Estado", "ciudad.estado.estado")
                ->format(fn($value) => $value ?? '--' )
                ->sortable(),*/

            /*Column::make("Ciudad", "ciudad.ciudad")
                ->format(function($value){
                    return $value;
                })
                ->sortable(),*/

            Column::make('Acciones', 'id')
                ->label(fn($row) => view('admin.modules.proveedores.datatable.acciones', compact('row'))),
        ];
    }

    /*public function builder(): Builder{
            return Proveedor::query()
                ->select('proveedores.*');
                //->when($this->getAppliedFilterWithValue('created_at'), fn($query, $created_at) => $query->where('created_at', '>', date('Y-m-d', strtotime($created_at))));
    }*/

    public function filters(): array{
        return [
            SelectFilter::make('Tipo', 'tipo')
                ->options([
                    '' =>'Todos',
                    'tal'=>'Taller',
                    'ref'=>'Refaccionaria',
                    'gru'=>'Grúa',
                ])->filter( function($query, $value){
                    if($value != ''){
                        $query->where('tipo',$value);
                    }
                }),
            SelectFilter::make('Estatus', 'activo')
                ->options([
                    '' =>'Todos',
                    '1'=>'Activo',
                    '0'=>'Inactivo',
                ])->filter( function($query, $value){
                    if($value != ''){
                        $query->where('activo',$value);
                    }
                }),
        ];
    }

    /*----------  Eliminar Proveedores  ----------*/
    public function deleteSelected(){
        if($this->getSelected()){
            $proveedores = Proveedor::whereIn('id', $this->getSelected())->get();
            //Eliminar proveedores
            //dd($proveedores->toArray());
            $proveedores->each->delete();
            $this->emit('successDeleteProveedor', 'El proveedor ha sido eliminado.');
        }else{
            $this->emit('errorDeleteProveedor', 'No hay registros seleccionados.');
        }

        $this->clearSelected();
    }

    /*----------  Exportar proveedores  ----------*/
    public function exportSelected(){
        if($this->getSelected()){
            $proveedores = Proveedor::whereIn('id', $this->getSelected())->get();
            $this->clearSelected();
            return Excel::download(new ProveedorExport($proveedores), 'proveedores.xlsx');
        }else{
            $this->emit('errorExportProveedor', 'No hay registros seleccionados.');
        }

        $this->clearSelected();
    }
}
