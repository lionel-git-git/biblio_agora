<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emprunt extends Model
{
    public const STATUT_EN_ATTENTE = 'en_attente';
    public const STATUT_EN_COURS = 'en_cours';
    public const STATUT_RETOURNE = 'retourne';
    public const STATUT_REFUSE = 'refuse';
    public const STATUT_EN_RETARD = 'en_retard';

    public const DUREE_PRET_JOURS = 14;

    protected $fillable = [
        'user_id',
        'livre_id',
        'date_emprunt',
        'date_retour_prevue',
        'date_retour_effective',
        'statut',
    ];

    protected function casts(): array
    {
        return [
            'date_emprunt' => 'date',
            'date_retour_prevue' => 'date',
            'date_retour_effective' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function livre()
    {
        return $this->belongsTo(Livre::class);
    }

    public function scopeEnCours($query)
    {
        return $query->whereIn('statut', [self::STATUT_EN_COURS, self::STATUT_EN_RETARD]);
    }

    public function scopeEnAttente($query)
    {
        return $query->where('statut', self::STATUT_EN_ATTENTE);
    }
}