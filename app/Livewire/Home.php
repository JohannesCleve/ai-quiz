<?php

namespace App\Livewire;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Mary\Traits\Toast;

class Home extends Component
{
    use Toast;

    public array $stats;

    public string $selectedTab = 'active';

    public function mount(): void
    {
        $quizCount = Quiz::active()->count();
        $questionCount = Quiz::active()->withCount('questions')->get()->sum('questions_count');
        $pointsSum = Quiz::active()->sum('points');

        $this->setStats($quizCount, $questionCount, $pointsSum);
    }

    protected function setStats(int $quizCount, int $questionCount, int $pointsSum): void
    {
        $this->stats = [
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
        return view('livewire.home');
    }
}
