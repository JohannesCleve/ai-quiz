<div class="flex justify-center gap-4 mb-16">
    @foreach($statistics as $stat)
        <x-stat
            title="{{ $stat['title'] }}"
            value="{{ $stat['value'] }}"
            icon="{{ $stat['icon'] }}"
            tooltip="{{ $stat['tooltip'] }}"
            color="text-slate-700"
            class="max-w-48 hover:shadow-lg transition-all duration-300"
        />
    @endforeach
</div>
