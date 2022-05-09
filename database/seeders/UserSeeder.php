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
        User::insert([
            'id'=>'2',
            'matricule'=>'DG22H002',
            'departement'=>'0',
            'role'=>'2',
            'first_name'=>Str::random(10),
            'last_name'=>Str::random(10),
            'email'=> "aa@gmail.com",
            'password'=> "$2a$12$2rXqAfRitps9UkSuA7hcYe22W7PfcWI1ea/yfbfOJxxUwaf/uI5f2"

        ]);
    }
}
