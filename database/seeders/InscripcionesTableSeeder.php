<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InscripcionesTableSeeder extends Seeder
{
    public function run()
    {
        $inscripciones = [
            [
                'estudiante_id' => 1,
                'grupo_id' => 1
            ],
            [
                'estudiante_id' => 2,
                'grupo_id' => 1
            ],
            [
                'estudiante_id' => 3,
                'grupo_id' => 2
            ],
            [
                'estudiante_id' => 4,
                'grupo_id' => 2
            ],
            [
                'estudiante_id' => 5,
                'grupo_id' => 3
            ],
            [
                'estudiante_id' => 6,
                'grupo_id' => 3
            ],
            [
                'estudiante_id' => 7,
                'grupo_id' => 4
            ],
            [
                'estudiante_id' => 8,
                'grupo_id' => 4
            ],
            [
                'estudiante_id' => 9,
                'grupo_id' => 5
            ],
            [
                'estudiante_id' => 10,
                'grupo_id' => 5
            ]
        ];

        foreach ($inscripciones as $inscripcion) {
            DB::table('inscripciones')->insert($inscripcion);
        }
    }
} 