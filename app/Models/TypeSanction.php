<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeSanction extends Model
{
    use HasFactory;

    public function sanction()
    {
        return $this->hasMany('App\Models\Sanction','type_id');
    }
}
