<?php

namespace App\Livewire\HomePage;

use App\Jobs\CreateImage;
use App\Jobs\GenerateQuestionsJob;
use App\Models\Quiz;
use App\Services\QuestionsService;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
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

        $quiz = $this->createQuiz();

        CreateImage::dispatch($quiz);

        $service = new QuestionsService($quiz);
        $service->generateQuestions();

        $this->topic = '';
        $this->showModal = false;

        $this->redirect(route('quiz-page', $quiz->slug));
    }

    public function hideModal(): void
    {
        $this->topic = '';
        $this->showModal = false;
    }

    /**
     * @return mixed
     */
    public function createQuiz(): Quiz
    {
        $slug = Str::slug($this->topic);

        $existingQuiz = Quiz::where('slug', $slug)->first();

        if ($existingQuiz) {
            $slug = $slug.'-'.time();
        }

        return Quiz::create([
            'slug' => $slug,
            'topic' => $this->topic,
            'messages' => [],
        ]);
    }

    public function render()
    {
        return view('livewire.home-page.create-quiz');
    }
}
