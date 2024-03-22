<?php

namespace App\Livewire;

use App\Models\Quiz;
use Illuminate\Support\Collection;
use Livewire\Component;

class QuizCardIndex extends Component
{
    public string $type = '';

    public Collection $quizzes;

    public function mount(string $type)
    {
        if ($type === 'active') {
            $this->quizzes = Quiz::active()->get();
        } else {
            $this->quizzes = Quiz::archived()->get();
        }
    }

    public function render()
    {
        return view('livewire.quiz-card-index');
    }
}
