<?php

namespace Database\Seeders;

use App\Models\LctoGrupo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LctoGrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LctoGrupo::factory(4)->create();
    }
}
