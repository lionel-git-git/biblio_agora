<?php

use App\Models\Emprunt;
use App\Models\Livre;
use App\Models\User;

function livreTest(string $titre = 'Test Book', int $quantite = 2): Livre
{
    return Livre::create([
        'titre' => $titre,
        'auteur' => 'Auteur Test',
        'genre' => 'Informatique',
        'description' => null,
        'langue' => 'Français',
        'quantite_totale' => $quantite,
        'quantite_disponible' => $quantite,
    ]);
}

test('un étudiant peut demander l\'emprunt d\'un livre disponible', function () {
    $etudiant = User::factory()->create(['role' => 'etudiant']);
    $livre = livreTest();

    $this->actingAs($etudiant)
        ->post(route('emprunts.store', $livre))
        ->assertRedirect();

    $this->assertDatabaseHas('emprunts', [
        'user_id' => $etudiant->id,
        'livre_id' => $livre->id,
        'statut' => Emprunt::STATUT_EN_ATTENTE,
    ]);
});

test('un étudiant ne peut pas demander deux fois le même livre', function () {
    $etudiant = User::factory()->create(['role' => 'etudiant']);
    $livre = livreTest();

    $this->actingAs($etudiant)->post(route('emprunts.store', $livre));

    $this->actingAs($etudiant)
        ->post(route('emprunts.store', $livre))
        ->assertSessionHas('error');

    expect(Emprunt::where('livre_id', $livre->id)->count())->toBe(1);
});

test('un étudiant ne peut pas demander un livre indisponible', function () {
    $etudiant = User::factory()->create(['role' => 'etudiant']);
    $livre = livreTest('Épuisé', 1);
    $livre->update(['quantite_disponible' => 0]);

    $this->actingAs($etudiant)
        ->post(route('emprunts.store', $livre))
        ->assertSessionHas('error');

    $this->assertDatabaseMissing('emprunts', ['livre_id' => $livre->id]);
});

test('la validation d\'une demande décrémente le stock disponible', function () {
    $etudiant = User::factory()->create(['role' => 'etudiant']);
    $bibliothecaire = User::factory()->create(['role' => 'bibliothecaire']);
    $livre = livreTest('Stock', 3);

    $this->actingAs($etudiant)->post(route('emprunts.store', $livre));

    $emprunt = Emprunt::where('livre_id', $livre->id)->first();

    $this->actingAs($bibliothecaire)
        ->patch(route('emprunts.valider', $emprunt))
        ->assertRedirect();

    expect($livre->fresh()->quantite_disponible)->toBe(2);
    expect($emprunt->fresh()->statut)->toBe(Emprunt::STATUT_EN_COURS);
    expect($emprunt->fresh()->date_retour_prevue)->not->toBeNull();
});

test('le retour d\'un emprunt remet l\'exemplaire en stock', function () {
    $etudiant = User::factory()->create(['role' => 'etudiant']);
    $bibliothecaire = User::factory()->create(['role' => 'bibliothecaire']);
    $livre = livreTest('Retour', 2);

    $emprunt = Emprunt::create([
        'user_id' => $etudiant->id,
        'livre_id' => $livre->id,
        'statut' => Emprunt::STATUT_EN_COURS,
        'date_emprunt' => now()->toDateString(),
        'date_retour_prevue' => now()->addDays(14)->toDateString(),
    ]);
    $livre->decrement('quantite_disponible');

    $this->actingAs($bibliothecaire)
        ->patch(route('emprunts.retour', $emprunt))
        ->assertRedirect();

    expect($livre->fresh()->quantite_disponible)->toBe(2);
    expect($emprunt->fresh()->statut)->toBe(Emprunt::STATUT_RETOURNE);
});

test('un étudiant ne peut pas valider une demande', function () {
    $etudiant = User::factory()->create(['role' => 'etudiant']);
    $livre = livreTest('Faille');

    $emprunt = Emprunt::create([
        'user_id' => $etudiant->id,
        'livre_id' => $livre->id,
        'statut' => Emprunt::STATUT_EN_ATTENTE,
    ]);

    $this->actingAs($etudiant)
        ->patch(route('emprunts.valider', $emprunt))
        ->assertForbidden();

    expect($emprunt->fresh()->statut)->toBe(Emprunt::STATUT_EN_ATTENTE);
});

test('un emprunt en cours dont le délai est dépassé devient en retard', function () {
    $etudiant = User::factory()->create(['role' => 'etudiant']);
    $bibliothecaire = User::factory()->create(['role' => 'bibliothecaire']);
    $livre = livreTest('Retard');

    Emprunt::create([
        'user_id' => $etudiant->id,
        'livre_id' => $livre->id,
        'statut' => Emprunt::STATUT_EN_COURS,
        'date_emprunt' => now()->subDays(30)->toDateString(),
        'date_retour_prevue' => now()->subDays(16)->toDateString(),
    ]);

    $this->actingAs($bibliothecaire)->get(route('emprunts.gestion'))->assertOk();

    expect(Emprunt::where('statut', Emprunt::STATUT_EN_RETARD)->count())->toBe(1);
});
