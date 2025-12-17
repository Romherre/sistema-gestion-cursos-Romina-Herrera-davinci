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
        Schema::create('alumnos', function (Blueprint $table) {
    $table->id();
    $table->string('nombre');
    $table->string('apellido');
    $table->string('dni')->unique();
    $table->string('email')->unique();
    $table->date('fecha_nacimiento');
    $table->string('telefono')->nullable();
    $table->string('direccion')->nullable();
    $table->enum('genero', ['masculino', 'femenino', 'otro'])->default('otro');
    $table->boolean('activo')->default(true);
    $table->timestamps();
});

}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
};
