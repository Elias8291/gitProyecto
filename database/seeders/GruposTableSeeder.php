<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GruposTableSeeder extends Seeder
{
    public function run()
    {
        $grupos = [
            [
                'clave' => 'G101',
                'nombre' => 'Grupo 101',
                'rango_alumnos_id' => 1,
                'horario_id' => 1,
                'materia_id' => 1
            ],
            [
                'clave' => 'G102',
                'nombre' => 'Grupo 102',
                'rango_alumnos_id' => 2,
                'horario_id' => 2,
                'materia_id' => 2
            ],
            [
                'clave' => 'G201',
                'nombre' => 'Grupo 201',
                'rango_alumnos_id' => 3,
                'horario_id' => 3,
                'materia_id' => 3
            ],
            [
                'clave' => 'G202',
                'nombre' => 'Grupo 202',
                'rango_alumnos_id' => 4,
                'horario_id' => 4,
                'materia_id' => 4
            ],
            [
                'clave' => 'G301',
                'nombre' => 'Grupo 301',
                'rango_alumnos_id' => 5,
                'horario_id' => 5,
                'materia_id' => 5
            ],
            [
                'clave' => 'G302',
                'nombre' => 'Grupo 302',
                'rango_alumnos_id' => 1,
                'horario_id' => 1,
                'materia_id' => 6
            ],
            [
                'clave' => 'G401',
                'nombre' => 'Grupo 401',
                'rango_alumnos_id' => 2,
                'horario_id' => 2,
                'materia_id' => 7
            ],
            [
                'clave' => 'G402',
                'nombre' => 'Grupo 402',
                'rango_alumnos_id' => 3,
                'horario_id' => 3,
                'materia_id' => 8
            ],
            [
                'clave' => 'G501',
                'nombre' => 'Grupo 501',
                'rango_alumnos_id' => 4,
                'horario_id' => 4,
                'materia_id' => 9
            ],
            [
                'clave' => 'G502',
                'nombre' => 'Grupo 502',
                'rango_alumnos_id' => 5,
                'horario_id' => 5,
                'materia_id' => 10
            ]
        ];

        foreach ($grupos as $grupo) {
            DB::table('grupos')->insert($grupo);
        }
    }
}