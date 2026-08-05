<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PresupuestoDropdown extends Component
{

    public  $presupuesto;

    public function __construct( $presupuesto) 
    {
        $this->presupuesto = $presupuesto;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.presupuesto-dropdown');
    }
}
