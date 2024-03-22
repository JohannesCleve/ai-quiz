<?php

namespace App\Livewire\QuizPage;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Support\Collection;
use Livewire\Component;

class Questions extends Component
{
    public Quiz $quiz;

    public Question $question;

    public bool $showAnswer = false;

    public string $userAnswer = '';

    public Collection $questions;

    public $currentQuestionIndex = 0;

    public function mount(Quiz $quiz): void
    {
        $this->quiz = $quiz;
        $this->questions = $quiz->questions->shuffle();


        $this->nextQuestion();
    }

    public function answered(string $option): void
    {
        if($this->showAnswer) {
            return;
        }

        if ($this->question->answer === $option) {
            $this->question->quiz->increment('points', 5);
        } else {
            $this->question->quiz->decrement('points', 5);
        }

        $this->showAnswer = true;
        $this->userAnswer = $option;
        $this->dispatch('questions.answered');
    }

    public function nextQuestion(): void
    {
        $this->question = $this->questions->get($this->currentQuestionIndex);
        $this->currentQuestionIndex++;
        $this->showAnswer = false;
        $this->userAnswer = '';
    }

    public function render()
    {
        return view('livewire.quiz-page.questions');
    }
}
