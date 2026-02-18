<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IconPicker extends Component
{
    public $name;
    public $class;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name='icon', $class='icon', $value='')
    {
        $this->name = $name;
        $this->class = $class;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.icon-picker');
    }
}
