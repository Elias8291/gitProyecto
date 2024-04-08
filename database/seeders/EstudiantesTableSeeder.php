<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EstudiantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estudiantes = [
            ['numeroDeControl' => '20230101', 'nombre' => 'Luis Alberto', 'apellidoPaterno' => 'Hernández', 'apellidoMaterno' => 'Gómez', 'semestre' => 1],
            ['numeroDeControl' => '20230102', 'nombre' => 'María Fernanda', 'apellidoPaterno' => 'López', 'apellidoMaterno' => 'Martínez', 'semestre' => 2],
            ['numeroDeControl' => '20230103', 'nombre' => 'Carlos Eduardo', 'apellidoPaterno' => 'Jiménez', 'apellidoMaterno' => 'Pérez', 'semestre' => 3],
            ['numeroDeControl' => '20230104', 'nombre' => 'Ana Sofia', 'apellidoPaterno' => 'Morales', 'apellidoMaterno' => 'Ruiz', 'semestre' => 4],
            ['numeroDeControl' => '20230105', 'nombre' => 'Jorge Luis', 'apellidoPaterno' => 'Ramírez', 'apellidoMaterno' => 'Sánchez', 'semestre' => 5],
            ['numeroDeControl' => '20230106', 'nombre' => 'Daniela', 'apellidoPaterno' => 'García', 'apellidoMaterno' => 'Vázquez', 'semestre' => 6],
            ['numeroDeControl' => '20230107', 'nombre' => 'Alejandro', 'apellidoPaterno' => 'Díaz', 'apellidoMaterno' => 'Castro', 'semestre' => 7],
            ['numeroDeControl' => '20230108', 'nombre' => 'Fernanda', 'apellidoPaterno' => 'Mendoza', 'apellidoMaterno' => 'Alvarez', 'semestre' => 8],
            ['numeroDeControl' => '20230109', 'nombre' => 'Roberto', 'apellidoPaterno' => 'Navarro', 'apellidoMaterno' => 'Luna', 'semestre' => 9],
            ['numeroDeControl' => '20230110', 'nombre' => 'Patricia', 'apellidoPaterno' => 'Moreno', 'apellidoMaterno' => 'Salazar', 'semestre' => 10],
        ];

        DB::table('estudiantes')->insert($estudiantes);
    }
}
