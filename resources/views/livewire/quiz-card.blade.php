<div>
    <x-card :title="$quiz->topic" class="h-full max-w-sm flex justify-between shadow-md hover:shadow-xl transition-all duration-300">
        <x-slot:figure>
            <img src="https://picsum.photos/500/200" />
        </x-slot:figure>
        <x-slot:menu>
            <x-button icon="o-share" class="btn-circle btn-sm" />
            <x-icon name="o-heart" class="cursor-pointer" />
        </x-slot:menu>
        <x-slot:actions>
            <x-button link="{{ route('quiz-page', $quiz->slug) }}" label="Go To Quiz" class="btn-primary" />
        </x-slot:actions>
    </x-card>
</div>
