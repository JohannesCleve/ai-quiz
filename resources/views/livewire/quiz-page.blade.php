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

            <x-dropdown>
                <x-menu-item title="Archive" icon="o-archive-box" wire:click="showArchiveModal" />
                <x-menu-item title="Remove" icon="o-trash" wire:click="showRemoveModal" />
                <x-menu-item title="Reset points" icon="o-arrow-path" wire:click="showResetPointsModal" />
            </x-dropdown>
        </x-slot:actions>
    </x-header>

    <livewire:statistics :stats="$stats" />

    <x-modal wire:model="showModal" persistent class="backdrop-blur">
        <div>{{ $modalMessage }}</div>
        <x-slot:actions>
            <x-button label="Cancel" wire:click="cancelModal" />
            <x-button :label="$modalAction" wire:click="confirmAction" class="btn-error" />
        </x-slot:actions>
    </x-modal>

</div>
