<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Materias extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            ['clave' => 'PROGBAS', 'nombre' => 'Programación Básica', 'creditos' => 6],
            ['clave' => 'ESTDAT', 'nombre' => 'Estructuras de Datos', 'creditos' => 6],
            ['clave' => 'BASEDAT', 'nombre' => 'Bases de Datos', 'creditos' => 8],
            ['clave' => 'REDCOMP', 'nombre' => 'Redes de Computadoras', 'creditos' => 6],
            ['clave' => 'SISOP', 'nombre' => 'Sistemas Operativos', 'creditos' => 6],
            ['clave' => 'INGESW', 'nombre' => 'Ingeniería de Software', 'creditos' => 8],
            ['clave' => 'SEGINFO', 'nombre' => 'Seguridad Informática', 'creditos' => 6],
            ['clave' => 'INTART', 'nombre' => 'Inteligencia Artificial', 'creditos' => 8],
            ['clave' => 'DESAAPL', 'nombre' => 'Desarrollo de Aplicaciones', 'creditos' => 8],
            ['clave' => 'COMPNUB', 'nombre' => 'Computación en la Nube', 'creditos' => 6]
        ];

        foreach ($subjects as $subject) {
            DB::table('materias')->insert($subject);
        }
    }
}
