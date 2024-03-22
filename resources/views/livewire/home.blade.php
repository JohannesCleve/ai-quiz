<div>
    <x-header title="AI Quiz" separator progress-indicator>
        <x-slot:actions>
            <livewire:create-quiz />
        </x-slot:actions>
    </x-header>

    <livewire:statistics :stats="$stats" />

    <x-tabs wire:model="selectedTab">
        <x-tab name="active" label="Active" icon="o-bolt">
            <livewire:quiz-card-index type="active" />
        </x-tab>
        <x-tab name="archived" label="Archived" icon="o-archive-box">
            <livewire:quiz-card-index type="archived" />
        </x-tab>
    </x-tabs>
</div>
