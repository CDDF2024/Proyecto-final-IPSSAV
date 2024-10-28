<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id('id_paciente');
            $table->string('nombre'); 
            $table->string('apellido'); 
            $table->string('tipo_doc'); 
            $table->string('num_doc'); 
            $table->string('genero');
            $table->string('tipo_sangre');
            $table->date('fecha_nacimiento'); 
            $table->date('fecha_expedicion_doc'); 
            $table->string('telefono'); 
            $table->string('correo_electronico'); 
            $table->string('alergias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
