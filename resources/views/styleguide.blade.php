<x-layouts.app title="Composants du site · Perdu de vue">
    <div class="max-w-4xl mx-auto space-y-12">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-zinc-100">
                Styleguide des composants
            </h1>
            <p class="mt-2 text-zinc-600 dark:text-zinc-400">
                Inventaire visuel de tous les composants Blade réutilisables du site « Perdu de vue ».
            </p>
        </div>

        <!-- Section 1 : Les Badges -->
        <section class="space-y-4 rounded-2xl border border-zinc-200 bg-white p-6 shadow-xs dark:border-zinc-800 dark:bg-zinc-900">
            <h2 class="text-lg font-bold text-zinc-900 dark:text-zinc-100 border-b border-zinc-100 pb-2 dark:border-zinc-800">
                1. Badges (<code class="text-amber-600">&lt;x-badge&gt;</code>)
            </h2>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-3">Couleurs de l'enum Color</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach (\App\Enums\Color::cases() as $color)
                        <x-badge :color="$color">
                            <span class="size-2 rounded-full inline-block bg-current"></span>
                            {{ $color->label() }}
                        </x-badge>
                    @endforeach
                </div>
            </div>

            <div class="pt-2">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-zinc-500 mb-3">Statuts et étiquettes</h3>
                <div class="flex flex-wrap gap-2">
                    <x-badge variant="pending">En attente</x-badge>
                    <x-badge variant="returned">Restitué</x-badge>
                    <x-badge variant="tag">Fragile</x-badge>
                    <x-badge variant="tag">Électronique</x-badge>
                    <x-badge variant="tag">Vivant</x-badge>
                </div>
            </div>
        </section>

        <!-- Section 2 : Les Boutons -->
        <section class="space-y-4 rounded-2xl border border-zinc-200 bg-white p-6 shadow-xs dark:border-zinc-800 dark:bg-zinc-900">
            <h2 class="text-lg font-bold text-zinc-900 dark:text-zinc-100 border-b border-zinc-100 pb-2 dark:border-zinc-800">
                2. Boutons (<code class="text-amber-600">&lt;x-button&gt;</code>)
            </h2>

            <div class="flex flex-wrap gap-3">
                <x-button variant="primary">Bouton primaire</x-button>
                <x-button variant="secondary">Bouton secondaire</x-button>
                <x-button variant="success">Marquer restitué</x-button>
                <x-button variant="danger">Supprimer</x-button>
                <x-button variant="primary" disabled>Désactivé</x-button>
            </div>
        </section>

        <!-- Section 3 : Les Champs de formulaire -->
        <section class="space-y-6 rounded-2xl border border-zinc-200 bg-white p-6 shadow-xs dark:border-zinc-800 dark:bg-zinc-900">
            <h2 class="text-lg font-bold text-zinc-900 dark:text-zinc-100 border-b border-zinc-100 pb-2 dark:border-zinc-800">
                3. Champs de formulaire
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Champ texte normal -->
                <div>
                    <x-label for="demo-input">Champ texte normal</x-label>
                    <x-input name="demo-input" id="demo-input" placeholder="Ex. Parapluie noir" />
                </div>

                <!-- Champ date -->
                <div>
                    <x-label for="demo-date">Champ date</x-label>
                    <x-input type="date" name="demo-date" id="demo-date" value="2026-10-15" />
                </div>

                <!-- Select -->
                <div>
                    <x-label for="demo-select">Menu déroulant (Select)</x-label>
                    <x-select name="demo-select" id="demo-select">
                        <option value="">Sélectionnez une option</option>
                        <option value="1">Hall des guichets</option>
                        <option value="2">Quai 1 (Voie A)</option>
                    </x-select>
                </div>

                <!-- Textarea -->
                <div>
                    <x-label for="demo-textarea">Zone de texte (Textarea)</x-label>
                    <x-textarea name="demo-textarea" id="demo-textarea" rows="2" placeholder="Une courte description..."></x-textarea>
                </div>
            </div>
        </section>

        <!-- Section 4 : La Carte d'un objet -->
        <section class="space-y-4 rounded-2xl border border-zinc-200 bg-white p-6 shadow-xs dark:border-zinc-800 dark:bg-zinc-900">
            <h2 class="text-lg font-bold text-zinc-900 dark:text-zinc-100 border-b border-zinc-100 pb-2 dark:border-zinc-800">
                4. Carte d'objet (<code class="text-amber-600">&lt;x-item-card&gt;</code>)
            </h2>

            @php
                $sampleItem = \App\Models\Item::with(['place', 'tags'])->first();
            @endphp

            @if ($sampleItem)
                <div class="max-w-sm">
                    <x-item-card :item="$sampleItem" :show-status="true" />
                </div>
            @endif
        </section>
    </div>
</x-layouts.app>
