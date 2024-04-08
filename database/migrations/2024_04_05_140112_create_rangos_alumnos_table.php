<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRangosAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rango_alumnos', function (Blueprint $table) {
            $table->id();
            $table->integer('min_alumnos')->unsigned(); // Número mínimo de alumnos permitidos
            $table->integer('max_alumnos')->unsigned(); // Número máximo de alumnos permitidos
            $table->timestamps();
        });;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rangos_alumnos');
    }
}
