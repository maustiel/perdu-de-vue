@props(['name'])

<input
    type="file"
    name="{{ $name }}"
    id="{{ $attributes->get('id', $name) }}"
    @if ($errors->has($name)) aria-invalid="true" aria-describedby="{{ $name }}-error" @endif
    {{ $attributes->class([
        'mt-2 block w-full text-sm text-zinc-700 file:mr-4 file:rounded-lg file:border-0 file:bg-amber-50 file:px-4 file:py-2 file:font-semibold file:text-amber-700 hover:file:bg-amber-100 dark:text-zinc-300 dark:file:bg-amber-950/50 dark:file:text-amber-400',
        'border border-red-500 focus:border-red-500 focus:ring-red-500/20' => $errors->has($name)
    ]) }}
>
