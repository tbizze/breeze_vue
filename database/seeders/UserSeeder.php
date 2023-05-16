<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * ### CRIAR USUÁRIOS ########################
         * Além de criar o usuário ADMIN, cria um Team e lhe atribui o usuário criado.
        */
        $userAdmin = User::factory()->create([
            'name' => 'Tiago Admin',
            'email' => 'admin@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'), 
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);
        //Associa o usuário criado ao Role/Função Admin.
        $userAdmin->assignRole('Admin');

        //Cria um Team e atribui o ID do usuário 'Admin' criado.
        Team::factory()->create([
            'name' => 'Time A',
            'user_id' => $userAdmin->id,
            'personal_team' => true,
        ]);

        /**
         * ### CRIAR USUÁRIOS ########################
         * Além de criar o usuário MEDIO, cria um Team e lhe atribui o usuário criado.
        */
        $userMedio = User::factory()->create([
            'name' => 'Tiago Medio',
            'email' => 'medio@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'), 
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);
        //Associa o usuário criado ao Role/Função Admin.
        $userMedio->assignRole('Medio');

        //Cria um Team e atribui o ID do usuário 'Admin' criado.
        Team::factory()->create([
            'name' => 'Time A',
            'user_id' => $userMedio->id,
            'personal_team' => true,
        ]);


        /**
         * ### CRIAR USUÁRIOS ########################
         * Além de criar o usuário BASICO, cria um Team e lhe atribui o usuário criado.
        */
        $userBasico = User::factory()->create([
            'name' => 'Tiago Basico',
            'email' => 'basico@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'), 
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);
        //Associa o usuário criado ao Role/Função Admin.
        $userBasico->assignRole('Basico');

        //Cria um Team e atribui o ID do usuário 'Admin' criado.
        Team::factory()->create([
            'name' => 'Time A',
            'user_id' => $userBasico->id,
            'personal_team' => true,
        ]);


        // Cria 2 usuários usando a 'Factories'
        //\App\Models\User::factory(2)->create();
    }
}
