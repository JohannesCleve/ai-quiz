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

    <livewire:statistics />

    <div class="flex flex-wrap justify-center gap-8 bg-slate-200 shadow p-16 rounded-xl">
        @for($i = 0; $i < 12; $i++)
            <livewire:quiz-card :key="$i" />
        @endfor
    </div>

    <x-modal
        wire:model="showCreateQuizModal"
        title="Create Quiz"
        persistent
        class="backdrop-blur"
    >
        <x-input
            wire:model="quizTitle"
            placeholder="The theme of your quiz"
            icon="o-academic-cap"
            hint="Questions will be based on this theme"
        />
        <x-slot:actions>
            <x-button label="Cancel" wire:click="hideShowQuizModal" />
            <x-button label="Create" wire:click="createQuiz" class="btn-success" />
        </x-slot:actions>
    </x-modal>
</div>
