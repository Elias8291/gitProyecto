<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->string('clave')->primary(); // Clave del grupo ingresada por el usuario como llave primaria
            $table->string('nombre', 100); // Nombre del grupo

            // Llave foránea a la tabla 'rango_alumnos'
            $table->unsignedBigInteger('rango_alumnos_id');
            $table->foreign('rango_alumnos_id')->references('id')->on('rango_alumnos')->onDelete('cascade');

            // Llave foránea a la tabla 'horarios'
            $table->unsignedBigInteger('horario_id');
            $table->foreign('horario_id')->references('id')->on('horarios')->onDelete('cascade');

            // Llave foránea a la tabla 'materias'
            $table->string('materia_clave');
            $table->foreign('materia_clave')->references('clave')->on('materias')->onDelete('cascade');

            $table->timestamps(); // Campos opcionales para la fecha de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos');
    }
}
