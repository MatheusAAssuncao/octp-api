<?php

namespace Database\Seeders;

use App\Models\TeacherStudent;
use App\Models\Template;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => "Personal Demo",
            'email' => "contato@octopusfit.com.br",
            'password' => Hash::make('123!123'),
            'type' => 'T',
        ]);

        User::create([
            'name' => "Juquinha",
            'email' => "matheus.tba@hotmail.com",
            'password' => Hash::make('123!123'),
            'type' => 'S',
        ]);

        User::create([
            'name' => "Marquinhos",
            'email' => "matheusttba@gmail.com",
            'password' => Hash::make('123!123'),
            'type' => 'S',
        ]);

        TeacherStudent::create([
            'id_teacher' => 1,
            'id_student' => 2,
            'type_student' => 'O',
            'type_contract' => 'M',
            'status' => 'A',
        ]);
        
        TeacherStudent::create([
            'id_teacher' => 1,
            'id_student' => 3,
            'type_student' => 'O',
            'type_contract' => 'M',
            'status' => 'A',
        ]);

        Template::create([
            'id_user' => 1,
            'name' => 'Nova senha de acesso',
            'resume' => 'EMAIL-RESET-SENHA',
            'content' => Template::getHtml('EMAIL-RESET-SENHA'),
            'status' => 'A',
        ]);

        Template::create([
            'id_user' => 1,
            'name' => 'Seu acesso ao App de treinamento online',
            'resume' => 'EMAIL-CONVITE-ALUNO',
            'content' => Template::getHtml('EMAIL-CONVITE-ALUNO'),
            'status' => 'A',
        ]);

        $this->call([
            GroupMusclesSeeder::class,
            EquipmentsSeeder::class,
            ExercisesSeeder::class,
        ]);
    }
}
