<div>
    <x-header :title="$topic" separator progress-indicator>
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

    <livewire:statistics :stats="$stats" />
</div>
