<?php

use App\Enums\Color;
use App\Models\Item;
use App\Models\Place;
use App\Models\Tag;

test('la liste affiche les objets en attente et non les restitués', function () {
    $pending = Item::factory()->create(['name' => 'Objet en attente', 'returned_at' => null]);
    $returned = Item::factory()->create(['name' => 'Objet restitué', 'returned_at' => now()]);

    $this->get('/objets')
        ->assertOk()
        ->assertSee('Objet en attente')
        ->assertDontSee('Objet restitué');
});

test('le filtre par lieu et couleur fonctionne', function () {
    $place = Place::factory()->create();
    $item = Item::factory()->create(['place_id' => $place->id, 'color' => Color::Red, 'name' => 'Cible Rouge']);
    $other = Item::factory()->create(['color' => Color::Blue, 'name' => 'Intrus Bleu']);

    $this->get('/objets?lieu=' . $place->id . '&couleur=red')
        ->assertOk()
        ->assertSee('Cible Rouge')
        ->assertDontSee('Intrus Bleu');
});

test('la validation refuse un objet incomplet ou avec une date dans le futur', function () {
    $this->post('/objets', [
        'name' => 'A', // Trop court
        'found_on' => now()->addDay()->format('Y-m-d'), // Dans le futur
    ])->assertSessionHasErrors(['name', 'color', 'place_id', 'found_on']);
});

test('un objet peut être ajouté avec ses étiquettes', function () {
    $place = Place::factory()->create();
    $tag = Tag::factory()->create();

    $this->post('/objets', validItem([
        'place_id' => $place->id,
        'tags' => [$tag->id],
    ]))->assertRedirect()->assertSessionHasNoErrors();

    $this->assertDatabaseHas('items', ['place_id' => $place->id, 'name' => 'Parapluie de test']);
    $this->assertDatabaseHas('item_tag', ['tag_id' => $tag->id]);
});

test('un objet peut être modifié', function () {
    $item = Item::factory()->create(['name' => 'Ancien nom']);

    $this->put("/objets/{$item->id}", validItem([
        'name' => 'Nouveau nom',
        'place_id' => $item->place_id,
    ]))->assertRedirect()->assertSessionHasNoErrors();

    expect($item->fresh()->name)->toBe('Nouveau nom');
});

test('la restitution ajoute la date du jour et retire l\'objet de la liste', function () {
    $item = Item::factory()->create(['returned_at' => null]);

    $this->patch("/objets/{$item->id}/restitution")
        ->assertRedirect(route('items.index'))
        ->assertSessionHas('status');

    expect($item->fresh()->isReturned())->toBeTrue();
});

test('la suppression efface l\'objet de la base de données', function () {
    $item = Item::factory()->create();

    $this->delete("/objets/{$item->id}")
        ->assertRedirect(route('items.index'));

    $this->assertModelMissing($item);
});
