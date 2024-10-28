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
        Schema::create('esquemas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_paciente')->constrained('pacientes', 'id_paciente'); // ID del Paciente
            $table->foreignId('id_biologico')->constrained('biologicos', 'id_biologico'); // ID del Biológico
            $table->integer('dosis_administrada'); // Dosis Administrada
            $table->date('fecha_administracion'); // Fecha de Administración
            $table->integer('edad_paciente'); // Edad del Paciente
            $table->string('lugar_aplicacion'); // Lugar de Aplicación
            $table->foreignId('id_usuario')->constrained('usuarios', 'id'); // ID del Profesional de Salud (Auxiliar de Enfermería)
            $table->text('efectos_secundarios')->nullable(); // Efectos Secundarios Reportados
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('esquemas');
    }
};
