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
        Schema::create('muestras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_paciente')->constrained('pacientes', 'id_paciente');
            $table->string('aseguradora',50);
            $table->string('tipo_muestra', 100);
            $table->date('fecha_resultado');
            $table->foreignId('id_profesional')->constrained('usuarios', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muestras');
    }
};
