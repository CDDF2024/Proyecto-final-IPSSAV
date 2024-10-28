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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50); 
            $table->string('apellido',50); 
            $table->string('tipo_doc', 20); 
            $table->string('num_doc',10); 
            $table->string('email',100)->unique(); 
            $table->string('password', 150); 
            $table->foreignId('id_rol')->constrained('roles', 'id_rol');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
