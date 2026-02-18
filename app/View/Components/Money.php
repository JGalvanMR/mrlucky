<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Money extends Component
{
    public $name;
    public $value;
    public $prefix;
    public $suffix;
    public $precision;
    public $allowZero;
    public $requerido;
    public $requeridoText;
    public $scripts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name="", $value="", $prefix="$", $suffix="", $precision=2, $allowZero=0, $requerido=0, $requeridoText="*El monto es requerido.", $scripts=1)
    {
        $this->name = $name;
        $this->value = $value;
        $this->prefix = $prefix;
        $this->suffix = $suffix;
        $this->precision = $precision;
        $this->allowZero = $allowZero;
        $this->requerido = $requerido;
        $this->requeridoText = $requeridoText;
        $this->scripts = $scripts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.money');
    }
}
