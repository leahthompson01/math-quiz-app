<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Operands;
use Random\RandomException;

class ProblemController extends Controller
{
    public function index()
    {
        return Problem::all();
    }

    /**
     * @throws RandomException
     */
    public static function generateProblem(){
        $rand1 = random_int(0, 50);
        $rand2 = random_int(0, 50);
        $operandArr = Operands::cases();
        $operand = $operandArr[array_rand(Operands::cases())]->value;
        if($operand === '+') {
            return Problem::addition($rand1, $rand2, $operand);
        }
        if($operand === '-') {
            return Problem::subtraction($rand1, $rand2, $operand);
        }
        return null;
    }
    public function show(Problem $problem)
    {
        return $problem;
    }

    public function update(Request $request, Problem $problem)
    {
        $data = $request->validate([
            'question' => ['required'],
            'answerChoices' => ['required'],
            'correct_answer_id' => ['required'],
        ]);

        $problem->update($data);

        return $problem;
    }

    public function destroy(Problem $problem)
    {
        $problem->delete();

        return response()->json();
    }

}
