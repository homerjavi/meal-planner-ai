<?php

namespace App\Livewire;

use Livewire\Component;

class LoadingOverlay extends Component
{
    public $isLoading = false;

    protected $listeners = ['toggleLoading'];

    public function toggleLoading($state = null)
    {
        if ($state !== null) {
            $this->isLoading = $state;
        } else {
            $this->isLoading = !$this->isLoading;
        }
    }

    public function render()
    {
        return view('livewire.loading-overlay');
    }
}
