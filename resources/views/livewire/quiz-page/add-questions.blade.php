<div class="flex items-center gap-4">
    <x-button
        label="Add Questions"
        icon="o-plus"
        class="btn-primary"
        wire:click="addQuestions"
        wire:loading.attr="disabled"
    />
    <x-loading class="loading-bars" wire:loading  />
</div>
