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

    public bool $showCreateQuizModal = false;

    #[Rule('required', message: 'Please give a topic for the quiz.')]
    #[Rule('max:50', message: 'The topic should not be more than 50 characters.')]
    public string $topic = '';

    public Collection $quizzes;

    public array $stats;

    public string $selectedTab = 'active';

    public function mount()
    {
        $this->quizzes = Quiz::whereNull('archived_at')->orderBy('created_at', 'desc')->get();

        $this->setStats();
    }

    protected function setStats(): void
    {
        $this->stats = [
            [
                'title' => 'Quizzes',
                'value' => $this->quizzes->count(),
                'icon' => 'o-academic-cap',
                'tooltip' => 'Number of quizzes you have created'
            ],
            [
                'title' => 'Questions',
                'value' => $this->quizzes->map(fn(Quiz $quiz) => $quiz->questions->count())->sum(),
                'icon' => 'o-light-bulb',
                'tooltip' => 'Total number of questions in all quizzes',
            ],
            [
                'title' => 'Points',
                'value' => $this->quizzes->sum('points'),
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
