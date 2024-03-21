<?php

namespace App\Livewire;

use Livewire\Component;

class Statistics extends Component
{
    public array $stats;

    public function render()
    {
        return view('livewire.statistics');
    }
}
