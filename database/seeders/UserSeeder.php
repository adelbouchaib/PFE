<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Eloquent\Model;

use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        $users = User::all();


            User::insert([
                'matricule'=>'DRH001',
                'direction_id'=>'0',
                'role'=>'0',
                'prenom'=>Str::random(10),
                'nom'=>Str::random(10),
                'email'=> Str::random(3)."@gmail.com",
                'password'=> "$2a$12$2rXqAfRitps9UkSuA7hcYe22W7PfcWI1ea/yfbfOJxxUwaf/uI5f2",
                'lieu_naiss'=> "El biar",
                'date_naiss'=> "2000-02-02",
                'adresse'=> "Alger",
                'sexe'=> 'H',
                'num_telephone'=> "0555555555",
                'situation_familiale'=> '0',
                'situation_conjoint'=> '0',
                'nbr_enfant'=> '3',
                'num_securite_social'=> "00000000000",
                'num_compte'=> "0000000000000",
                'fonction'=> "Ingenieur",
                'echelle'=> '10',
                'echelon'=> '10',
                'type_contrat'=> '0',
                'debut_contrat'=> "2022-02-02",
                'date_recrutement'=> "2000-02-02",

                'position'=> '0',
                'experience_pro'=> '30',
                'base'=>'0',


            ]);

            
            User::insert([
                'matricule'=>'DRH002',
                'direction_id'=>'0',
                'role'=>'1',
                'prenom'=>Str::random(10),
                'nom'=>Str::random(10),
                'email'=> Str::random(3)."@gmail.com",
                'password'=> "$2a$12$2rXqAfRitps9UkSuA7hcYe22W7PfcWI1ea/yfbfOJxxUwaf/uI5f2",
                'lieu_naiss'=> "El biar",
                'date_naiss'=> "2000-02-02",
                'adresse'=> "Alger",
                'sexe'=> 'H',
                'num_telephone'=> "0555555555",
                'situation_familiale'=> '0',
                'situation_conjoint'=> '0',
                'nbr_enfant'=> '3',
                'num_securite_social'=> "00000000000",
                'num_compte'=> "0000000000000",
                'position'=> '0',
                'fonction'=> "Ingenieur",
                'echelle'=> '10',
                'echelon'=> '10',
                'experience_pro'=> '30',
                'type_contrat'=> '0',
                'debut_contrat'=> "2022-02-02",
                'date_recrutement'=> "2000-02-02",
                'base'=>'0',
    
            ]);
        
      
    }
}
