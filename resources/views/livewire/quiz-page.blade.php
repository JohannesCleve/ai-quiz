<div>
    <x-header :title="$topic" separator progress-indicator>

        <x-slot:actions>
            <x-button
                label="Add Questions"
                icon="o-plus"
                class="btn-primary"
                wire:click="addQuestions"
            />
        </x-slot:actions>
    </x-header>

    <livewire:statistics :stats="$stats" />
</div>
