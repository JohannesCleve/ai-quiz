<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Mary\Traits\Toast;

class Home extends Component
{
    use Toast;


    public function mount(): void
    {
    }

    public function showCreateQuizModal()
    {
        $this->success('Page Loaded', position: 'toast-bottom');
    }


    public function render()
    {
        return view('livewire.home');
    }
}
