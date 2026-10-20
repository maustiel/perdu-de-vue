@props(['item', 'places', 'colors', 'tags'])

<div class="space-y-6">
    <!-- Nom -->
    <div>
        <x-label for="name">Nom</x-label>
        <x-input name="name" :value="old('name', $item->name)" placeholder="Ex. Parapluie dôme à motifs" />
        @error('name')
            <p id="name-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <!-- Couleur -->
    <div>
        <x-label for="color">Couleur</x-label>
        <x-select name="color">
            <option value="">Sélectionnez une couleur</option>
            @foreach ($colors as $color)
                <option value="{{ $color->value }}" @selected(old('color', $item->color?->value) === $color->value)>
                    {{ $color->label() }}
                </option>
            @endforeach
        </x-select>
        @error('color')
            <p id="color-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <!-- Lieu -->
    <div>
        <x-label for="place_id">Lieu de découverte</x-label>
        <x-select name="place_id">
            <option value="">Sélectionnez un lieu</option>
            @foreach ($places as $place)
                <option value="{{ $place->id }}" @selected(old('place_id', $item->place_id) == $place->id)>
                    {{ $place->name }} ({{ $place->kind->label() }})
                </option>
            @endforeach
        </x-select>
        @error('place_id')
            <p id="place_id-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <!-- Date de découverte -->
    <div>
        <x-label for="found_on">Date de découverte</x-label>
        <x-input type="date" name="found_on" :value="old('found_on', $item->found_on?->format('Y-m-d'))" />
        @error('found_on')
            <p id="found_on-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
<!-- Photo -->
    <div>
        <x-label for="photo">Photo de l'objet (facultative)</x-label>
        <x-file-input name="photo" accept="image/*" />
        <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">Une image au format JPEG, PNG, etc. (max 2 Mo).</p>
        @error('photo')
            <p id="photo-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
    <!-- Description -->
    <div>
        <x-label for="description">Description (facultative)</x-label>
        <x-textarea name="description" rows="4" placeholder="Détails pouvant aider le propriétaire à reconnaître l'objet...">{{ old('description', $item->description) }}</x-textarea>
        @error('description')
            <p id="description-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <!-- Étiquettes -->
    <fieldset class="pt-2">
        <legend class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-3">Étiquettes</legend>
        @php
            $checkedTags = session()->hasOldInput()
                ? (array) old('tags', [])
                : $item->tags->pluck('id')->map(fn ($id) => (string) $id)->toArray();
        @endphp
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
            @foreach ($tags as $tag)
                <label for="tag-{{ $tag->id }}" class="flex items-center gap-2.5 rounded-lg border border-zinc-200 p-3 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50 dark:border-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-800/50 cursor-pointer">
                    <input
                        type="checkbox"
                        id="tag-{{ $tag->id }}"
                        name="tags[]"
                        value="{{ $tag->id }}"
                        @checked(in_array((string) $tag->id, $checkedTags, true))
                        class="size-4 rounded border-zinc-300 text-amber-600 focus:ring-amber-600 dark:border-zinc-700 dark:bg-zinc-950"
                    >
                    <span>{{ $tag->name }}</span>
                </label>
            @endforeach
        </div>
        @error('tags')
            <p id="tags-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
        @error('tags.*')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </fieldset>
</div>
