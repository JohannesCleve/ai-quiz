<div>
    <x-header :title="$quiz->topic" separator progress-indicator>
        <x-slot:actions>
            <x-button label="Home" link="/" icon="o-home" />

            <livewire:quiz-page.add-questions :quiz="$quiz" />

            <livewire:quiz-page.actions :quiz="$quiz" />
        </x-slot:actions>
    </x-header>

    <livewire:quiz-page.statistics :quiz="$quiz" />
</div>
