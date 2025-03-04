<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ValidationError extends Component
{
    public $field;
    public $yellow;

    /**
     * Create a new component instance.
     */
    public function __construct($field, $yellow = false)
    {
        $this->field = $field;
        $this->yellow = $yellow;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.validation-error');
    }
}
