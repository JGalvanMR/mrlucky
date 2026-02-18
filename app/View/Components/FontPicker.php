<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FontPicker extends Component
{
    public $name;
    public $class;
    public $value;
    public $scripts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name='font', $class='font', $value='', $scripts=1)
    {
        $this->name = $name;
        $this->class = $class;
        $this->scripts = $scripts;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.font-picker');
    }
}
