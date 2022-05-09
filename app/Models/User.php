<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function attendance()
    {
        return $this->hasMany('App\Models\Attendance','matricule');
    }



    public function paiement()
    {
        return $this->hasMany('App\Models\Paiement','user_id');
    }

    public function conge()
    {
        return $this->hasMany('App\Models\Conge','user_id');
    }

    public function projet()
    {
        return $this->hasMany('App\Models\Projet','user_id');
    }


    public function projets(){
        return $this->belongstoMany(Projet::class);
    }

    public function direction()
    {
        return $this->belongsTo('App\Models\Direction','departement');
    }

    
    // public function direction()
    // {
    //     return $this->hasOne('App\Models\Direction');
    // }




   
    // public function motifconge(){
    //     return $this->belongstoMany(Motifconge::class);
    // }
    
    



    
}
