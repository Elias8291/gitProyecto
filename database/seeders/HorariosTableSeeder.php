<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HorariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inicio = Carbon::createFromTime(7, 0, 0); // 7:00 AM
        $fin = Carbon::createFromTime(20, 0, 0); // 8:00 PM

        $horarios = [];

        while ($inicio->lessThan($fin)) {
            $horaInicio = $inicio->format('H:i:s');
            $horaFin = $inicio->addHour()->format('H:i:s');

            $horarios[] = [
                'hora_in' => $horaInicio,
                'hora_fn' => $horaFin,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('horarios')->insert($horarios);
    }
}
