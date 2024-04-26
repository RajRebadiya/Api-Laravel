<?php

namespace App\View\Components;

use Illuminate\View\Component;

class sid extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $studentId = '';
    public function __construct($id)

    {
        //
        $this->studentId = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sid');
    }
}
