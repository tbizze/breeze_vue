<?php

namespace Database\Seeders;

use App\Models\FatOperadora;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FatOperadoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FatOperadora::factory(3)->create();
    }
}
