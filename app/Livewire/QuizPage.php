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

    public bool $showModal = false;

    public string $modalMessage = '';

    public string $modalAction = '';

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

    public function showArchiveModal(): void
    {
        $this->modalMessage = 'Are you sure you want to archive this quiz?';
        $this->modalAction = 'Archive';
        $this->showModal = true;
    }

    public function showUnarchiveModal(): void
    {
        $this->modalMessage = 'Are you sure you want to unarchive this quiz?';
        $this->modalAction = 'Unarchive';
        $this->showModal = true;
    }

    public function showRemoveModal(): void
    {
        $this->modalMessage = 'Are you sure you want to remove this quiz?';
        $this->modalAction = 'Remove';
        $this->showModal = true;
    }

    public function showResetPointsModal(): void
    {
        $this->modalMessage = 'Are you sure you want to reset the points for this quiz?';
        $this->modalAction = 'Reset Points';
        $this->showModal = true;
    }

    public function cancelModal(): void
    {
        $this->showModal = false;
        $this->modalMessage = '';
        $this->modalAction = '';
    }

    public function confirmAction(): void
    {
        if($this->modalAction === 'Archive') {
            $this->archiveQuiz();
        } elseif($this->modalAction === 'Unarchive') {
            $this->unarchiveQuiz();
        } elseif($this->modalAction === 'Remove') {
            $this->removeQuiz();
        } elseif($this->modalAction === 'Reset Points') {
            $this->resetQuizPoints();
        }
    }

    protected function archiveQuiz(): void
    {
        $this->quiz->update([
            'archived_at' => now(),
        ]);

        $this->redirect(route('home'));
    }

    protected function unarchiveQuiz(): void
    {
        $this->quiz->update([
            'archived_at' => null,
        ]);

        $this->redirect(route('home'));
    }

    protected function removeQuiz(): void
    {
        $this->quiz->delete();

        $this->redirect(route('home'));
    }

    protected function resetQuizPoints(): void
    {
        $this->quiz->update([
            'points' => 0,
        ]);

        $this->redirect(route('quiz-page', $this->quiz->slug));
    }

    public function render()
    {
        return view('livewire.quiz-page');
    }
}
