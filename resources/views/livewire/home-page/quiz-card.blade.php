<div>
    <x-card :title="$quiz->topic" class="h-full max-w-sm flex justify-between shadow-md hover:shadow-xl transition-all duration-300">
        <div class=" flex">
            <x-stat :value="$quiz->questions->count()" icon="o-light-bulb" class="shrink" />
            <x-stat :value="$quiz->points" icon="o-trophy" />
        </div>
        <x-slot:figure>
            @if($quiz->image_path)
                <img src="{{ asset($quiz->image_path) }}" />
            @else
                <img src="https://picsum.photos/500/200" />
            @endif
        </x-slot:figure>

        <x-slot:actions class="flex items-center justify-items-center">
            <x-button link="{{ route('quiz-page', $quiz->slug) }}" label="Go To Quiz" class="btn-primary" />
        </x-slot:actions>
    </x-card>
</div>
