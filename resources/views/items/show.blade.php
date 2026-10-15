<x-layouts.app :title="$item->name . ' · Perdu de vue'">
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('items.index') }}" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">
                ← Retour à la liste
            </a>
        </div>

        <article class="overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-xs sm:p-8 dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                <div class="flex items-center gap-2">
                    <x-badge :color="$item->color">
                        <span class="size-2 rounded-full inline-block bg-current"></span>
                        {{ $item->color->label() }}
                    </x-badge>

                    @if ($item->isReturned())
                        <x-badge variant="returned">Restitué le {{ $item->returned_at->format('d/m/Y') }}</x-badge>
                    @else
                        <x-badge variant="pending">En attente de restitution</x-badge>
                    @endif
                </div>

                <time datetime="{{ $item->found_on->format('Y-m-d') }}" class="text-sm text-zinc-500 dark:text-zinc-400">
                    Trouvé le {{ $item->found_on->format('d/m/Y') }}
                </time>
            </div>

            <h1 class="text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-zinc-100 mb-4">
                {{ $item->name }}
            </h1>

            <div class="mb-6 rounded-xl bg-zinc-50 p-4 dark:bg-zinc-800/50">
                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                    Lieu de découverte :
                    <a href="{{ route('places.show', $item->place_id) }}" class="font-semibold text-amber-700 underline underline-offset-2 hover:text-amber-800 dark:text-amber-400 dark:hover:text-amber-300">
                        {{ $item->place->name }}
                    </a>
                    <span class="text-xs text-zinc-400 dark:text-zinc-500">({{ $item->place->kind->label() }})</span>
                </p>
            </div>

            @if ($item->description)
                <div class="mb-6">
                    <h2 class="text-sm font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-2">Description</h2>
                    <p class="text-base text-zinc-700 dark:text-zinc-300 whitespace-pre-line">
                        {{ $item->description }}
                    </p>
                </div>
            @endif

            @if ($item->tags->isNotEmpty())
                <div class="mb-8 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                    <h2 class="text-sm font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-3">Étiquettes</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($item->tags as $tag)
                            <x-badge variant="tag">{{ $tag->name }}</x-badge>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Actions (Restitution, Modification, Suppression) -->
            <div class="flex flex-wrap items-center gap-3 pt-6 border-t border-zinc-200 dark:border-zinc-800">
                @if (! $item->isReturned())
                    <form method="POST" action="{{ route('items.return', $item) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-xs transition hover:bg-emerald-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                            Marquer restitué
                        </button>
                    </form>
                @endif

                <a href="{{ route('items.edit', $item) }}" class="rounded-lg border border-zinc-300 px-4 py-2 text-sm font-semibold text-zinc-700 shadow-xs transition hover:bg-zinc-100 dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-800">
                    Modifier
                </a>

                <form method="POST" action="{{ route('items.destroy', $item) }}" onsubmit="return confirm('Voulez-vous vraiment supprimer cet objet ? Cette action est irréversible.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-xs transition hover:bg-red-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                        Supprimer
                    </button>
                </form>
            </div>
        </article>
    </div>
</x-layouts.app>
