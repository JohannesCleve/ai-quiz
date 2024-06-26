<?php

namespace App\Livewire\QuizPage;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Questions extends Component
{
    public Quiz $quiz;

    public Question $question;

    public bool $showAnswer = false;

    public string $userAnswer = '';

    public Collection $questions;

    public $currentQuestionIndex = 0;

    public $hasNextQuestion = true;

    public function mount(Quiz $quiz): void
    {
        dump('Mounting questions');
        $this->quiz = $quiz;
        $this->questions = $quiz->questions;


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
        if($this->currentQuestionIndex >= $this->questions->count()) {
            return;
        }
        dump('Next question', $this->currentQuestionIndex, $this->questions);
        $this->question = $this->questions->get($this->currentQuestionIndex);
        $this->currentQuestionIndex++;
        $this->showAnswer = false;
        $this->userAnswer = '';

        if($this->currentQuestionIndex >= $this->questions->count()) {
            $this->hasNextQuestion = false;
        }
    }

    #[On('questions.added')]
    public function addQuestions(): void
    {
        dump('Adding questions');
        $questions = $this->quiz->fresh()->questions()->take(5)->get();

        $this->questions->push(...$questions);
        $this->hasNextQuestion = true;

        dump($this->questions->count());
    }

    public function render()
    {
        return view('livewire.quiz-page.questions');
    }
}
