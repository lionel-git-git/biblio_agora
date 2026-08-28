<?php

namespace Database\Seeders;

use App\Models\Livre;
use Illuminate\Database\Seeder;

class LivreSeeder extends Seeder
{
    public function run(): void
    {
        $livres = [
            [
                'titre' => 'Le Petit Prince',
                'auteur' => 'Antoine de Saint-Exupéry',
                'genre' => 'Littérature',
                'description' => 'Un aviateur rencontre un petit prince venu d\'une autre planète ; une réflexion poétique sur l\'amitié, l\'amour et le sens de la vie.',
                'langue' => 'Français',
                'quantite_totale' => 5,
            ],
            [
                'titre' => 'L\'Étranger',
                'auteur' => 'Albert Camus',
                'genre' => 'Roman',
                'description' => 'Meursault, indifférent au monde qui l\'entoure, commet un acte absurde qui l\'entraîne vers son destin.',
                'langue' => 'Français',
                'quantite_totale' => 3,
            ],
            [
                'titre' => '1984',
                'auteur' => 'George Orwell',
                'genre' => 'Science-fiction',
                'description' => 'Dans un régime totalitaire où Big Brother surveille tout, Winston Smith tente de penser librement.',
                'langue' => 'Anglais',
                'quantite_totale' => 4,
            ],
            [
                'titre' => 'L\'Alchimiste',
                'auteur' => 'Paulo Coelho',
                'genre' => 'Roman',
                'description' => 'Un jeune berger andalou part à la recherche d\'un trésor et découvre sa légende personnelle.',
                'langue' => 'Français',
                'quantite_totale' => 2,
            ],
            [
                'titre' => 'Clean Code',
                'auteur' => 'Robert C. Martin',
                'genre' => 'Informatique',
                'description' => 'Les principes et pratiques pour écrire un code clair, maintenable et de qualité.',
                'langue' => 'Anglais',
                'quantite_totale' => 3,
            ],
            [
                'titre' => 'Design Patterns : Elements of Reusable Object-Oriented Software',
                'auteur' => 'Erich Gamma, Richard Helm, Ralph Johnson, John Vlissides',
                'genre' => 'Informatique',
                'description' => 'Le catalogue de référence des patrons de conception en programmation orientée objet.',
                'langue' => 'Anglais',
                'quantite_totale' => 2,
            ],
            [
                'titre' => 'L\'Évolution créatrice',
                'auteur' => 'Henri Bergson',
                'genre' => 'Philosophie',
                'description' => 'Une réflexion majeure sur le temps, la durée et l\'évolution du vivant.',
                'langue' => 'Français',
                'quantite_totale' => 2,
            ],
            [
                'titre' => 'Systèmes d\'exploitation : Concepts fondamentaux',
                'auteur' => 'Andrew S. Tanenbaum',
                'genre' => 'Informatique',
                'description' => 'Les concepts essentiels des systèmes d\'exploitation modernes.',
                'langue' => 'Français',
                'quantite_totale' => 2,
            ],
            [
                'titre' => 'Les Misérables',
                'auteur' => 'Victor Hugo',
                'genre' => 'Classique',
                'description' => 'La quête de rédemption de Jean Valjean dans la France du XIXe siècle.',
                'langue' => 'Français',
                'quantite_totale' => 2,
            ],
            [
                'titre' => 'Le Cerveau de Mozart',
                'auteur' => 'Oliver Sacks',
                'genre' => 'Science',
                'description' => 'Exploration des mystères du cerveau et de la musique à travers des cas cliniques fascinants.',
                'langue' => 'Français',
                'quantite_totale' => 1,
            ],
            [
                'titre' => 'Introduction to Algorithms',
                'auteur' => 'Thomas H. Cormen et al.',
                'genre' => 'Informatique',
                'description' => 'Le manuel de référence sur les algorithmes et leurs analyses.',
                'langue' => 'Anglais',
                'quantite_totale' => 3,
            ],
            [
                'titre' => 'La Boîte à merveilles',
                'auteur' => 'Ahmed Sefrioui',
                'genre' => 'Roman',
                'description' => 'Les souvenirs d\'enfance d\'un écrivain dans le Maroc traditionnel des années 1940.',
                'langue' => 'Français',
                'quantite_totale' => 4,
            ],
        ];

        foreach ($livres as $livre) {
            Livre::firstOrCreate(
                ['titre' => $livre['titre']],
                $livre + ['quantite_disponible' => $livre['quantite_totale']],
            );
        }
    }
}
