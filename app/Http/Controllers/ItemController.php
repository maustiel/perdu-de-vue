<?php

namespace App\Http\Controllers;

use App\Enums\Color;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\Place;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request): View
    {
        $query = Item::query()
            ->whereNull('returned_at')
            ->with(['place', 'tags'])
            ->orderByDesc('found_on')
            ->orderByDesc('id');

        // Filtre par lieu
        if ($request->filled('lieu')) {
            $query->where('place_id', $request->query('lieu'));
        }

        // Filtre par couleur
        $colorEnum = Color::tryFrom($request->query('couleur', ''));
        if ($colorEnum !== null) {
            $query->where('color', $colorEnum);
        }

        return view('items.index', [
            'items' => $query->get(),
            'places' => Place::orderBy('name')->get(),
            'colors' => Color::cases(),
        ]);
    }

    public function create(): View
    {
        return view('items.create', [
            'item' => new Item,
            'places' => Place::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
            'colors' => Color::cases(),
        ]);
    }

    public function store(ItemRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Enregistre la photo si elle est présente
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('items', 'public');
        }

        $item = Item::create($validated);
        $item->tags()->sync($validated['tags'] ?? []);

        return redirect()
            ->route('items.show', $item)
            ->with('status', 'L\'objet a été ajouté.');
    }

    public function show(Item $item): View
    {
        $item->load(['place', 'tags']);

        return view('items.show', [
            'item' => $item,
        ]);
    }

    public function edit(Item $item): View
    {
        return view('items.edit', [
            'item' => $item,
            'places' => Place::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
            'colors' => Color::cases(),
        ]);
    }

    public function update(ItemRequest $request, Item $item): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            // Supprime l'ancienne photo du disque si elle existe
            if ($item->photo !== null) {
                Storage::disk('public')->delete($item->photo);
            }
            // Enregistre la nouvelle
            $validated['photo'] = $request->file('photo')->store('items', 'public');
        }

        $item->update($validated);
        $item->tags()->sync($validated['tags'] ?? []);

        return redirect()
            ->route('items.show', $item)
            ->with('status', 'L\'objet a été modifié.');
    }

    public function return(Item $item): RedirectResponse
    {
        if ($item->isReturned()) {
            return redirect()
                ->route('items.show', $item)
                ->with('status', "Cet objet a déjà été restitué le {$item->returned_at->format('d/m/Y')}.");
        }

        $item->update(['returned_at' => today()]);

        return redirect()
            ->route('items.index')
            ->with('status', "« {$item->name} » a retrouvé son propriétaire.");
    }

    public function destroy(Item $item): RedirectResponse
    {
        // Supprime la photo du disque
        if ($item->photo !== null) {
            Storage::disk('public')->delete($item->photo);
        }

        $item->delete();

        return redirect()
            ->route('items.index')
            ->with('status', 'L\'objet a été supprimé.');
    }
}
