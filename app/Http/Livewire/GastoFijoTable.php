<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\GastoFijo;

class GastoFijoTable extends DataTableComponent
{
    protected $model = GastoFijo::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchDebounce(500);
        $this->setSingleSortingDisabled();
        $this->setPerPageAccepted([10,25,50,100,-1]);
        $this->setPerPage(25);
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

            Column::make("Concepto", "concepto")
                ->sortable(),

            Column::make("Monto", "monto")
                ->format(fn($value) => "$".number_format($value,2))
                ->sortable(),

            Column::make("Fecha", "fecha")
                ->format(fn($value) => date('d/m/Y', strtotime($value)))
                ->sortable(),

            Column::make("Descripción", "descripcion")
                ->format(fn($value) => $value ?? '--')
                ->html()
                ->sortable(),

            Column::make('Acciones', 'id')
                ->label(fn($row) => view('admin.modules.gastos-fijos.datatable.acciones', compact('row'))),
        ];
    }
}
