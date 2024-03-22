<div>
    <div class="flex flex-col max-w-4xl mx-auto bg-slate-100 rounded-lg shadow">
        <div class="text-lg font-bold border-b border-slate-300 p-8">{{ $question->question }}</div>

        <ul class="flex flex-col gap-8 p-8">
            @foreach($question->options as $key => $option)
                <li
                    wire:click="answered('{{$key}}')"
                    class="p-4 hover:bg-slate-200 rounded-lg cursor-pointer transition-all duration-300 {{ $key == $question->answer && $showAnswer ? 'bg-green-200 hover:bg-green-200' : ($showAnswer ? 'bg-red-200 hover:bg-red-200' : '') }} {{ $key == $userAnswer && $showAnswer ? 'outline outline-2 outline-offset-2 outline-slate-500/50' : '' }}"
                >
                    {{ $option }}
                </li>
            @endforeach
        </ul>

    </div>

    <div class="flex justify-center mt-12">
        <x-button
            label="Next Question"
            icon="o-chevron-right"
            class="btn-outline"
            wire:click="nextQuestion"
            wire:loading.attr="disabled"
        />
    </div>
</div>
