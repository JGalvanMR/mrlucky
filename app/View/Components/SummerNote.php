<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SummerNote extends Component
{
    public $name;
    public $value;
    public $height;
    public $scripts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = 'descripcion', $value = '', $height = 200, $scripts=1)
    {
        $this->name = $name;
        $this->value = $value;
        $this->height = $height;
        $this->scripts = $scripts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.summer-note');
    }
}
