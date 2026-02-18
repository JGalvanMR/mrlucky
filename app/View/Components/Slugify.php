<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Slugify extends Component
{
    public $titulo;
    public $name;
    public $slug;
    public $requerido;
    public $requeridoText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($titulo='titulo', $name='slug', $slug='slug', $requerido=0, $requeridoText='')
    {
        $this->titulo = $titulo;
        $this->name = $name;
        $this->slug = $slug;
        $this->requerido = $requerido;
        $this->requeridoText = $requeridoText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.slugify');
    }
}
