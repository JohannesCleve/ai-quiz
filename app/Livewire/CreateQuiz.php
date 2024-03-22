<?php

namespace App\Livewire;

use App\Models\Quiz;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateQuiz extends Component
{
    public bool $showModal = false;

    #[Rule('required', message: 'Please give a topic for the quiz.')]
    #[Rule('max:50', message: 'The topic should not be more than 50 characters.')]
    public string $topic = '';

    public function create(): void
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
        $this->showModal = false;

        $this->redirect(route('quiz-page', $quiz->slug));
    }

    public function hideModal(): void
    {
        $this->topic = '';
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.create-quiz');
    }
}
