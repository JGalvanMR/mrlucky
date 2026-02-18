<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Maxlength extends Component
{
    public $max;
    public $name;
    public $class;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($max=100, $name='titulo', $class = 'max', $value = '')
    {
        $this->max = $max;
        $this->class = $class;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.maxlength');
    }
}
