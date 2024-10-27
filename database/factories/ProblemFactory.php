<?php

namespace Database\Factories;

use App\Http\Controllers\ProblemController;
use App\Models\Problem;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Operands;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Problem>
 */
class ProblemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {
        return ProblemController::generateProblem();
    }
}
