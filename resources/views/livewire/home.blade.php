<div>
    <x-header title="AI Quiz" separator progress-indicator>

        <x-slot:actions>
            <x-button
                label="New Quiz"
                wire:click="showCreateQuizModal"
                icon="o-plus"
                class="btn-primary"
            />
        </x-slot:actions>
    </x-header>

    <livewire:statistics />

    <div class="flex flex-wrap justify-center gap-8 bg-slate-200 shadow p-16 rounded-xl">
        <livewire:quiz-card />
        <livewire:quiz-card />
        <livewire:quiz-card />
        <livewire:quiz-card />
        <livewire:quiz-card />
        <livewire:quiz-card />
        <livewire:quiz-card />
        <livewire:quiz-card />
        <livewire:quiz-card />
    </div>
</div>
