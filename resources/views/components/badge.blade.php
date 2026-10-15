@props(['variant' => 'default', 'color' => null])

@php
    $baseClasses = 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium transition-colors';

    $colorClasses = match ($color?->value ?? $variant) {
        'black' => 'bg-zinc-900 text-white dark:bg-zinc-100 dark:text-zinc-900',
        'white' => 'bg-zinc-100 text-zinc-800 border border-zinc-300 dark:bg-zinc-800 dark:text-zinc-200 dark:border-zinc-700',
        'grey' => 'bg-zinc-200 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-200',
        'red' => 'bg-red-100 text-red-800 dark:bg-red-950 dark:text-red-200',
        'blue' => 'bg-blue-100 text-blue-800 dark:bg-blue-950 dark:text-blue-200',
        'green' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-200',
        'yellow' => 'bg-yellow-100 text-yellow-900 dark:bg-yellow-950 dark:text-yellow-200',
        'orange' => 'bg-orange-100 text-orange-900 dark:bg-orange-950 dark:text-orange-200',
        'brown' => 'bg-amber-800 text-amber-50 dark:bg-amber-950 dark:text-amber-200',
        'pink' => 'bg-pink-100 text-pink-800 dark:bg-pink-950 dark:text-pink-200',
        'purple' => 'bg-purple-100 text-purple-800 dark:bg-purple-950 dark:text-purple-200',
        'multicolor' => 'bg-gradient-to-r from-red-100 via-yellow-100 to-blue-100 text-zinc-900 border border-zinc-200 dark:border-zinc-700',
        'tag' => 'bg-zinc-100 text-zinc-700 border border-zinc-200 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-700',
        'pending' => 'bg-amber-100 text-amber-900 dark:bg-amber-950 dark:text-amber-200',
        'returned' => 'bg-emerald-100 text-emerald-900 dark:bg-emerald-950 dark:text-emerald-200',
        default => 'bg-zinc-100 text-zinc-800 dark:bg-zinc-800 dark:text-zinc-200',
    };
@endphp

<span {{ $attributes->merge(['class' => "$baseClasses $colorClasses"]) }}>
    {{ $slot }}
</span>
