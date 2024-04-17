<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->id(); // Llave primaria autoincremental
            $table->string('clave', 100); // Clave de la materia
            $table->string('nombre', 100); // Nombre de la materia
            $table->integer('creditos'); // Créditos de la materia
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
        Schema::dropIfExists('materias');
    }
}