<?php

namespace App\Livewire\QuizPage;

use App\Models\Quiz;
use App\Services\QuestionsService;
use Livewire\Component;

class AddQuestions extends Component
{
    public Quiz $quiz;

    public function addQuestions(): void
    {
        $service = new QuestionsService($this->quiz);
        $service->generateQuestions();

        $this->dispatch('questions.added');
    }

    public function render()
    {
        return view('livewire.quiz-page.add-questions');
    }
}
