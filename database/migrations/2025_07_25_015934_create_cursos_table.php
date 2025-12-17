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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->enum('estado', ['activo', 'finalizado', 'cancelado'])->default('activo');
            $table->enum('modalidad', ['presencial', 'virtual', 'hibrido'])->default('presencial');
            $table->string('aula_virtual')->nullable(); // Validar en backend si es requerido según modalidad
            $table->unsignedInteger('cupos_maximos')->default(30);
            $table->unsignedBigInteger('docente_id');
            $table->timestamps();
            // atencion a esta parte chequear mis ese letras sss
        $table->foreign('docente_id')->references('id')->on('docentes')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos');
    }
};
