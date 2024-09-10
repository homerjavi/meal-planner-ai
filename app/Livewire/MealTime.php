<?php

namespace App\Livewire;

use Livewire\Component;

class MealTime extends Component
{
    public $turn;
    public $key;
    public $icons = [
        'heroicon-o-cloud',
        'heroicon-o-sun',
        'heroicon-o-moon',
        'heroicon-o-moon',
    ];
    
    protected $listeners = ['updateTurn'];

    public function mount($turn)
    {
        $this->key = 0;
        $this->updateTurn($turn);
    }

    public function updateTurn($turn)
    {
        $this->turn = $turn;
    }

    public function updateOrder()
    {
    }

    public function render()
    {
        return view('livewire.meal-time');
    }
}
