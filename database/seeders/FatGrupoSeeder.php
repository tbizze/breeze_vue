<?php

namespace Database\Seeders;

use App\Models\FatGrupo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FatGrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FatGrupo::factory(4)->create();
    }
}
