<?php

namespace App\Livewire\QuizPage;

use App\Models\Quiz;
use Livewire\Component;

class Actions extends Component
{
    public Quiz $quiz;

    public bool $showModal = false;

    public string $modalMessage = '';

    public string $modalAction = '';

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

        $this->redirect(route('home-page'));
    }

    protected function unarchiveQuiz(): void
    {
        $this->quiz->update([
            'archived_at' => null,
        ]);

        $this->redirect(route('home-page'));
    }

    protected function removeQuiz(): void
    {
        $this->quiz->delete();

        $this->redirect(route('home-page'));
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
        return view('livewire.quiz-page.actions');
    }
}
