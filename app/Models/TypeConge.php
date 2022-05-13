<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeConge extends Model
{
    use HasFactory;

    public function conge()
    {
        return $this->hasMany('App\Models\Conge','type_id');
    }
}
