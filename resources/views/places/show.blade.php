<x-layouts.app :title="$place->name . ' · Perdu de vue'">
    <div class="mb-6">
        <a href="{{ route('items.index') }}" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">
            ← Retour à tous les objets
        </a>
    </div>

    <div class="mb-8 rounded-2xl border border-zinc-200 bg-white p-6 shadow-xs dark:border-zinc-800 dark:bg-zinc-900">
        <span class="inline-flex items-center rounded-md bg-amber-50 px-2 py-1 text-xs font-medium text-amber-700 dark:bg-amber-950 dark:text-amber-300 mb-2">
            {{ $place->kind->label() }}
        </span>
        <h1 class="text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-zinc-100">
            {{ $place->name }}
        </h1>
        <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
            Total des objets trouvés à cet endroit : {{ $place->items->count() }}
        </p>
    </div>

    <h2 class="text-xl font-bold tracking-tight text-zinc-900 dark:text-zinc-100 mb-4">
        Objets trouvés dans ce lieu
    </h2>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($place->items as $item)
            <x-item-card :item="$item" :show-status="true" />
        @empty
            <div class="col-span-full rounded-xl border border-dashed border-zinc-300 p-12 text-center dark:border-zinc-800">
                <p class="text-zinc-500 dark:text-zinc-400">Aucun objet n'a été trouvé à cet endroit pour le moment.</p>
            </div>
        @endforelse
    </div>
</x-layouts.app>
