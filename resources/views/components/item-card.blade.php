@props(['item', 'showStatus' => false])

<article class="flex flex-col justify-between overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 shadow-xs transition hover:border-zinc-300 dark:border-zinc-800 dark:bg-zinc-900 dark:hover:border-zinc-700">

    {{-- bloc photo --}}
    @if ($item->photo)
        <img src="{{ asset('storage/' . $item->photo) }}" alt="Photo de {{ $item->name }}" class="mb-4 aspect-video w-full rounded-lg object-cover shadow-sm">
    @endif

    <div>
        <div class="flex items-center justify-between gap-2 mb-3">
            <div class="flex items-center gap-2">
                <x-badge :color="$item->color">
                    <span class="size-2 rounded-full inline-block bg-current"></span>
                    {{ $item->color->label() }}
                </x-badge>

                @if ($showStatus)
                    @if ($item->isReturned())
                        <x-badge variant="returned">Restitué</x-badge>
                    @else
                        <x-badge variant="pending">En attente</x-badge>
                    @endif
                @endif
            </div>

            <time datetime="{{ $item->found_on->format('Y-m-d') }}" class="text-xs text-zinc-500 dark:text-zinc-400">
                {{ $item->found_on->format('d/m/Y') }}
            </time>
        </div>

        <h2 class="text-lg font-bold tracking-tight text-zinc-900 dark:text-zinc-100">
            <a href="{{ route('items.show', $item) }}" class="hover:underline focus-visible:outline-2 focus-visible:outline-amber-600">
                {{ $item->name }}
            </a>
        </h2>

        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
            Trouvé au <a href="{{ route('places.show', $item->place_id) }}" class="font-medium text-amber-700 underline underline-offset-2 hover:text-amber-800 dark:text-amber-400 dark:hover:text-amber-300">{{ $item->place->name }}</a>
        </p>

        @if ($item->description)
            <p class="mt-3 text-sm text-zinc-600 dark:text-zinc-300 line-clamp-2">
                {{ $item->description }}
            </p>
        @endif
    </div>

    @if ($item->tags->isNotEmpty())
        <div class="mt-4 flex flex-wrap gap-1.5 pt-4 border-t border-zinc-100 dark:border-zinc-800">
            @foreach ($item->tags as $tag)
                <x-badge variant="tag">{{ $tag->name }}</x-badge>
            @endforeach
        </div>
    @endif
</article>
