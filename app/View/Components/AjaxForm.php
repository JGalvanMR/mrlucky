<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AjaxForm extends Component
{
    public $id;
    public $titulo;
    public $reload;
    public $redirect;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $titulo, $reload = 0, $redirect = 0)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->reload = $reload;
        $this->redirect = $redirect;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ajax-form');
    }
}
