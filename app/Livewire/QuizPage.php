<?php

namespace App\Livewire;

use App\Models\Quiz;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

class QuizPage extends Component
{
    public Quiz $quiz;

    public string $topic;

    public function mount(Quiz $quiz): void
    {
        $this->quiz = $quiz->load('questions');

        $this->topic = $quiz->topic;
    }

    public function addQuestions()
    {
        dd('Add questions');
    }

    public function render()
    {
        return view('livewire.quiz-page');
    }
}
