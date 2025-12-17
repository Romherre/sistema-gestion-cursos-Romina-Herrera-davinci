<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();


            $table->foreignId('inscripcion_id')
                ->constrained('inscripciones')
                ->onDelete('cascade');

            $table->string('tipo')->default('parcial');

            $table->text('descripcion')->nullable();


            $table->decimal('nota', 3, 1);

            $table->date('fecha');


            $table->foreignId('docente_id')
                ->nullable()
                ->constrained('docentes')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluaciones');
    }
};
