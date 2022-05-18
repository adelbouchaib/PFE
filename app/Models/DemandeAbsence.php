<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class Demandeabsence extends Model
=======
class DemandeAbsence extends Model
>>>>>>> 88bddf8adac36768e0c832b7db6f4b84dbfb76f2
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function typeabsence()
    {
        return $this->belongsTo('App\Models\TypeAbsence');
    }
}
