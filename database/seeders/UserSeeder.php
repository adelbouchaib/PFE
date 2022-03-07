<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Eloquent\Model;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'=>User::all()->random()->id,
            'first_name'=>Str::random(10),
            'last_name'=>Str::random(10),
            'email'=>Str::random(10).'@gmail.com',
            'password'=>Hash::make('adel')

        ]);
    }
}
