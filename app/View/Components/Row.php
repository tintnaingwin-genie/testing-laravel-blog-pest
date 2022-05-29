<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Row extends Component
{
    public function __construct(
        public bool $header = false,
        public string $class = '',
    ) {
    }

    public function render()
    {
        return view('components.row');
    }
}
