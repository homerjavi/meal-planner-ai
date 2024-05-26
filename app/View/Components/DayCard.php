<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DayCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $mealsDay
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.day-card');
    }
}
