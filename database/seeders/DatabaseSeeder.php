<?php

namespace Database\Seeders;

use App\Models\RangoAlumno;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         // Llama a los seeders específicos aquí
         $this->call([
            EstudiantesTableSeeder::class,
            HorariosTableSeeder::class,
            RangosAlumnosTableSeeder::class,
            Materias::class,
            GruposTableSeeder::class,
            InscripcionesTableSeeder::class,
            SeederTablaPermisos::class
        ]);
    }
}
