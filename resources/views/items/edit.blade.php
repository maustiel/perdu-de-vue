<x-layouts.app :title="'Modifier ' . $item->name . ' · Perdu de vue'">
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('items.show', $item) }}" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">
                ← Retour à la fiche
            </a>
        </div>

        <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-xs sm:p-8 dark:border-zinc-800 dark:bg-zinc-900">
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-zinc-100 mb-6">
                Modifier {{ $item->name }}
            </h1>

            <form method="POST" action="{{ route('items.update', $item) }}" novalidate>
                @csrf
                @method('PUT')

                <x-item-fields :item="$item" :places="$places" :colors="$colors" :tags="$tags" />

                <div class="mt-8 flex items-center justify-end gap-3 pt-6 border-t border-zinc-200 dark:border-zinc-800">
                    <a href="{{ route('items.show', $item) }}" class="rounded-lg border border-zinc-300 px-4 py-2 text-sm font-semibold text-zinc-700 transition hover:bg-zinc-100 dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-800">
                        Annuler
                    </a>
                    <button type="submit" class="rounded-lg bg-amber-600 px-5 py-2 text-sm font-semibold text-white shadow-xs transition hover:bg-amber-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-600">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
