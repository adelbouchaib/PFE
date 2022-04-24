<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motifconge extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongstoMany(User::class)
        ->as('conge')
        ->withPivot(['id','date_sortie','date_entree','duree','etat']);
    }
    
}
