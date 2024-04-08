<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class inscripcionesTablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
        public function run()
        {
            $inscripciones = [
                ['estudiantes_numeroDeControl' => '20230101', 'grupo_clave' => 'G101'],
                ['estudiantes_numeroDeControl' => '20230102', 'grupo_clave' => 'G101'],
                ['estudiantes_numeroDeControl' => '20230103', 'grupo_clave' => 'G102'],
                ['estudiantes_numeroDeControl' => '20230104', 'grupo_clave' => 'G102'],
                ['estudiantes_numeroDeControl' => '20230105', 'grupo_clave' => 'G201'],
                // Add more inscriptions as needed
            ];
    
            DB::table('inscripciones')->insert($inscripciones);
        }
    
}
