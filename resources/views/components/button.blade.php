@props([
    'variant' => 'primary',
    'type' => 'button',
    'href' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-2 rounded-lg px-4 py-2 text-sm font-semibold shadow-xs transition-colors focus-visible:outline-2 focus-visible:outline-offset-2 disabled:cursor-not-allowed disabled:opacity-50 cursor-pointer';

    $variants = [
        'primary' => 'bg-amber-600 text-white hover:bg-amber-700 focus-visible:outline-amber-600 disabled:hover:bg-amber-600',
        'secondary' => 'border border-zinc-300 bg-white text-zinc-700 hover:bg-zinc-100 focus-visible:outline-zinc-900 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus-visible:outline-red-600 disabled:hover:bg-red-600',
        'success' => 'bg-emerald-600 text-white hover:bg-emerald-700 focus-visible:outline-emerald-600 disabled:hover:bg-emerald-600',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
