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

    public string $selectedTab = 'active';

    public function render()
    {
        return view('livewire.home');
    }
}
