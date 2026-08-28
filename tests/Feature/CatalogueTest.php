<?php

use App\Models\Catalogue;
use App\Models\Emprunt;
use App\Models\Livre;
use App\Models\User;

function catalogueTest(array $attrs = []): Catalogue
{
    return Catalogue::create(array_merge([
        'nom' => 'Catalogue Test',
        'description' => 'Un catalogue pour les tests.',
    ], $attrs));
}

function livreCatalogueTest(string $titre, array $attrs = []): Livre
{
    return Livre::create(array_merge([
        'titre' => $titre,
        'auteur' => 'Auteur',
        'genre' => 'Informatique',
        'description' => null,
        'langue' => 'Français',
        'quantite_totale' => 1,
        'quantite_disponible' => 1,
    ], $attrs));
}

test('un bibliothécaire peut accéder à la gestion des catalogues', function () {
    $bibliothecaire = User::factory()->create(['role' => 'bibliothecaire']);

    $this->actingAs($bibliothecaire)->get(route('catalogues.index'))->assertOk();
});

test('un étudiant ne peut pas accéder à la gestion des catalogues', function () {
    $etudiant = User::factory()->create(['role' => 'etudiant']);

    $this->actingAs($etudiant)->get(route('catalogues.index'))->assertForbidden();
});

test('un bibliothécaire peut créer un catalogue', function () {
    $bibliothecaire = User::factory()->create(['role' => 'bibliothecaire']);

    $this->actingAs($bibliothecaire)
        ->post(route('catalogues.store'), [
            'nom' => 'Bandes dessinées',
            'description' => 'Les BD de la bibliothèque.',
        ])
        ->assertRedirect(route('catalogues.index'));

    $this->assertDatabaseHas('catalogues', ['nom' => 'Bandes dessinées']);
});

test('deux catalogues ne peuvent pas porter le même nom', function () {
    catalogueTest(['nom' => 'Doublon']);
    $bibliothecaire = User::factory()->create(['role' => 'bibliothecaire']);

    $this->actingAs($bibliothecaire)
        ->post(route('catalogues.store'), ['nom' => 'Doublon'])
        ->assertSessionHasErrors('nom');

    expect(Catalogue::count())->toBe(1);
});

test('le menu Catalogue des bibliothécaires pointe vers la gestion des catalogues', function () {
    $bibliothecaire = User::factory()->create(['role' => 'bibliothecaire']);

    $this->actingAs($bibliothecaire)
        ->get(route('bibliothecaire.dashboard'))
        ->assertOk()
        ->assertSee(route('catalogues.index'));
});

test('le menu Catalogue des étudiants reste le catalogue public', function () {
    $etudiant = User::factory()->create(['role' => 'etudiant']);

    $this->actingAs($etudiant)
        ->get(route('etudiant.dashboard'))
        ->assertOk()
        ->assertSee(route('catalogue'));
});

test('la suppression d\'un catalogue détache ses livres sans les supprimer', function () {
    $catalogue = catalogueTest();
    $livre = livreCatalogueTest('Livre Détaché', ['catalogue_id' => $catalogue->id]);
    $bibliothecaire = User::factory()->create(['role' => 'bibliothecaire']);

    $this->actingAs($bibliothecaire)
        ->delete(route('catalogues.destroy', $catalogue))
        ->assertRedirect();

    expect(Catalogue::count())->toBe(0);
    expect($livre->fresh()->catalogue_id)->toBeNull();
    expect(Livre::count())->toBe(1);
});

test('un livre retiré est masqué du catalogue public', function () {
    $retire = livreCatalogueTest('Ouvrage Retiré Unique', ['statut' => Livre::STATUT_RETIRE]);
    $visible = livreCatalogueTest('Ouvrage Visible Unique');

    $this->get(route('catalogue'))
        ->assertOk()
        ->assertDontSee('Ouvrage Retiré Unique')
        ->assertSee('Ouvrage Visible Unique');

    expect($retire->exists() && $visible->exists())->toBeTrue();
});

test('un livre indisponible ou retiré ne peut pas être emprunté', function () {
    $etudiant = User::factory()->create(['role' => 'etudiant']);

    foreach ([Livre::STATUT_INDISPONIBLE, Livre::STATUT_RETIRE] as $statut) {
        $livre = livreCatalogueTest("Livre $statut", [
            'quantite_totale' => 2,
            'quantite_disponible' => 2,
            'statut' => $statut,
        ]);

        $this->actingAs($etudiant)
            ->post(route('emprunts.store', $livre))
            ->assertSessionHas('error');

        $this->assertDatabaseMissing('emprunts', ['livre_id' => $livre->id]);
    }

    expect(Emprunt::count())->toBe(0);
});

test('un bibliothécaire peut changer le statut d\'un livre', function () {
    $livre = livreCatalogueTest('Livre Statut', [
        'quantite_totale' => 2,
        'quantite_disponible' => 1,
    ]);
    $bibliothecaire = User::factory()->create(['role' => 'bibliothecaire']);

    $this->actingAs($bibliothecaire)
        ->put(route('livres.update', $livre), [
            'titre' => 'Livre Statut',
            'auteur' => 'Auteur',
            'genre' => 'Informatique',
            'quantite_totale' => 2,
            'statut' => Livre::STATUT_INDISPONIBLE,
        ])
        ->assertRedirect();

    expect($livre->fresh()->statut)->toBe(Livre::STATUT_INDISPONIBLE);
});
