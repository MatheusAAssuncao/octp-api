<?php

namespace Database\Seeders;

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
            'email' => "matheus.tba@hotmail.com",
            'password' => Hash::make('123!123'),
        ]);

        Template::create([
            'id_user' => 1,
            'name' => 'OctopusFit - Nova senha de acesso',
            'resume' => 'EMAIL-RESET-SENHA',
            'content' => Template::getHtml('EMAIL-RESET-SENHA'),
            'status' => 'A',
        ]);
    }
}
