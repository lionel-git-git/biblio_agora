<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'bibliothecaire@biblio.com'],
            [
                'name' => 'Bibliothécaire',
                'password' => 'password',
                'role' => 'bibliothecaire',
                'sexe' => 'M',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'etudiant@biblio.com'],
            [
                'name' => 'Étudiant',
                'password' => 'password',
                'role' => 'etudiant',
                'sexe' => 'M',
                'email_verified_at' => now(),
            ]
        );
    }
}
