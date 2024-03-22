<div>
    <x-header title="AI Quiz" separator progress-indicator>
        <x-slot:actions>
            <livewire:home-page.create-quiz />
        </x-slot:actions>
    </x-header>

    <livewire:home-page.statistics />

    <x-tabs wire:model="selectedTab">
        <x-tab name="active" label="Active" icon="o-bolt">
            <livewire:home-page.quiz-card-index type="active" />
        </x-tab>
        <x-tab name="archived" label="Archived" icon="o-archive-box">
            <livewire:home-page.quiz-card-index type="archived" />
        </x-tab>
    </x-tabs>
</div>
