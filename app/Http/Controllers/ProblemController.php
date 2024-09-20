<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProblemController extends Controller
{
    public function index()
    {
        return Problem::all();
    }

    public function store(Request $request)
    {
//        $data = $request->validate([
//            'question' => ['required'],
//            'answerChoices' => ['required'],
//            'correct_answer_id' => ['required'],
//        ]);
        $data = $this->generateProblem();
        Problem::create($data);
        $problemArr = Problem::all()->toArray();
        shuffle($problemArr);
        return Inertia::render('Problems',['problems' => array_slice($problemArr, 0, 4)]);
    }

    public function generateProblem(){
        $rand1 = mt_rand(0, 50);
        $rand2 = mt_rand(0, 50);
        $question = "What is the sum of " . $rand1 . " + " . $rand2 . "?";
        $correctAnswer = $rand1 + $rand2;
        $answerChoice1 = mt_rand(0, $correctAnswer + 10);
        $answerChoice2 = mt_rand(0, $correctAnswer + 10);
        $answerChoice3 = mt_rand(0, $correctAnswer + 10);
        while ($answerChoice1 == $correctAnswer || $answerChoice2 == $correctAnswer || $answerChoice3 == $correctAnswer) {
            $answerChoice1 = mt_rand(0, $correctAnswer + 10);
            $answerChoice2 = mt_rand(0, $correctAnswer + 10);
            $answerChoice3 = mt_rand(0, $correctAnswer + 10);
        }
        $answerChoices = [$answerChoice1, $answerChoice2, $answerChoice3, $correctAnswer];
        shuffle($answerChoices);
        $correctAnswerIndex = array_search($correctAnswer, $answerChoices);
        $result = ['question' => $question, 'answerChoices'=> $answerChoices,'correct_answer_id'=> $correctAnswerIndex];
        return $result;
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
