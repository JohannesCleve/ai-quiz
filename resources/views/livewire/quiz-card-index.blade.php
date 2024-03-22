<div class="grid grid-cols-3 gap-8 bg-slate-200 shadow p-16 rounded-xl">
    @if($type === 'archived')
        <x-alert icon="o-exclamation-triangle" class="col-span-3" shadow>
            <p>
                Archived quizzes are no longer available for answering.
                You can still view the questions and points of the quiz.
            </p>
            <p>
                The total amount of quizzes, questions, and points are calculated based on only the active quizzes.
            </p>
            <p>
                You can unarchive any quiz to make it active again.
            </p>
        </x-alert>
    @endif

    @if($quizzes->isEmpty())
        <div class="text-center text-slate-500 col-span-3 mt-12">
            @if($type === 'active')
                You have no active quizzes. Click the "New Quiz" button to create one.
            @else
                You have no archived quizzes.
            @endif
        </div>
    @endif

    @foreach($quizzes as $quiz)
        <livewire:quiz-card :quiz="$quiz" :key="$quiz->slug" />
    @endforeach
</div>
