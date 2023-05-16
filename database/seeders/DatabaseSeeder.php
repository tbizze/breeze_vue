<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        //Roda somente uma Seeder específica.
        //$this->call(UserSeeder::class);

        // Roda um conjunto de Seeder.
        $this->call([
            RoleSeeder::class,

            UserSeeder::class,      // Roda seeder User

            FatGrupoSeeder::class,
            FatOperadoraSeeder::class,
            LctoGrupoSeeder::class,
            FaturaSeeder::class,
            FaturaItemSeeder::class,
            LancamentoSeeder::class,

            

        ]);
    }
}
