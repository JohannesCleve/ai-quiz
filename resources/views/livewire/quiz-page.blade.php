<div>
    <x-header :title="$quiz->topic" separator progress-indicator>
        <x-slot:actions>
            <x-button label="Home" link="/" icon="o-home" />

            <x-button
                label="Add Questions"
                icon="o-plus"
                class="btn-primary"
                wire:click="addQuestions"
            />

            <livewire:quiz-page.actions :quiz="$quiz" />
        </x-slot:actions>
    </x-header>

    <livewire:quiz-page.statistics :quiz="$quiz" />
</div>
