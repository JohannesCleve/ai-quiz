<?php

namespace App\Livewire\HomePage;

use App\Models\Quiz;
use Livewire\Component;

class Statistics extends Component
{
    public array $statistics = [];

    public function mount(): void
    {
        $quizCount = Quiz::active()->count();
        $questionCount = Quiz::active()->withCount('questions')->get()->sum('questions_count');
        $pointsSum = Quiz::active()->sum('points');

        $this->setStatistics($quizCount, $questionCount, $pointsSum);
    }

    protected function setStatistics(int $quizCount, int $questionCount, int $pointsSum): void
    {
        $this->statistics = [
            [
                'title' => 'Quizzes',
                'value' => $quizCount,
                'icon' => 'o-academic-cap',
                'tooltip' => 'Number of quizzes you have created'
            ],
            [
                'title' => 'Questions',
                'value' => $questionCount,
                'icon' => 'o-light-bulb',
                'tooltip' => 'Total number of questions in all quizzes',
            ],
            [
                'title' => 'Points',
                'value' => $pointsSum,
                'icon' => 'o-trophy',
                'tooltip' => 'Total number of points you have earned',
            ]
        ];
    }

    public function render()
    {
        return view('livewire.shared.statistics');
    }
}
