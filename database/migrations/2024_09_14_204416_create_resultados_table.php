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
        Schema::create('resultados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_paciente')->constrained('pacientes', 'id_paciente' ); // INT (FK)
            $table->foreignId('id_muestra')->constrained('muestras', 'id' ); // INT (FK)
            $table->text('resultado'); // TEXT
            $table->dateTime('fecha_resultado'); // DATETIME
            $table->text('interpretacion'); // TEXT
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultados');
    }
};
