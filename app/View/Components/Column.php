<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Column extends Component
{
    public function __construct(
        public int $colspan = 1,
        public bool $right = false,
        public bool $center = false,
        public string $class = '',
    )
    {
    }

    public function render()
    {
        return view('components.column');
    }
}
