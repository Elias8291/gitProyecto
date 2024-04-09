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
                ['estudiante_id' => 1, 'grupo_clave' => 'G101'],
                ['estudiante_id' => 2, 'grupo_clave' => 'G101'],
                ['estudiante_id' => 3, 'grupo_clave' => 'G102'],
                ['estudiante_id' => 4, 'grupo_clave' => 'G102'],
                ['estudiante_id' => 5, 'grupo_clave' => 'G201'],
                // Add more inscriptions as needed
            ];
    
            DB::table('inscripciones')->insert($inscripciones);
        }
    
}
