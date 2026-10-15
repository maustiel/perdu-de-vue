<?php

namespace Database\Seeders;

use App\Enums\Color;
use App\Enums\PlaceKind;
use App\Models\Item;
use App\Models\Place;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Les 4 lieux fixes (avec les 3 sortes de PlaceKind)
        $hall = Place::create([
            'name' => 'Hall des guichets',
            'kind' => PlaceKind::Hall,
        ]);

        $quai1 = Place::create([
            'name' => 'Quai 1 (Voie A)',
            'kind' => PlaceKind::Platform,
        ]);

        $quai2 = Place::create([
            'name' => 'Quai 2 (Voie B)',
            'kind' => PlaceKind::Platform,
        ]);

        $train = Place::create([
            'name' => 'Train S8 n° 2148',
            'kind' => PlaceKind::Train,
        ]);

        // 2. Les 8 étiquettes fixes
        $tagFragile = Tag::create(['name' => 'Fragile']);
        $tagVivant = Tag::create(['name' => 'Vivant']);
        $tagUrgent = Tag::create(['name' => 'Urgent']);
        $tagValeur = Tag::create(['name' => 'Valeur']);
        $tagElectronique = Tag::create(['name' => 'Électronique']);
        $tagVetement = Tag::create(['name' => 'Vêtement']);
        $tagInsolite = Tag::create(['name' => 'Insolite']);
        $tagEncombrant = Tag::create(['name' => 'Encombrant']);

        // 3. Les 15 objets fixes (12 en attente + 3 restitués)

        // Objet 1
        $item1 = Item::create([
            'place_id' => $quai1->id,
            'name' => 'Nain de jardin en tenue de chef de gare',
            'description' => 'Porte un petit sifflet jaune et une casquette de la SNCB. Répond au prénom de Gérard selon une gravure sous le socle.',
            'color' => Color::Red,
            'found_on' => '2026-10-02',
            'returned_at' => null,
        ]);
        $item1->tags()->sync([$tagFragile->id, $tagInsolite->id]);

        // Objet 2
        $item2 = Item::create([
            'place_id' => $train->id,
            'name' => 'Bocal avec un poisson combattant bleu',
            'description' => 'Laissé sur un filet à bagages dans un sac isotherme. Le poisson semble en pleine forme et nous observe fixement.',
            'color' => Color::Blue,
            'found_on' => '2026-10-03',
            'returned_at' => null,
        ]);
        $item2->tags()->sync([$tagVivant->id, $tagFragile->id, $tagUrgent->id]);

        // Objet 3
        $item3 = Item::create([
            'place_id' => $hall->id,
            'name' => 'Chaussure de randonnée gauche (pointure 43)',
            'description' => 'En parfait état de marche mais désespérément seule. Marque Quechua, lacets orange fluo.',
            'color' => Color::Brown,
            'found_on' => '2026-10-04',
            'returned_at' => null,
        ]);
        $item3->tags()->sync([$tagVetement->id, $tagInsolite->id]);

        // Objet 4
        $item4 = Item::create([
            'place_id' => $train->id,
            'name' => 'Guitare acoustique miniature pour enfant',
            'description' => 'Manque la corde de mi aigu. Autocollant de dinosaure souriant au dos de la caisse.',
            'color' => Color::Yellow,
            'found_on' => '2026-10-05',
            'returned_at' => null,
        ]);
        $item4->tags()->sync([$tagFragile->id]);

        // Objet 5 (Restitué 1)
        $item5 = Item::create([
            'place_id' => $hall->id,
            'name' => 'Liseuse Kindle dans un étui fleuri',
            'description' => 'Batterie chargée à 85 %, bloquée sur le chapitre 12 d\'un polar captivant.',
            'color' => Color::Multicolor,
            'found_on' => '2026-10-01',
            'returned_at' => '2026-10-06',
        ]);
        $item5->tags()->sync([$tagElectronique->id, $tagValeur->id]);

        // Objet 6
        $item6 = Item::create([
            'place_id' => $quai2->id,
            'name' => 'Trottinette pliable sans béquille',
            'description' => 'Roues lumineuses multicolores quand elles tournent. Poignées en mousse un peu usées.',
            'color' => Color::Black,
            'found_on' => '2026-10-06',
            'returned_at' => null,
        ]);
        $item6->tags()->sync([$tagEncombrant->id]);

        // Objet 7
        $item7 = Item::create([
            'place_id' => $hall->id,
            'name' => 'Doudou pieuvre géante en peluche',
            'description' => 'Huit tentacules très douces. Une étiquette manuscrite indique "Propriété de Camille".',
            'color' => Color::Pink,
            'found_on' => '2026-10-07',
            'returned_at' => null,
        ]);
        $item7->tags()->sync([$tagUrgent->id]);

        // Objet 8
        $item8 = Item::create([
            'place_id' => $quai1->id,
            'name' => 'Parapluie dôme avec yeux de grenouille',
            'description' => 'Modèle transparent avec deux yeux verts en relief sur le dessus. Mécanisme automatique impeccable.',
            'color' => Color::Green,
            'found_on' => '2026-10-08',
            'returned_at' => null,
        ]);
        $item8->tags()->sync([$tagInsolite->id]);

        // Objet 9
        $item9 = Item::create([
            'place_id' => $train->id,
            'name' => 'Boîte à tartines vintage Batman',
            'description' => 'En métal embossé. Contient une boîte vide et une serviette en papier blanche.',
            'color' => Color::Grey,
            'found_on' => '2026-10-09',
            'returned_at' => null,
        ]);
        $item9->tags()->sync([$tagInsolite->id]);

        // Objet 10 (Restitué 2)
        $item10 = Item::create([
            'place_id' => $hall->id,
            'name' => 'Trousseau de 5 clés avec porte-clé tour Eiffel',
            'description' => 'Trois clés de sécurité et deux petites clés de boîte aux lettres.',
            'color' => Color::White,
            'found_on' => '2026-10-04',
            'returned_at' => '2026-10-08',
        ]);
        $item10->tags()->sync([$tagUrgent->id, $tagValeur->id]);

        // Objet 11
        $item11 = Item::create([
            'place_id' => $quai2->id,
            'name' => 'Chapeau melon en feutre noir',
            'description' => 'Intérieur en soie bordeaux. Très classe, semble tout droit sorti d\'un film des années 60.',
            'color' => Color::Black,
            'found_on' => '2026-10-10',
            'returned_at' => null,
        ]);
        $item11->tags()->sync([$tagVetement->id, $tagInsolite->id]);

        // Objet 12
        $item12 = Item::create([
            'place_id' => $train->id,
            'name' => 'Casque audio sans fil à réduction de bruit',
            'description' => 'Marque Sony, quelques micro-griffes sur l\'oreillette droite. Reste allumé.',
            'color' => Color::Purple,
            'found_on' => '2026-10-11',
            'returned_at' => null,
        ]);
        $item12->tags()->sync([$tagElectronique->id, $tagValeur->id]);

        // Objet 13
        $item13 = Item::create([
            'place_id' => $quai1->id,
            'name' => 'Plante grasse dans une tasse "Meilleure maman"',
            'description' => 'Un petit echeveria bien vert empoté avec amour. Posé sous un banc du quai 1.',
            'color' => Color::Green,
            'found_on' => '2026-10-12',
            'returned_at' => null,
        ]);
        $item13->tags()->sync([$tagVivant->id, $tagFragile->id]);

        // Objet 14 (Restitué 3)
        $item14 = Item::create([
            'place_id' => $train->id,
            'name' => 'Écharpe en grosse laine tricotée main',
            'description' => 'Rayures orange et jaune vif, très chaude et particulièrement longue (au moins 2 mètres).',
            'color' => Color::Orange,
            'found_on' => '2026-10-07',
            'returned_at' => '2026-10-13',
        ]);
        $item14->tags()->sync([$tagVetement->id]);

        // Objet 15
        $item15 = Item::create([
            'place_id' => $hall->id,
            'name' => 'Manette de jeu vidéo rétro sans fil',
            'description' => 'Style NES grise et rouge avec connecteur USB-C. Bouton B légèrement coincé.',
            'color' => Color::Grey,
            'found_on' => '2026-10-14',
            'returned_at' => null,
        ]);
        $item15->tags()->sync([$tagElectronique->id]);
    }
}
