<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;


    public function users(){
        return $this->belongstoMany(User::class);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function task()
    {
        return $this->hasMany('App\Models\Task','user_id');
    }
}
