<?php

use App\Models\Item;
use App\Models\Place;

test('la page d\'un lieu affiche ses informations et ses objets', function () {
    $place = Place::factory()->create(['name' => 'Salle d\'attente']);
    $item = Item::factory()->create(['place_id' => $place->id, 'name' => 'Écharpe en laine']);

    $this->get("/lieux/{$place->id}")
        ->assertOk()
        ->assertSee('Salle d\'attente')
        ->assertSee('Écharpe en laine');
});
