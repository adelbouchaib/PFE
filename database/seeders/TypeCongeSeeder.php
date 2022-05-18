<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Eloquent\Model;

use App\Models\TypeConge;
use App\Models\TypeAbsence;
use App\Models\TypeSanction;



class TypeCongeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {

        
        TypeConge::insert([
            'titre' => "Congé annuel"
        ]);
        TypeConge::insert([
            'titre' => "Congé de maternite"
        ]);
        TypeConge::insert([
            'titre' => "Congé familial"
        ]);
        TypeConge::insert([
            'titre' => "Congé de recuperation"
        ]);
        TypeConge::insert([
            'titre' => "Congé sans solde"
        ]);
        TypeConge::insert([
            'titre' => "Congé speciale remunérée"
        ]);

        TypeConge::insert([
            'titre' => "Congé maladie"
        ]);

        TypeConge::insert([
            'titre' => "Congé accident de travail"
        ]);

        TypeAbsence::insert([
            'titre' => "Absence spéciale non rémunérée"
        ]);
        TypeAbsence::insert([
            'titre' => "Absence spéciale rémunérée"
        ]);
        TypeAbsence::insert([
            'titre' => "Délai de route"
        ]);


            TypeSanction::insert([
                'titre' => "Sanction disciplinaire"
            ]);
            TypeSanction::insert([
                'titre' => "Mise en disponibilite"
            ]);
            TypeSanction::insert([
                'titre' => "Détachement sans solde"
            ]);

          
        }

}
