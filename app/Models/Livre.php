<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    public const STATUT_DISPONIBLE = 'disponible';

    public const STATUT_INDISPONIBLE = 'indisponible';

    public const STATUT_RETIRE = 'retire';

    public const STATUT_LABELS = [
        self::STATUT_DISPONIBLE => 'Disponible',
        self::STATUT_INDISPONIBLE => 'Indisponible',
        self::STATUT_RETIRE => 'Retiré',
    ];

    protected $fillable = [
        'titre',
        'auteur',
        'genre',
        'description',
        'langue',
        'quantite_totale',
        'quantite_disponible',
        'image_couverture',
        'catalogue_id',
        'statut',
    ];

    public function emprunts()
    {
        return $this->hasMany(Emprunt::class);
    }  // un livre a plusieurs emprunts (au fil du temps)

    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function getStatutLabelAttribute(): string
    {
        return self::STATUT_LABELS[$this->statut] ?? $this->statut;
    }
}
