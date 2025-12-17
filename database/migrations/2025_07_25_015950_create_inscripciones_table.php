<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alumno_id');
            $table->unsignedBigInteger('curso_id');
            $table->date('fecha_inscripcion');
            $table->enum('estado', ['activo', 'aprobado', 'desaprobado'])->default('activo');
            $table->tinyInteger('nota_final')->nullable(); // 1 a 10, validar en backend
            $table->unsignedInteger('asistencias')->default(0); // cantidad de asistencias
            $table->text('observaciones')->nullable();
            $table->boolean('evaluado_por_docente')->default(false);
            $table->timestamps();

            // Claves foráneas
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade');
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');

            // Restricción para evitar duplicados
            $table->unique(['alumno_id', 'curso_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscripciones');
    }
};
