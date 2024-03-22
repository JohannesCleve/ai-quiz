<?php

namespace App\Livewire;

use App\Models\Quiz;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

class QuizPage extends Component
{
    public Quiz $quiz;

    public string $topic;

    public array $stats = [];

    public function mount(Quiz $quiz): void
    {
        $this->quiz = $quiz->load('questions');

        $this->topic = $quiz->topic;

        $this->stats = [
            [
                'title' => 'Questions',
                'value' => $this->quiz->questions->count(),
                'icon' => 'o-light-bulb',
                'tooltip' => 'Total number of questions in this quiz',
            ],
            [
                'title' => 'Points',
                'value' => $this->quiz->points,
                'icon' => 'o-trophy',
                'tooltip' => 'Total number of points you have earned in this quiz',
            ]
        ];
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
