<?php

namespace Database\Seeders;

use App\Models\Catalogue;
use App\Models\Livre;
use Illuminate\Database\Seeder;

class CatalogueSeeder extends Seeder
{
    public function run(): void
    {
        $catalogues = [
            'Littérature mondiale' => 'Romans, récits et grandes œuvres de la littérature internationale.',
            'Science-fiction' => 'Univers imaginaires, futurs et dystopies.',
            'Informatique & Technique' => 'Algorithmes, programmation et systèmes.',
            'Philosophie & Sciences humaines' => 'Réflexions sur le monde, le temps et l\'humain.',
            'Sciences & Médecine' => 'Découvertes scientifiques et études du vivant.',
            'Classiques francophones' => 'Grandes œuvres du patrimoine littéraire francophone.',
        ];

        foreach ($catalogues as $nom => $description) {
            $catalogue = Catalogue::firstOrCreate(
                ['nom' => $nom],
                ['description' => $description]
            );

            $genres = match ($nom) {
                'Littérature mondiale' => ['Littérature', 'Roman'],
                'Science-fiction' => ['Science-fiction'],
                'Informatique & Technique' => ['Informatique'],
                'Philosophie & Sciences humaines' => ['Philosophie'],
                'Sciences & Médecine' => ['Science'],
                default => ['Classique'],
            };

            Livre::whereIn('genre', $genres)->get()->each(function (Livre $livre) use ($catalogue) {
                $livre->update(['catalogue_id' => $catalogue->id]);
            });
        }

        $this->attribuerSiExiste('Le Cerveau de Mozart', [
            'statut' => Livre::STATUT_INDISPONIBLE,
            'quantite_disponible' => 0,
        ]);

        $this->attribuerSiExiste('Design Patterns : Elements of Reusable Object-Oriented Software', [
            'statut' => Livre::STATUT_RETIRE,
        ]);
    }

    private function attribuerSiExiste(string $titre, array $attrs): void
    {
        $livre = Livre::where('titre', $titre)->first();
        if ($livre) {
            $livre->update($attrs);
        }
    }
}
