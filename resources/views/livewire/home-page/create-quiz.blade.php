<div>
    <x-button
        label="New Quiz"
        @click="$wire.showModal = true"
        icon="o-plus"
        class="btn-primary"
    />

    <x-modal
        wire:model="showModal"
        title="Create Quiz"
        persistent
        class="backdrop-blur"
    >
        <div wire:loading.remove>
            <x-input
                wire:model="topic"
                placeholder="The topic of your quiz"
                icon="o-academic-cap"
                hint="Questions will be based on this topic"
                wire:keydown.enter="create"
            />
        </div>

        <div wire:loading>
            Wait while we create your quiz, this won't take long...
        </div>

        <x-slot:actions>
            <x-button label="Cancel" wire:click="hideModal" wire:loading.attr="disabled" />
            <x-button label="Create" wire:click="create" class="btn-success" wire:loading.attr="disabled" />
        </x-slot:actions>
    </x-modal>
</div>
