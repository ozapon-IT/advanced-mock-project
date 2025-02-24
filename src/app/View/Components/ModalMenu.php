<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalMenu extends Component
{
    public $role;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        if (auth()->check()) {
            switch (auth()->user()->role) {
                case 1:
                    $this->role = 'user';
                    break;
                case 2:
                    $this->role ='representative';
                    break;
                case 3:
                    $this->role ='admin';
                    break;
                default:
                    $this->role ='guest';
                    break;
            }
        } else {
            $this->role ='guest';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-menu');
    }
}
