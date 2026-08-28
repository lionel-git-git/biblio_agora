<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    protected $fillable = [
        'titre',
        'auteur',
        'genre',
        'description',
        'langue',
        'quantite_totale',
        'quantite_disponible',
        'image_couverture',
    ];
    public function emprunts()
{
    return $this->hasMany(Emprunt::class);
}  //un livre a plusieurs emprunts (au fil du temps)
}
