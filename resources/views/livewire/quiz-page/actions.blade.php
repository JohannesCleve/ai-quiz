<div>
    <x-dropdown>
        @if($quiz->archived)
            <x-menu-item title="Unarchive" icon="o-archive-box" wire:click="showUnarchiveModal" />
        @else
            <x-menu-item title="Archive" icon="o-archive-box" wire:click="showArchiveModal" />
        @endif
        <x-menu-item title="Remove" icon="o-trash" wire:click="showRemoveModal" />
        <x-menu-item title="Reset points" icon="o-arrow-path" wire:click="showResetPointsModal" />
    </x-dropdown>

    <x-modal wire:model="showModal" persistent class="backdrop-blur">
        <div>{{ $modalMessage }}</div>
        <x-slot:actions>
            <x-button label="Cancel" wire:click="cancelModal" />
            <x-button :label="$modalAction" wire:click="confirmAction" class="btn-error" />
        </x-slot:actions>
    </x-modal>
</div>
