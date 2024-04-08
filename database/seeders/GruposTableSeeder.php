<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GruposTableSeeder extends Seeder

{
    
    public function run()
    {
        $grupos = [
            ['clave' => 'G101', 'nombre' => 'Grupo 101', 'rango_alumnos_id' => 1, 'horario_id' => 1, 'materia_clave' => 'PROGBAS'],
            ['clave' => 'G102', 'nombre' => 'Grupo 102', 'rango_alumnos_id' => 2, 'horario_id' => 2, 'materia_clave' => 'ESTDAT'],
            ['clave' => 'G201', 'nombre' => 'Grupo 201', 'rango_alumnos_id' => 3, 'horario_id' => 3, 'materia_clave' => 'BASEDAT'],
            ['clave' => 'G202', 'nombre' => 'Grupo 202', 'rango_alumnos_id' => 4, 'horario_id' => 4, 'materia_clave' => 'REDCOMP'],
            ['clave' => 'G301', 'nombre' => 'Grupo 301', 'rango_alumnos_id' => 5, 'horario_id' => 5, 'materia_clave' => 'SISOP'],
            ['clave' => 'G302', 'nombre' => 'Grupo 302', 'rango_alumnos_id' => 1, 'horario_id' => 1, 'materia_clave' => 'INGESW'],
            ['clave' => 'G401', 'nombre' => 'Grupo 401', 'rango_alumnos_id' => 2, 'horario_id' => 2, 'materia_clave' => 'SEGINFO'],
            ['clave' => 'G402', 'nombre' => 'Grupo 402', 'rango_alumnos_id' => 3, 'horario_id' => 3, 'materia_clave' => 'INTART'],
            ['clave' => 'G501', 'nombre' => 'Grupo 501', 'rango_alumnos_id' => 4, 'horario_id' => 4, 'materia_clave' => 'DESAAPL'],
            ['clave' => 'G502', 'nombre' => 'Grupo 502', 'rango_alumnos_id' => 5, 'horario_id' => 5, 'materia_clave' => 'COMPNUB']
        ];

        foreach ($grupos as $grupo) {
            DB::table('grupos')->insert($grupo);
        }
    }
}
