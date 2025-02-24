<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public $showSearch;
    public $areas;
    public $genres;

    /**
     * Create a new component instance.
     */
    public function __construct($showSearch = false, $areas = [], $genres = [])
    {
        $this->showSearch = $showSearch;
        $this->areas = $areas;
        $this->genres = $genres;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
