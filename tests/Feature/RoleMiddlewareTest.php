<?php

use App\Models\User;

test('un invité est redirigé vers la connexion pour les pages protégées', function () {
    $this->get(route('admin.dashboard'))->assertRedirect(route('login'));
    $this->get(route('livres.create'))->assertRedirect(route('login'));
    $this->get(route('emprunts.index'))->assertRedirect(route('login'));
});

test('un étudiant ne peut pas créer de livre', function () {
    $etudiant = User::factory()->create(['role' => 'etudiant']);

    $this->actingAs($etudiant)->get(route('livres.create'))->assertForbidden();
});

test('un étudiant ne peut pas accéder au dashboard admin', function () {
    $etudiant = User::factory()->create(['role' => 'etudiant']);

    $this->actingAs($etudiant)->get(route('admin.dashboard'))->assertForbidden();
});

test('un étudiant ne peut pas accéder au dashboard bibliothécaire', function () {
    $etudiant = User::factory()->create(['role' => 'etudiant']);

    $this->actingAs($etudiant)->get(route('bibliothecaire.dashboard'))->assertForbidden();
});

test('un bibliothécaire ne peut pas accéder au dashboard admin', function () {
    $bibliothecaire = User::factory()->create(['role' => 'bibliothecaire']);

    $this->actingAs($bibliothecaire)->get(route('admin.dashboard'))->assertForbidden();
});

test('un bibliothécaire peut accéder à la gestion des livres', function () {
    $bibliothecaire = User::factory()->create(['role' => 'bibliothecaire']);

    $this->actingAs($bibliothecaire)->get(route('livres.index'))->assertOk();
});

test('un admin peut accéder à la gestion des utilisateurs', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)->get(route('admin.utilisateurs'))->assertOk();
});

test('un bibliothécaire ne peut pas accéder à la gestion des utilisateurs', function () {
    $bibliothecaire = User::factory()->create(['role' => 'bibliothecaire']);

    $this->actingAs($bibliothecaire)->get(route('admin.utilisateurs'))->assertForbidden();
});

test('la route dashboard redirige vers le dashboard selon le rôle', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin)->get(route('dashboard'))->assertRedirect(route('admin.dashboard'));

    $bibliothecaire = User::factory()->create(['role' => 'bibliothecaire']);
    $this->actingAs($bibliothecaire)->get(route('dashboard'))->assertRedirect(route('bibliothecaire.dashboard'));

    $etudiant = User::factory()->create(['role' => 'etudiant']);
    $this->actingAs($etudiant)->get(route('dashboard'))->assertRedirect(route('etudiant.dashboard'));
});
