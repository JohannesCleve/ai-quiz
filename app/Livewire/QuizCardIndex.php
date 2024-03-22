<?php

namespace App\Livewire;

use App\Models\Quiz;
use Illuminate\Support\Collection;
use Livewire\Component;

class QuizCardIndex extends Component
{
    public string $type = '';

    public Collection $quizzes;

    public function mount(string $type): void
    {
        if ($type === 'active') {
            $this->quizzes = Quiz::active()->orderBy('created_at', 'desc')->get();
        } else {
            $this->quizzes = Quiz::archived()->orderBy('archived_at', 'desc')->get();
        }
    }

    public function render()
    {
        return view('livewire.quiz-card-index');
    }
}
