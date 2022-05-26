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
            'titre' => "Congé annuel",
            'remuneration' =>'1'
        ]);
        TypeConge::insert([
            'titre' => "Congé de maternite",
            'remuneration' =>'1'
        ]);
        TypeConge::insert([
            'titre' => "Congé familial",
            'remuneration' =>'1'
        ]);
        TypeConge::insert([
            'titre' => "Congé de recuperation",
            'remuneration' =>'1'
        ]);
        TypeConge::insert([
            'titre' => "Congé sans solde",
            'remuneration' =>'0'
        ]);
        TypeConge::insert([
            'titre' => "Congé speciale remunérée",
            'remuneration' =>'1'
        ]);

        TypeConge::insert([
            'titre' => "Congé maladie",
            'remuneration' =>'1'
        ]);

        TypeConge::insert([
            'titre' => "Congé accident de travail",
            'remuneration' =>'1'
        ]);

        TypeAbsence::insert([
            'titre' => "Absence spéciale non rémunérée",
            'remuneration' =>'0'
        ]);
        TypeAbsence::insert([
            'titre' => "Absence spéciale rémunérée",
            'remuneration' =>'1'
        ]);
        TypeAbsence::insert([
            'titre' => "Délai de route",
            'remuneration' =>'1'
        ]);


            TypeSanction::insert([
                'titre' => "Sanction disciplinaire",
                'remuneration' =>'0'
            ]);
            TypeSanction::insert([
                'titre' => "Mise en disponibilite",
                'remuneration' =>'0'
            ]);
            TypeSanction::insert([
                'titre' => "Détachement sans solde",
                'remuneration' =>'0'
            ]);

          
        }

}
