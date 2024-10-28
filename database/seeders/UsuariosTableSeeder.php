<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosTableSeeder extends Seeder
{
    public function run()
    {
        // Insertar 2 administradores
        DB::table('usuarios')->insert([
            [
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'tipo_doc' => 'CC',
                'num_doc' => '123456789',
                'email' => 'juan.admin@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 1, // Administrador
            ],
            [
                'nombre' => 'Ana',
                'apellido' => 'Gómez',
                'tipo_doc' => 'CC',
                'num_doc' => '987654321',
                'email' => 'ana.admin@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 1, // Administrador
            ],
        ]);

        // Insertar 2 facturadores
        DB::table('usuarios')->insert([
            [
                'nombre' => 'Carlos',
                'apellido' => 'Martínez',
                'tipo_doc' => 'CC',
                'num_doc' => '456123789',
                'email' => 'carlos.facturador@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 2, // Facturador
            ],
            [
                'nombre' => 'Laura',
                'apellido' => 'Hernández',
                'tipo_doc' => 'CC',
                'num_doc' => '321654987',
                'email' => 'laura.facturador@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 2, // Facturador
            ],
        ]);

        // Insertar 5 auxiliares de enfermería
        DB::table('usuarios')->insert([
            [
                'nombre' => 'María',
                'apellido' => 'López',
                'tipo_doc' => 'CC',
                'num_doc' => '111222333',
                'email' => 'maria.auxiliar1@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 3, // Auxiliar de Enfermería
            ],
            [
                'nombre' => 'José',
                'apellido' => 'Ramírez',
                'tipo_doc' => 'CC',
                'num_doc' => '444555666',
                'email' => 'jose.auxiliar2@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 3, // Auxiliar de Enfermería
            ],
            [
                'nombre' => 'Sofía',
                'apellido' => 'Torres',
                'tipo_doc' => 'CC',
                'num_doc' => '777888999',
                'email' => 'sofia.auxiliar3@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 3, // Auxiliar de Enfermería
            ],
            [
                'nombre' => 'David',
                'apellido' => 'Martín',
                'tipo_doc' => 'CC',
                'num_doc' => '101112131',
                'email' => 'david.auxiliar4@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 3, // Auxiliar de Enfermería
            ],
            [
                'nombre' => 'Lucía',
                'apellido' => 'García',
                'tipo_doc' => 'CC',
                'num_doc' => '141516171',
                'email' => 'lucia.auxiliar5@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 3, // Auxiliar de Enfermería
            ],
        ]);

        // Insertar 11 pacientes
        DB::table('usuarios')->insert([
            [
                'nombre' => 'Pedro',
                'apellido' => 'Sánchez',
                'tipo_doc' => 'CC',
                'num_doc' => '181920212',
                'email' => 'pedro.paciente1@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 4, // Paciente
            ],
            [
                'nombre' => 'Clara',
                'apellido' => 'Núñez',
                'tipo_doc' => 'CC',
                'num_doc' => '222324252',
                'email' => 'clara.paciente2@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 4, // Paciente
            ],
            [
                'nombre' => 'Andrés',
                'apellido' => 'Pérez',
                'tipo_doc' => 'CC',
                'num_doc' => '262728293',
                'email' => 'andres.paciente3@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 4, // Paciente
            ],
            [
                'nombre' => 'Valentina',
                'apellido' => 'Quintero',
                'tipo_doc' => 'CC',
                'num_doc' => '303132333',
                'email' => 'valentina.paciente4@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 4, // Paciente
            ],
            [
                'nombre' => 'Felipe',
                'apellido' => 'Cruz',
                'tipo_doc' => 'CC',
                'num_doc' => '343536373',
                'email' => 'felipe.paciente5@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 4, // Paciente
            ],
            [
                'nombre' => 'Natalia',
                'apellido' => 'Salazar',
                'tipo_doc' => 'CC',
                'num_doc' => '383940414',
                'email' => 'natalia.paciente6@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 4, // Paciente
            ],
            [
                'nombre' => 'Javier',
                'apellido' => 'Mendoza',
                'tipo_doc' => 'CC',
                'num_doc' => '424344454',
                'email' => 'javier.paciente7@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 4, // Paciente
            ],
            [
                'nombre' => 'Isabella',
                'apellido' => 'Ríos',
                'tipo_doc' => 'CC',
                'num_doc' => '464748495',
                'email' => 'isabella.paciente8@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 4, // Paciente
            ],
            [
                'nombre' => 'Ricardo',
                'apellido' => 'Vargas',
                'tipo_doc' => 'CC',
                'num_doc' => '505152535',
                'email' => 'ricardo.paciente9@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 4, // Paciente
            ],
            [
                'nombre' => 'Camila',
                'apellido' => 'Hernández',
                'tipo_doc' => 'CC',
                'num_doc' => '565758595',
                'email' => 'camila.paciente10@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 4, // Paciente
            ],
            [
                'nombre' => 'Diego',
                'apellido' => 'Pinto',
                'tipo_doc' => 'CC',
                'num_doc' => '606162636',
                'email' => 'diego.paciente11@example.com',
                'password' => Hash::make('password'),
                'id_rol' => 4, // Paciente
            ],
        ]);
    }
}
