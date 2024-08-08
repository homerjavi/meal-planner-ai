<?php

namespace App\Livewire;

use Livewire\Component;

class MealTime extends Component
{
    public $mealHour;

    public function mount($mealHour)
    {
        $this->mealHour = $mealHour;
    }

    public function updateOrder()
    {
    }

    public function render()
    {
        return view('livewire.meal-time');
    }
}
