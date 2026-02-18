<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataTables extends Component
{
    public $exportable;
    public $scripts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($exportable=0, $scripts=1)
    {
        $this->exportable = $exportable;
        $this->scripts = $scripts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.data-tables');
    }
}
