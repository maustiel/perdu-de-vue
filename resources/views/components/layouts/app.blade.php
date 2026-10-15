<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Perdu de vue · Bureau des objets trouvés de la gare de Wavre' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-zinc-50 font-sans text-zinc-900 antialiased dark:bg-zinc-950 dark:text-zinc-100">
    <header class="border-b border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-x-6 gap-y-2 px-4 py-3 sm:px-6 lg:px-8">
            <a href="{{ route('items.index') }}" class="flex items-center gap-2 rounded-md text-lg font-semibold tracking-tight focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand-600">
                <span class="grid size-8 place-items-center rounded-lg bg-amber-600 text-sm font-semibold text-white" aria-hidden="true">PV</span>
                Perdu de vue
            </a>

            <nav aria-label="Navigation principale">
                <ul class="flex flex-row items-center gap-2">
                    <li>
                        <a href="{{ route('items.index') }}"
                           class="block rounded-md px-3 py-2 text-sm font-medium transition-colors focus-visible:outline-2 focus-visible:outline-amber-600 {{ request()->routeIs('items.index') ? 'bg-amber-50 text-amber-700 dark:bg-amber-950 dark:text-amber-200' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white' }}"
                           {!! request()->routeIs('items.index') ? 'aria-current="page"' : '' !!}>
                            Les objets
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('items.create') }}"
                           class="block rounded-md px-3 py-2 text-sm font-medium transition-colors focus-visible:outline-2 focus-visible:outline-amber-600 {{ request()->routeIs('items.create') ? 'bg-amber-50 text-amber-700 dark:bg-amber-950 dark:text-amber-200' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white' }}"
                           {!! request()->routeIs('items.create') ? 'aria-current="page"' : '' !!}>
                            Ajouter un objet
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="mx-auto w-full max-w-6xl flex-1 px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
        @if (session('status'))
            <div role="status" class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm font-medium text-emerald-800 dark:border-emerald-900 dark:bg-emerald-950 dark:text-emerald-200">
                {{ session('status') }}
            </div>
        @endif

        {{ $slot }}
    </main>

    <footer class="border-t border-zinc-200 dark:border-zinc-800">
        <div class="mx-auto flex max-w-6xl flex-col gap-2 px-4 py-6 text-sm text-zinc-500 sm:flex-row sm:justify-between sm:px-6 lg:px-8 dark:text-zinc-400">
            <p>Bureau des objets trouvés de la gare de Wavre.</p>
            <p><a href="{{ route('styleguide') }}" class="underline underline-offset-4 hover:text-zinc-900 dark:hover:text-white">Les composants du site</a></p>
        </div>
    </footer>
</body>
</html>
