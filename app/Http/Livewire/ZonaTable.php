<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Zona;

class ZonaTable extends DataTableComponent
{
    protected $model = Zona::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make("Zona", "zona")
                ->searchable()
                ->sortable(),
            Column::make("Descripción", "descripcion")
                ->format(fn($value) => $value)
                ->html()
                ->searchable()
                ->sortable(),
            Column::make("Cobrador", "cobrador.name")
                ->format(fn($value) => $value ?? '--')
                ->sortable(),
            Column::make('Acciones', 'id')
                ->label(fn($row) => view('admin.modules.zonas.datatable.acciones', compact('row'))),
        ];
    }
}
