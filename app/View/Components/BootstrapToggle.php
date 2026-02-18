<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BootstrapToggle extends Component
{
    public $name;
    public $onText;
    public $offText;
    public $size;
    public $width;
    public $checked;
    public $scripts;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = "activo", $onText = "On", $offText = "Off", $size = "normal", $width = 110, $checked = 0, $scripts = 1)
    {
        $this->name = $name;
        $this->onText = $onText;
        $this->offText = $offText;
        $this->size = $size;
        $this->width = $width;
        $this->checked = $checked;
        $this->scripts = $scripts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.bootstrap-toggle');
    }
}
