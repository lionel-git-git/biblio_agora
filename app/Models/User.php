<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'sexe', 'photo'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function emprunts()
    {
        return $this->hasMany(Emprunt::class); // cela veut dire  "un utilisateur a plusieurs emprunts"
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? asset('storage/'.$this->photo) : null;
    }

    public function getInitialsAttribute(): string
    {
        $mots = preg_split('/\s+/', trim((string) $this->name));

        $initiales = strtoupper(mb_substr($mots[0] ?? '?', 0, 1));

        if (count($mots) > 1) {
            $initiales .= strtoupper(mb_substr((string) end($mots), 0, 1));
        }

        return $initiales;
    }

    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'admin' => 'Administrateur',
            'bibliothecaire' => 'Bibliothécaire',
            'etudiant' => 'Étudiant',
            default => ucfirst((string) $this->role),
        };
    }
}
