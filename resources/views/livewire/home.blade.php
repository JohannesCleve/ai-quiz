<div>
    <x-header title="AI Quiz" separator progress-indicator>

        <x-slot:actions>
            <x-button
                label="New Quiz"
                @click="$wire.showCreateQuizModal = true"
                icon="o-plus"
                class="btn-primary"
            />
        </x-slot:actions>
    </x-header>

    <livewire:statistics :stats="$stats" />

    <div class="grid grid-cols-3 gap-8 bg-slate-200 shadow p-16 rounded-xl">
        @if($quizzes->isEmpty())
            <div class="text-center text-slate-500 col-span-3">
                No quizzes found. Click the "New Quiz" button to create one.
            </div>
        @endif

        @foreach($quizzes as $quiz)
            <livewire:quiz-card :quiz="$quiz" :key="$quiz->slug" />
        @endforeach
    </div>

    <x-modal
        wire:model="showCreateQuizModal"
        title="Create Quiz"
        persistent
        class="backdrop-blur"
    >
        <x-input
            wire:model="topic"
            placeholder="The topic of your quiz"
            icon="o-academic-cap"
            hint="Questions will be based on this topic"
            wire:keydown.enter="createQuiz"
        />
        <x-slot:actions>
            <x-button label="Cancel" wire:click="hideShowQuizModal" />
            <x-button label="Create" wire:click="createQuiz" class="btn-success" />
        </x-slot:actions>
    </x-modal>
</div>
