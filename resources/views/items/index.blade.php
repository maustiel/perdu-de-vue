<x-layouts.app>
    <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-zinc-100">Objets trouvés</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Objets en attente de restitution au bureau de la gare.</p>
        </div>

        <a href="{{ route('items.create') }}" class="inline-flex items-center justify-center rounded-lg bg-amber-600 px-4 py-2 text-sm font-semibold text-white shadow-xs transition-colors hover:bg-amber-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-600">
            Ajouter un objet
        </a>
    </div>

    <!-- Formulaire de filtrage combiné (GET) -->
    <form method="GET" action="{{ route('items.index') }}" class="mb-8 rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-800 dark:bg-zinc-900">
        <div class="flex flex-wrap items-end gap-4">
            <div class="w-full sm:w-56">
                <label for="filter-lieu" class="block text-xs font-semibold uppercase tracking-wider text-zinc-600 dark:text-zinc-400 mb-1">Lieu</label>
                <select id="filter-lieu" name="lieu" class="block w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm shadow-xs focus:border-amber-600 focus:outline-hidden focus:ring-3 focus:ring-amber-600/20 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-100">
                    <option value="">Tous les lieux</option>
                    @foreach ($places as $place)
                        <option value="{{ $place->id }}" @selected(request()->query('lieu') == $place->id)>
                            {{ $place->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="w-full sm:w-56">
                <label for="filter-couleur" class="block text-xs font-semibold uppercase tracking-wider text-zinc-600 dark:text-zinc-400 mb-1">Couleur</label>
                <select id="filter-couleur" name="couleur" class="block w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm shadow-xs focus:border-amber-600 focus:outline-hidden focus:ring-3 focus:ring-amber-600/20 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-100">
                    <option value="">Toutes les couleurs</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->value }}" @selected(request()->query('couleur') === $color->value)>
                            {{ $color->label() }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="rounded-lg bg-zinc-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-zinc-900 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-zinc-200">
                    Filtrer
                </button>
                @if (request()->hasAny(['lieu', 'couleur']))
                    <a href="{{ route('items.index') }}" class="rounded-lg border border-zinc-300 px-4 py-2 text-sm font-semibold text-zinc-700 transition hover:bg-zinc-100 dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-800">
                        Réinitialiser
                    </a>
                @endif
            </div>
        </div>
    </form>

   <!-- Grille des objets -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($items as $item)
            <x-item-card :item="$item" />
        @empty
            <div class="col-span-full rounded-xl border border-dashed border-zinc-300 p-12 text-center dark:border-zinc-800">
                <p class="text-zinc-500 dark:text-zinc-400">Aucun objet trouvé avec ces critères.</p>
            </div>
        @endforelse
    </div>

   {{-- pagination --}}
    <div class="mt-8">
        {{ $items->links() }}
    </div>

</x-layouts.app>
