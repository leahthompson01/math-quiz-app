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
        $rand1 = random_int(0, 50);
        $rand2 = random_int(0, 50);
        $operandArr = Operands::cases();
        $operand = $operandArr[array_rand(Operands::cases())]->value;
        if ($operand === '+') {
            return Problem::addition($rand1, $rand2,$operand);
        }
        if ($operand === '-') {
            return Problem::subtraction($rand1, $rand2,$operand);
        }

        return [];
    }
}
