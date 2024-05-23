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
                'materia_id' => 1,
                'periodo_id' => 1, // Asumiendo que el período 1 es el primer semestre de 2024
            ],
            [
                'clave' => 'G102',
                'nombre' => 'Grupo 102',
                'rango_alumnos_id' => 2,
                'horario_id' => 2,
                'materia_id' => 2,
                'periodo_id' => 1, // Asumiendo que el período 1 es el primer semestre de 2024
            ],
            [
                'clave' => 'G201',
                'nombre' => 'Grupo 201',
                'rango_alumnos_id' => 3,
                'horario_id' => 3,
                'materia_id' => 3,
                'periodo_id' => 2, // Asumiendo que el período 2 es el segundo semestre de 2024
            ],
            [
                'clave' => 'G202',
                'nombre' => 'Grupo 202',
                'rango_alumnos_id' => 4,
                'horario_id' => 4,
                'materia_id' => 4,
                'periodo_id' => 2, // Asumiendo que el período 2 es el segundo semestre de 2024
            ],
            [
                'clave' => 'G301',
                'nombre' => 'Grupo 301',
                'rango_alumnos_id' => 5,
                'horario_id' => 5,
                'materia_id' => 5,
                'periodo_id' => 3, // Asumiendo que el período 3 es el primer semestre de 2025
            ],
            [
                'clave' => 'G302',
                'nombre' => 'Grupo 302',
                'rango_alumnos_id' => 1,
                'horario_id' => 1,
                'materia_id' => 6,
                'periodo_id' => 3, // Asumiendo que el período 3 es el primer semestre de 2025
            ],
            [
                'clave' => 'G401',
                'nombre' => 'Grupo 401',
                'rango_alumnos_id' => 2,
                'horario_id' => 2,
                'materia_id' => 7,
                'periodo_id' => 4, // Asumiendo que el período 4 es el segundo semestre de 2025
            ],
            [
                'clave' => 'G402',
                'nombre' => 'Grupo 402',
                'rango_alumnos_id' => 3,
                'horario_id' => 3,
                'materia_id' => 8,
                'periodo_id' => 4, // Asumiendo que el período 4 es el segundo semestre de 2025
            ],
            [
                'clave' => 'G501',
                'nombre' => 'Grupo 501',
                'rango_alumnos_id' => 4,
                'horario_id' => 4,
                'materia_id' => 9,
                'periodo_id' => 5, // Asumiendo que el período 5 es el primer semestre de 2026
            ],
            [
                'clave' => 'G502',
                'nombre' => 'Grupo 502',
                'rango_alumnos_id' => 5,
                'horario_id' => 5,
                'materia_id' => 10,
                'periodo_id' => 5, // Asumiendo que el período 5 es el primer semestre de 2026
            ],
            [
                'clave' => 'G509',
                'nombre' => 'Grupo 509',
                'rango_alumnos_id' => 6,
                'horario_id' => 5,
                'materia_id' => 10,
                'periodo_id' => 5, // Asumiendo que el período 5 es el primer semestre de 2026
            ]
        ];

        foreach ($grupos as &$grupo) {
            // Obtener el periodo correspondiente
            $periodo = DB::table('periodos')->where('id', $grupo['periodo_id'])->first();
            // Definir el estado del grupo según el estado del periodo
            $grupo['activo'] = $periodo->estatus;
        }

        DB::table('grupos')->insert($grupos);
    }
}
