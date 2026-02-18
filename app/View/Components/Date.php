<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Date extends Component
{
    public $name;
    public $value;
    public $scripts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = "fecha", $value = null, $scripts = 1)
    {
        $this->name = $name;
        $this->value = $value;
        $this->scripts = $scripts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.date');
    }
}
