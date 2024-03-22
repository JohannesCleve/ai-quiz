<?php

namespace App\Livewire\HomePage;

use App\Models\Quiz;
use Livewire\Component;

class QuizCard extends Component
{
    public Quiz $quiz;

    public function render()
    {
        return view('livewire.home-page.quiz-card');
    }
}
