<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Mary\Traits\Toast;

class Home extends Component
{
    use Toast;

    public bool $showCreateQuizModal = false;

    public string $quizTitle = '';

    public function createQuiz(): void
    {
        $this->quizTitle = '';
        $this->showCreateQuizModal = false;
    }

    public function hideShowQuizModal(): void
    {
        $this->quizTitle = '';
        $this->showCreateQuizModal = false;
    }


    public function mount(): void
    {
    }

    public function render()
    {
        return view('livewire.home');
    }
}
