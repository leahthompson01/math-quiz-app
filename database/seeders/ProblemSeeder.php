<?php

namespace Database\Seeders;

use App\Models\Problem;
use Database\Factories\ProblemFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Problem::factory(100)->create();
    }
}
