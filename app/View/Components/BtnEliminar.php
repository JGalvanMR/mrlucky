<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BtnEliminar extends Component
{
    public $titulo;
    public $url;
    public $id;
    public $text;
    public $class;
    public $scripts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($titulo = "", $url=null, $id=null, $text = "", $class="btn-eliminar", $scripts = 0)
    {
        $this->titulo = $titulo;
        $this->url = $url;
        $this->id = $id;
        $this->text = $text;
        $this->class = $class;
        $this->scripts = $scripts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.btn-eliminar');
    }
}
