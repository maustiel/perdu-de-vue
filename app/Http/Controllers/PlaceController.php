<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\View\View;

class PlaceController extends Controller
{
    public function show(Place $place): View
    {
        $place->load([
            'items' => fn ($query) => $query->with('tags')->orderByDesc('found_on')->orderByDesc('id'),
        ]);

        return view('places.show', [
            'place' => $place,
        ]);
    }
}
