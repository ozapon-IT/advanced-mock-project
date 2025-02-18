<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\Facades\Session;

class SessionMessage extends Component
{
    public $errorMessage;
    public $successMessage;

    /**
     * Create a new component instance.
     */
    public function __construct(ViewErrorBag $errors)
    {
        $this->errorMessage = $errors->has('error') ? $errors->first('error') : null;
        $this->successMessage = Session::get('success');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.session-message');
    }
}
