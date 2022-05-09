<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Eloquent\Model;

use App\Models\Direction;
use App\Models\Branche;


class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branche::insert([
            'id'=>'1',
            'nom_branche' => 'Branche Operations',

        ]);
        Direction::insert([
            'id'=>'1',
            'user_id' => '1',
            'branche_id' => '1',
            'nom_direction' => "Direction Forage"

        ]);
    }
}
