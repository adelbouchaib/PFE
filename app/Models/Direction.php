<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;

    
    public function user()
    {
        return $this->hasMany('App\Models\User','departement');
    }

    public function branche()
    {
        return $this->belongsTo('App\Models\Branche');
    }

    // public function user()
    // {
    //     return $this->hasOne(User::class);
    // }


}
