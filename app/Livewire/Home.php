<?php

namespace App\Livewire;

use App\Models\Quiz;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Mary\Traits\Toast;

class Home extends Component
{
    use Toast;

    public bool $showCreateQuizModal = false;

    #[Rule('required', message: 'Please give a topic for the quiz.')]
    public string $topic = '';

    public array $stats;

    public function mount()
    {
        $this->stats = [
            [
                'title' => 'Quizzes',
                'value' => 44, // TODO: Check the total number of questions.
                'icon' => 'o-academic-cap',
                'tooltip' => 'Number of quizzes you have created'
            ],
            [
                'title' => 'Questions',
                'value' => 144, // TODO: Check the total number of questions.
                'icon' => 'o-light-bulb',
                'tooltip' => 'Total number of questions in all quizzes',
            ],
            [
                'title' => 'Points',
                'value' => 10, // TODO: Check the total number of points.
                'icon' => 'o-trophy',
                'tooltip' => 'Total number of points you have earned',
            ]
        ];
    }

    public function createQuiz(): void
    {
        $this->validate();

        $slug = Str::slug($this->topic);

        $existingQuiz = Quiz::where('slug', $slug)->first();

        if($existingQuiz) {
            $slug = $slug . '-' . time();
        }

        $quiz = Quiz::create([
            'slug' => $slug,
            'topic' => $this->topic,
            'messages' => [],
        ]);

        $this->topic = '';
        $this->showCreateQuizModal = false;

        $this->redirect(route('quiz-page', $quiz->slug));
    }

    public function hideShowQuizModal(): void
    {
        $this->topic = '';
        $this->showCreateQuizModal = false;
    }

    public function render()
    {
        return view('livewire.home');
    }
}
