<div>
    <x-button
        label="New Quiz"
        @click="$wire.showCreateQuizModal = true"
        icon="o-plus"
        class="btn-primary"
    />

    <x-modal
        wire:model="showCreateQuizModal"
        title="Create Quiz"
        persistent
        class="backdrop-blur"
    >
        <x-input
            wire:model="topic"
            placeholder="The topic of your quiz"
            icon="o-academic-cap"
            hint="Questions will be based on this topic"
            wire:keydown.enter="createQuiz"
        />
        <x-slot:actions>
            <x-button label="Cancel" wire:click="hideShowQuizModal" />
            <x-button label="Create" wire:click="createQuiz" class="btn-success" />
        </x-slot:actions>
    </x-modal>
</div>
