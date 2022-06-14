<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Eloquent\Model;

use App\Models\User;
use App\Models\Presence;
use Carbon\Carbon;



class AbsenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        $users = User::all();

    

            foreach($users as $user){

                Presence::insert([
                    'matricule'=>$user->matricule,
                    'start_time'=>'00:00:00',
                    'end_time'=>'00:00:00',
                    'date'=> Carbon::now()->format('Y-m-d'),
                   
                ]);
            }

        
      
    }
}
