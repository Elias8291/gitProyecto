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
            $table->id(); // Llave primaria autoincremental
            $table->string('clave', 100); // Clave del grupo
            $table->string('nombre', 100); // Nombre del grupo

            // Llave foránea a la tabla 'rango_alumnos'
            $table->unsignedBigInteger('rango_alumnos_id');
            $table->foreign('rango_alumnos_id')->references('id')->on('rango_alumnos')->onDelete('cascade');

            // Llave foránea a la tabla 'horarios'
            $table->unsignedBigInteger('horario_id');
            $table->foreign('horario_id')->references('id')->on('horarios')->onDelete('cascade');

            // Llave foránea a la tabla 'materias'
            $table->unsignedBigInteger('materia_id');
            $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');

            $table->boolean('activo')->default(true); // Campo para el estado del grupo

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
