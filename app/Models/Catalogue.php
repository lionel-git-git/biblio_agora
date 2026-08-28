<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    protected $fillable = [
        'nom',
        'description',
    ];

    public function livres()
    {
        return $this->hasMany(Livre::class);
    }
}
