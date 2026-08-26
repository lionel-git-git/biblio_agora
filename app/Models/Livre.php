<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    public function emprunts()
{
    return $this->hasMany(Emprunt::class);
}  //un livre a plusieurs emprunts (au fil du temps)
}
