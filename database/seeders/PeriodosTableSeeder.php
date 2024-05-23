<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeriodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDate = Carbon::now();

        DB::table('periodos')->insert([
            // Períodos anteriores (inactivos)
            [
                'nombre' => 'Primer Semestre 2022',
                'fecha_inicio' => '2022-01-01',
                'fecha_fin' => '2022-06-30',
                'estatus' => 0, // Inactivo
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Segundo Semestre 2022',
                'fecha_inicio' => '2022-07-01',
                'fecha_fin' => '2022-12-31',
                'estatus' => 0, // Inactivo
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Primer Semestre 2023',
                'fecha_inicio' => '2023-01-01',
                'fecha_fin' => '2023-06-30',
                'estatus' => 0, // Inactivo
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Segundo Semestre 2023',
                'fecha_inicio' => '2023-07-01',
                'fecha_fin' => '2023-12-31',
                'estatus' => 0, // Inactivo
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Períodos actuales y futuros (activos)
            [
                'nombre' => 'Primer Semestre 2024',
                'fecha_inicio' => '2024-01-01',
                'fecha_fin' => '2024-06-30',
                'estatus' => 1, // Activo
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Segundo Semestre 2024',
                'fecha_inicio' => '2024-07-01',
                'fecha_fin' => '2024-12-31',
                'estatus' => 0, // Activo
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Primer Semestre 2025',
                'fecha_inicio' => '2025-01-01',
                'fecha_fin' => '2025-06-30',
                'estatus' => 0, // Activo
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Segundo Semestre 2025',
                'fecha_inicio' => '2025-07-01',
                'fecha_fin' => '2025-12-31',
                'estatus' => 0, // Activo
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
