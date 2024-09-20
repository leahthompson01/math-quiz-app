<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BadProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Problems/Index', [
            'problems' => Problem::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function makeProblem()
    {

//        $problem = ["question" => $question, "correctAnswerId" => $correctAnswerIndex, "answerChoices" => $answerChoices];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rand1 = mt_rand(0, 50);
        $rand2 = mt_rand(0, 50);
        $question = "What is the sum of" . $rand1 . " + " . $rand2 . " ?";
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

//        $question;
//
//        protected int $correctAnswerIndex;
//
//    protected array $answerChoices;

        Problem::create(['question' => $question, ]);
        return redirect()->route('questions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Problem $problem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Problem $problem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Problem $problem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Problem $problem)
    {
        //
    }
}
