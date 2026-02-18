<?php

namespace App\Exports;

use App\Models\Proveedor;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProveedorExport implements FromCollection
{
    public $proveedores;


    public function __construct($proveedores){
        $this->proveedores = $proveedores;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->proveedores;
    }
}
