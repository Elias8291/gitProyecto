<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RangosAlumnosTableSeeder extends Seeder
{


    public function run()
    {
        $rangos = [
            ['min_alumnos' => 10, 'max_alumnos' => 20],
            ['min_alumnos' => 21, 'max_alumnos' => 30],
            ['min_alumnos' => 31, 'max_alumnos' => 40],
            ['min_alumnos' => 41, 'max_alumnos' => 50],
            ['min_alumnos' => 51, 'max_alumnos' => 60],
        ];

        DB::table('rango_alumnos')->insert($rangos);
    }
}
