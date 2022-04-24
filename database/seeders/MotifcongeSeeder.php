<?php

namespace Database\Seeders;
use App\Models\Motifconge;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Eloquent\Model;

class MotifcongeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('motifconges')->insert([
            'type'=>Str::random(10)

        ]);
        foreach(Motifconge::all() as $motifconge)
        {
            $users =\App\Models\User::inRandomOrder()->take(rand(1,3))->pluck('id');
            foreach($users as $user){

                $motifconge->users()->attach($user,['date_sortie' => '2022/04/04'] );
            }
        }
        
        
    }
}
