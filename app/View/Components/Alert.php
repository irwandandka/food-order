<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $message;
    public $type;
    public function __construct()
    {
        $this->message = session('message');
        $this->type = session('type');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert', [
            'message' => $this->message,
            'type' => $this->type,
        ]);
    }
}
