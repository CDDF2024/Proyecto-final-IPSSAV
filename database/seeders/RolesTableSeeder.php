<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['rol' => 'Administrador', 'descripcion' => 'Acceso total al sistema'],
            ['rol' => 'Facturador', 'descripcion' => 'Encargado de la facturación'],
            ['rol' => 'Auxiliar de Enfermería', 'descripcion' => 'Asistencia en el área de salud'],
            ['rol' => 'Paciente', 'descripcion' => 'Usuario del sistema que recibe atención'],
        ]);
    }
}
