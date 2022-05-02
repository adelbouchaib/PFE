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
            'id'=>'2',
            'title' => 'Branche Operations',

        ]);
        Direction::insert([
            'id'=>'2',
            'user_id' => '1',
            'branche_id' => '2',
            'title' => "Direction Forage"

        ]);
    }
}
