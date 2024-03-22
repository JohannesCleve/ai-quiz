<?php

namespace App\Livewire\QuizPage;

use App\Models\Quiz;
use Livewire\Attributes\On;
use Livewire\Component;

class Statistics extends Component
{
    public Quiz $quiz;

    public array $statistics = [];

    public function mount(Quiz $quiz): void
    {
        $this->quiz = $quiz;

        $this->setStatistics();
    }

    #[On('questions.answered')]
    public function setStatistics(): void
    {
        $points = $this->quiz->points;

        $this->statistics = [
            [
                'title' => 'Questions',
                'value' => $this->quiz->questions->count(),
                'icon' => 'o-light-bulb',
                'tooltip' => 'Total number of questions in this quiz',
            ],
            [
                'title' => 'Points',
                'value' => $points,
                'icon' => 'o-trophy',
                'tooltip' => 'Total number of points you have earned in this quiz',
            ]
        ];
    }
    public function render()
    {
        return view('livewire.shared.statistics');
    }
}
