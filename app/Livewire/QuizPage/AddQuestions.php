<?php

namespace App\Livewire\QuizPage;

use App\Models\Quiz;
use Livewire\Component;

class AddQuestions extends Component
{
    public Quiz $quiz;

    public function addQuestions()
    {
        dd('Add questions');
    }

    public function render()
    {
        return view('livewire.quiz-page.add-questions');
    }
}
